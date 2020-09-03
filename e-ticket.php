<?php
include 'config.php';
session_start();

if(!$_SESSION["user_id"]) {
    $redirect_url = $base_url . '/index.php';
    header('Location: '. $redirect_url);
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$id        = $_SESSION['ticket_search_insert_id'];
$user_info = $_SESSION['user_info'];

/* Fetch Search Ticket Data */
$sql           = "select * from ticket_search where id = '$id';";
$result        = $conn->query($sql);
$ticket_search = '';

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $ticket_search = $row;
    }
}

$total_passenger = (!empty($ticket_search['passenger_no']) ? $ticket_search['passenger_no'] : 0) +
                   (!empty($ticket_search['child_no']) ? $ticket_search['child_no'] : 0);

/* Fetch Passenger Data */
$sql_two        = "select * from passengers where search_id = '$id'";
$result_two     = $conn->query($sql_two);
$passenger_info = array();

if($result_two->num_rows > 0){
    while($row = $result_two->fetch_assoc()){
        array_push($passenger_info, $row);
    }
}

/* Fetch Payments Information */
$sql_three       = "select * from payments where search_id = '$id';";
$result_three    = $conn->query($sql_three);
$payment_details = '';

if($result_three->num_rows > 0){
    while($row = $result_three->fetch_assoc()){
        $payment_details = $row;
    }
}

if( !empty($ticket_search['date'])){
    $search_date         = $ticket_search['date'];
    $date                = date_create($search_date);
    $printed_ticket_date = date_sub($date, date_interval_create_from_date_string("1 days"));
    $printed_ticket_date = date_format($printed_ticket_date, "Y-m-d");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BANGLADESH RAILWAY TICKETS</title>
    <link rel="shortcut icon" type="image/jpg" href="./assets/images/britslogo.png" />
    <style>
        * {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            }

        #passengers-table {
            border-collapse: collapse;
            /*width: 100%;*/
            }

        #passengers-table td, #passengers-table th {
            border: 1px solid #ddd;
            padding: 2px;
            }

        #passengers-table th {
            padding-top: 2px;
            padding-bottom: 2px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
            }
    </style>
</head>
<body>
<img src="./assets/images/e-ticket-top.jpg" alt="">
<div id="wrapper">
    <table>
        <tbody>
        <tr>
            <td>
                <h2 style="margin-bottom: 0px;">793</h2>
                <span>PANCHAGARH EXPRESS</span>
            </td>
            <td>
                <span><?php echo !empty($ticket_search['departure']) ?
                        $ticket_search['departure'] : 'Dhaka' ?></span><br>
                <span><?php echo !empty($ticket_search['date']) ?
                        date("M j, Y",
                             strtotime($ticket_search['date'])) :
                        '' ?> 12:10 AM</span>
            </td>
            <td>
                <img style="height: 80px; width: 250px;" src="./assets/images/train-image.jpg" alt="">
            </td>
            <td style="padding-left: 50px;">
                <span><?php echo !empty($ticket_search['arrival']) ?
                        $ticket_search['arrival'] : 'Dinajpur' ?></span><br>
                <span><?php echo !empty($ticket_search['date']) ?
                        date("M j, Y",
                             strtotime($ticket_search['date'])) :
                        '' ?> 07:37 AM</span>
            </td>
        </tr>
        </tbody>
    </table>

    <div style="width: 100%; margin-top: 10px;">
        <table>
            <tbody>
            <tr>
                <td>
                    <table id="passengers-table" style="width: 70%;">
                        <thead>
                        <tr>
                            <td colspan="2" style="text-align: center">Detail Information</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Issue Date & Time</td>
                            <td>
                                <?php echo !empty($payment_details['createdAt']) ?
                                    date("M j, Y H:i A",
                                         strtotime($payment_details['createdAt'])) :
                                    'Sep 3, 2020' ?></td>
                        </tr>
                        <tr>
                            <td>Issuer NID</td>
                            <td><?php echo !empty($user_info['national_id']) ?
                                    $user_info['national_id'] : '' ?></td>
                        </tr>
                        <tr>
                            <td>Class Name</td>
                            <td>AC Berth</td>
                        </tr>
                        <tr>
                            <td>Coach Name</td>
                            <td>A1-01</td>
                        </tr>
                        <tr>
                            <td>Seat Range</td>
                            <td>31-32</td>
                        </tr>
                        <tr>
                            <td>No of Seats</td>
                            <td><?php echo $total_passenger; ?></td>
                        </tr>
                        <tr>
                            <td>No of Adult Passenger(s)</td>
                            <td><?php echo !empty($ticket_search['passenger_no']) ?
                                    $ticket_search['passenger_no'] : 0 ?></td>
                        </tr>
                        <tr>
                            <td>No of Child Passenger(s)</td>
                            <td><?php echo !empty($ticket_search['child_no']) ?
                                    $ticket_search['child_no'] : 0 ?></td>
                        </tr>
                        <tr>
                            <td>Fare</td>
                            <td>BDT 1,337.00</td>
                        </tr>
                        <tr>
                            <td>VAT</td>
                            <td>BDT 0</td>
                        </tr>
                        <tr>
                            <td>Total Fare</td>
                            <td>BDT 1,337.00</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <img style="width: 200px; height: 250px;" src="./assets/images/e-ticket-qr-code.jpg"
                         alt="">
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div>
        <p style="margin-bottom: 0px; margin-top: 8px; font-size: 18px;">Ticket Printing Info</p>
        <span>Last time for collecting printed ticket: <?php echo !empty($printed_ticket_date) ?
                date("M j, Y",
                     strtotime($printed_ticket_date)) :
                '' ?> 11:40 PM</span><br>
        <span>Mobile Number: <?php echo !empty($user_info['phone_number']) ?
                $user_info['phone_number'] : '' ?></span><br>
        <span>Pin Number: NSFLSH</span>
    </div>

    <div>
        <p style="margin-bottom: 0px; margin-top: 8px; font-size: 18px;">Passenger Details</p>
        <table>
            <tbody>
            <tr>
                <?php foreach($passenger_info as $key => $item){ ?>
                    <td>
                        <img style="width: 40px; height: 50px;"
                             src="<?php echo $base_url . '/' . $item['image_url'] ?>"
                             alt="">
                    </td>
                    <td style="padding-left: 10px; padding-right: 10px;">
                        <p style="margin-bottom: 0px; font-size: 18px;"><?php echo !empty($item['name']) ?
                                $item['name'] : ''; ?></p>
                        <span><?php echo !empty($item['age']) ?
                                $item['age'] :
                                ''; ?> Years</span><br>
                        <span><?php echo !empty($item['gender']) ?
                                $item['gender'] : ''; ?></span>
                    </td>
                <?php } ?>
            </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        <img style="width: 100%; height: 120px;" src="./assets/images/e-ticket-advertise.jpg" alt="">
    </div>
</div>
</body>
</html>