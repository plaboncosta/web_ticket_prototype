<?php
include 'config.php';
session_start();

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

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BANGLADESH RAILWAYS TICKETS</title>
    <link rel="shortcut icon" type="image/jpg" href="./assets/images/britslogo.png" />

    <!--  Css Link  -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/icofont.min.css">
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link rel="stylesheet" href="./assets/css/profile.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/searched-content.css">
</head>
<body>

<!--  Searched Content Area  -->
<?php include 'searched-content-area.php'; ?>

<!-- Profile Body Data -->
<div class="ui-profile">
    <div class="p-5 ui-profile-container">
        <div class="ui-selector">
            <div>
                <p class="ui-root text-center">My Dashboard</p>
                <p id="profile" class="root-options">My Profile</p>
                <p id="trip" class="root-options">My Trips</p>
                <p id="meals" class="root-options">Meals</p>
                <p id="sub" class="root-options">SMS Subscription</p>
                <p id="complaint" class="root-options">Complaint</p>
            </div>
        </div>
        <div>
            <div id="pro1">
                <h3><b>My Profile</b></h3>
                <div class="ui-sec-container shadowCustomMid">
                    <p>Complete your Profile <span class="ml-5">40%</span></p>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 40%"
                             aria-valuenow="100"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-2">Get the best out of BRITS by adding the remaining details</p>
                    <div class="ui-options">
                        <div class="d-flex align-items-center"><i class="icofont-plus"></i> <h5><b>Verify
                                    Email</b></h5>
                        </div>
                        <div class="d-flex align-items-center"><i class="icofont-plus"></i> <h5><b>Add Your
                                    Mobile
                                    Number</b></h5></div>
                        <div class="d-flex align-items-center"><i class="icofont-plus"></i> <h5><b>Complete
                                    Basic
                                    Info</b></h5></div>
                    </div>
                </div>
                <div class="ui-sec-container shadowCustomMid">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3><b>Profile</b></h3>
                            <p class="mt-2">Basic info, for a faster booking experience</p>
                        </div>
                        <button class="btn btn-danger py-2 h-100 rounded-lg"><h4 class="m-0 px-4 "><b>Edit</b>
                            </h4>
                        </button>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex align-items-center ui-info"><p class="w-25 mb-3">NAME</p> <h5><b>
                                    <?php echo !empty($user_info['first_name']) ? $user_info['first_name'] :
                                        '' ?>
                                    <?php echo !empty($user_info['last_name']) ? $user_info['last_name'] :
                                        '' ?>
                                </b></h5></div>
                        <div class="d-flex align-items-center ui-info"><p class="w-25 mb-3">BIRTHDAY</p> <h5
                                    class="text-danger"><b>+Add</b></h5></div>
                        <div class="d-flex align-items-center ui-info"><p class="w-25 mb-3">GENDER</p> <h5><b>MALE</b>
                            </h5></div>
                        <div class="d-flex align-items-center ui-info"><p class="w-25 mb-3">MARITAL STATUS</p>
                            <h5
                                    class="text-danger"><b>+Add</b></h5></div>
                        <div class="d-flex align-items-center ui-info"><p class="w-25 mb-3">NID</p> <h5><b>
                                    <?php echo !empty($user_info['national_id']) ? $user_info['national_id'] :
                                        '' ?>
                                </b></h5></div>
                    </div>
                </div>
                <div class="ui-sec-container shadowCustomMid">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3><b>Login Details</b></h3>
                            <p class="mt-2">Manage your email address mobile number and password</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex align-items-center ui-info"><p class="w-25 mb-3">MOBILE NUMBER</p>
                            <h5 class="w-50">
                                <b><?php echo !empty($user_info['phone_number']) ?
                                        $user_info['phone_number'] : '' ?></b></h5>
                            <h5 class="text-danger">
                                <b>Change Mobile No?</b></h5>
                        </div>
                        <div class="d-flex align-items-center ui-info"><p class="w-25 mb-3">EMAIL ID</p> <h5
                                    class="w-50"><b><?php echo !empty($user_info['email']) ?
                                        $user_info['email'] : '' ?></b></h5>
                            <h5 class="text-danger">
                                <b>Verify Your Email ID</b></h5>
                        </div>
                        <div class="d-flex align-items-center ui-info"><p class="w-25 mb-3">PASSWORD</p> <h5
                                    class="w-50">
                                <b>*************</b></h5>
                            <h5 class="text-danger">
                                <b>Change Password?</b></h5>
                        </div>
                    </div>
                </div>
                <div class="ui-sec-container shadowCustomMid mb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3><b>Save Traveller(s)</b></h3>
                            <p class="mt-2">You have 0 Traveller(s)</p>
                        </div>
                        <button class="btn btn-danger py-2 h-100 rounded-lg"><h4 class="m-0 px-4 "><b>Edit</b>
                            </h4>
                        </button>
                    </div>
                </div>
            </div>
            <div id="pro2">
                <h3><b>My Trips</b></h3>
                <div class="ui-sec-container shadowCustomMid">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex w-100">
                            <div>
                                <img src="./assets/images/upcoming.png" alt="">
                            </div>
                            <div class="ml-4">
                                <h3><b>UPCOMING</b></h3>
                                <p class="mt-2">Upcoming Travel Tickets</p>
                            </div>
                        </div>
                        <button class="btn btn-danger py-2 h-100 rounded-lg"><h4 class="m-0 px-4 "><b>Edit</b>
                            </h4>
                        </button>
                    </div>
                    <div class="train-info shadowCustom">
                        <h4 class="ui-header mb-5"><b>Train Info</b></h4>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="">
                                    <h5 class="mb-0"><b>PANCHAGARH EXPRESS(793)</b></h5>
                                </div>
                                <div class="">
                                    <b class="ui-top"><?php echo !empty($ticket_search['departure']) ?
                                            $ticket_search['departure'] : '' ?></b>
                                    <p class="mb-0">12:10 AM</p>
                                </div>
                                <div class="">
                                    <i class="icofont-rounded-right"></i>
                                </div>
                                <div class="">
                                    <b class="ui-top"><?php echo !empty($ticket_search['arrival']) ?
                                            $ticket_search['arrival'] : '' ?></b>
                                    <p class="mb-0">07:37 AM</p>
                                </div>
                                <div class="">
                                    <b class="ui-top">Passenger <?php echo $total_passenger; ?></b>
                                    <p class="mb-0">General Quota</p>
                                </div>
                                <div class="">
                                    <b class="ui-top">07h 27m</b>
                                    <p class="mb-0">10 Stops</p>
                                </div>
                                <div class="">
                                    <b class="ui-top"><?php echo !empty($ticket_search['date']) ?
                                            date("M j, Y",
                                                 strtotime($ticket_search['date'])) :
                                            '' ?></b>
                                    <p class="mb-0">Departure</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="train-info shadowCustom">
                        <h4 class="ui-header mb-5"><b>Passenger Details</b></h4>
                        <?php foreach($passenger_info as $key => $item){ ?>
                            <div class="mb-0">
                                <div class="d-flex justify-content-between">
                                    <div class="w-50 d-flex mr-3">
                                        <?php if( !empty($item['image_url'])){ ?>
                                            <img src="<?php echo $base_url . '/' . $item['image_url'] ?>"
                                                 class="profile-image" alt="">
                                        <?php } else{ ?>
                                            <div class="ui-avatar"><i class="icofont-user-alt-2"></i></div>
                                        <?php } ?>
                                        <div>
                                            <h5 class="mb-3"><b><?php echo !empty($item['name']) ?
                                                        $item['name'] : ''; ?></b></h5>
                                            <p><span><?php echo !empty($item['age']) ?
                                                        $item['age'] :
                                                        ''; ?> years old | <?php echo !empty($item['gender']) ?
                                                        $item['gender'] : ''; ?></span></p>
                                        </div>
                                    </div>
                                    <div class="w-50">
                                        <p><span>Class</span></p>
                                        <h5><b>AC Berth Class</b></h5>
                                    </div>
                                    <div class="w-50">
                                        <p><span>Date of Journey</span></p>
                                        <h5><b><?php echo !empty($ticket_search['date']) ? date("M j, Y",
                                                                                                strtotime($ticket_search['date'])) :
                                                    '' ?></b></h5>
                                    </div>
                                    <div class="w-50">
                                        <p><span>Fare</span></p>
                                        <h5><b>BDT 1,689.00</b></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-5 <?php echo $key == (count($passenger_info) - 1) ? 'mb-0' :
                                'mb-4'; ?>">
                                <div><h4 class="mb-3 ml-4"><b>Availability Status: </b><b
                                                class="text-success">Booking Confirmed</b></h4></div>
                                <div class="bg-pink ml-4"><p class="m-0">Please cary your ID card while
                                        traveling</p></div>
                            </div>
                        <?php } ?>
                    </div>
                    <div>
                        <h3 class="mb-4"><b>TICKET(S)</b></h3>
                        <div class="ui-ticket">
                            <div class="row">
                                <div class="col-md-5 border-right-dashed pr-4">
                                    <h4 class="text-white"><b>PANCHAGARH EXPRESS</b></h4>
                                    <p class="mb-3"><b>(793)</b></p>
                                    <div class="d-flex justify-content-between w-100">
                                        <p><b>AC Berth Class</b></p>
                                        <p><b>General Quota</b></p>
                                    </div>
                                    <div class="w-100">
                                        <div class="d-flex  justify-content-between">
                                            <p><b><?php echo !empty($ticket_search['departure']) ?
                                                        $ticket_search['departure'] : '' ?></b></p>
                                            <p><b><?php echo !empty($ticket_search['arrival']) ?
                                                        $ticket_search['arrival'] : '' ?></b></p>
                                        </div>
                                        <div class="d-flex position-relative ui-locationTo justify-content-between">
                                            <div>
                                                <p class="text-yellow"><b>DA</b></p>
                                                <p class="mb-0 ui-time">12:10 AM</p>
                                                <p class="mb-0 ui-time"><?php echo !empty($ticket_search['date']) ?
                                                        date("d/m/Y",
                                                             strtotime($ticket_search['date'])) :
                                                        '' ?></p>
                                            </div>
                                            <div>
                                                <p class="text-right text-yellow"><b>DGP</b></p>
                                                <p class="mb-0 text-right ui-time">12:10 AM</p>
                                                <p class="mb-0 text-right ui-time"><?php echo !empty($ticket_search['date']) ?
                                                        date("d/m/Y",
                                                             strtotime($ticket_search['date'])) :
                                                        '' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="px-3">
                                        <div class="d-flex justify-content-between mb-4">
                                            <h4 class="text-white"><b>Ticket No: </b><b class="text-yellow">2425188484961</b>
                                            </h4>
                                            <h4 class="text-white"><b>07h 27m</b></h4>
                                        </div>
                                        <div class="d-flex justify-content-between pb-2 border-bottom-dashed mb-4">
                                            <div>
                                                <p class="mb-2">Passenger <?php echo $total_passenger; ?></p>
                                                <?php foreach($passenger_info as $key => $item){ ?>
                                                    <p class="mb-2"><?php echo !empty($item['name']) ?
                                                            $item['name'] : ''; ?>
                                                        , <?php echo !empty($item['age']) ?
                                                            $item['age'] : ''; ?>
                                                        , <?php echo !empty($item['gender']) ?
                                                            ($item['gender'] == 'Male' ? 'M' : 'F') :
                                                            ''; ?></p>
                                                <?php } ?>
                                            </div>
                                            <div class="text-center">
                                                <p class="mb-2">Coach</p>
                                                <p class="mb-2">A1-01</p>
                                                <p class="mb-2">A1-01</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="mb-2">Seat / Berth</p>
                                                <p class="mb-2"><span class="text-yellow">31</span>, Upper
                                                    Berth</p>
                                                <p class="mb-2"><span class="text-yellow">32</span>, Lower
                                                    Berth</p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="mb-2">Total Fare</p>
                                                <p class="mb-2">Payment Mode</p>
                                            </div>
                                            <div>
                                                <h2 class="text-right text-yellow">BDT 2980.00</h2>
                                                <?php if( !empty($payment_details['payment_option'])){ ?>
                                                    <?php if($payment_details['payment_option'] ==
                                                             'bKash'){ ?>
                                                        <p class="text-right mb-0">MFS
                                                            - <?php echo $payment_details['payment_option']; ?></p>
                                                    <?php } else{ ?>
                                                        <p class="text-right mb-0">Credit Card - VISA</p>
                                                    <?php } ?>
                                                <?php } ?>
                                                <p class="text-right ">P6541-xxxx-xxxx-xxxx</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <button id="e_ticket_print"
                                        class="btn btn-block btn-danger ticket-confirmation-button px-0 py-4 ">
                                    <h4 class="mb-0">
                                        <b><i class="icofont-print"></i> Print the Ticket</b>
                                    </h4>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-block btn-danger ticket-confirmation-button py-4">
                                    <h4 class="mb-0">
                                        <b>
                                            <a href="mpdf.php" class="text-decoration-none text-light"
                                               download>
                                                <i class="icofont-download"></i>
                                                Download
                                            </a>
                                        </b>
                                    </h4>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui-sec-container shadowCustomMid mt-5">
                    <div class="d-flex w-100">
                        <div>
                            <img src="./assets/images/noCancel.png" alt="">
                        </div>
                        <div class="ml-4">
                            <h3><b>Looks empty, you've no cancelled bookings.</b></h3>
                            <p class="mt-2 mb-0">Great! Looks like you've cno cancelled bookings.</p>
                        </div>
                    </div>
                </div>
                <div class="ui-sec-container shadowCustomMid mt-5">
                    <div class="d-flex w-100">
                        <div>
                            <img src="./assets/images/completedTrip.png" alt="">
                        </div>
                        <div class="ml-4">
                            <h3><b>Completed Trips</b></h3>
                            <p class="mt-2 mb-0">Your Completed booking(s)</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pro3">
                <h3><b>Meals</b></h3>
                <div class="ui-sec-container shadowCustomMid">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3><b>Book a Meal</b></h3>
                            <p class="mt-2 mb-0">Add a Meal</p>
                        </div>
                        <button class="btn btn-danger py-2 h-100 rounded-lg"><h4 class="m-0 px-4 "><b>Add</b>
                            </h4>
                        </button>
                    </div>
                </div>
                <div class="ui-sec-container shadowCustomMid">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex w-100">
                            <div>
                                <img src="./assets/images/bhunaKhi.png" alt="">
                            </div>
                            <div class="ml-4">
                                <h3><b>Bhuna Khichri</b></h3>
                                <p class="mt-2">BDT 300</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end h-100 mt-5">
                            <button class="mt-5 btn btn-secondary px-4 mr-4 py-2 h-100 rounded-lg">
                                <h4 class="m-0 px-4 "><b>0</b></h4>
                            </button>
                            <button class="mt-5 btn btn-danger px-4 py-2 h-100 rounded-lg">
                                <h4 class="m-0 px-4 "><b>Add</b></h4>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="ui-sec-container shadowCustomMid">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex w-100">
                            <div>
                                <img src="./assets/images/patlaKhi.png" alt="">
                            </div>
                            <div class="ml-4">
                                <h3><b>Patla Khichri</b></h3>
                                <p class="mt-2">BDT 300</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end h-100 mt-5">
                            <button class="mt-5 btn btn-secondary px-4 mr-4 py-2 h-100 rounded-lg">
                                <h4 class="m-0 px-4 "><b>0</b></h4>
                            </button>
                            <button class="mt-5 btn btn-danger px-4 py-2 h-100 rounded-lg">
                                <h4 class="m-0 px-4 "><b>Add</b></h4>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="ui-sec-container shadowCustomMid">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex w-100">
                            <div>
                                <img src="./assets/images/morogPol.png" alt="">
                            </div>
                            <div class="ml-4">
                                <h3><b>Morog Polao</b></h3>
                                <p class="mt-2">BDT 200</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end h-100 mt-5">
                            <button class="mt-5 btn btn-secondary px-4 mr-4 py-2 h-100 rounded-lg">
                                <h4 class="m-0 px-4 "><b>0</b></h4>
                            </button>
                            <button class="mt-5 btn btn-danger px-4 py-2 h-100 rounded-lg">
                                <h4 class="m-0 px-4 "><b>Add</b></h4>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="ui-sec-container shadowCustomMid">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex w-100">
                            <div>
                                <img src="./assets/images/mistiDoi.png" alt="">
                            </div>
                            <div class="ml-4">
                                <h3><b>Mishti Doi</b></h3>
                                <p class="mt-2">BDT 50</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end h-100 mt-5">
                            <button class="mt-5 btn btn-secondary px-4 mr-4 py-2 h-100 rounded-lg">
                                <h4 class="m-0 px-4 "><b>0</b></h4>
                            </button>
                            <button class="mt-5 btn btn-danger px-4 py-2 h-100 rounded-lg">
                                <h4 class="m-0 px-4 "><b>Add</b></h4>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pro4">
                <h3><b>SMS Subscription</b></h3>

                <div class="ui-sec-container shadowCustomMid">
                    <div class="mb-4">
                        <h3 class="mb-3"><b>Buy SMS PACK</b></h3>
                        <p class="mt-2">Activate SMS Pack and Stay Connected</p>
                    </div>
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <div>
                            <p>Package Name</p>
                            <h5><b>BRITS SMS PACK</b></h5>
                        </div>
                        <div>
                            <p>Price</p>
                            <h5><b>BDT 50</b></h5>
                        </div>
                        <div>
                            <p>No of SMS</p>
                            <h5><b>100</b></h5>
                        </div>
                        <div>
                            <p>Validity</p>
                            <h5><b>180 days</b></h5>
                        </div>
                        <button class="w-25 btn btn-danger py-2 h-100 rounded-lg"><h4 class="m-0 px-4 ">
                                <b>Buy</b></h4>
                        </button>
                    </div>
                </div>
                <div class="ui-sec-container shadowCustomMid">
                    <div class="mb-4">
                        <h3 class="mb-3"><b>Active SMS PACK</b></h3>
                        <p class="mt-2">View SMS Pack Status</p>
                    </div>
                    <div class="d-flex w-75 justify-content-between align-items-center">
                        <div>
                            <p>Package Name</p>
                            <h5><b>BRITS SMS PACK</b></h5>
                        </div>
                        <div>
                            <p>SMS Send</p>
                            <h5><b>05 of 100</b></h5>
                        </div>
                        <div>
                            <p>Pack Valid Till</p>
                            <h5><b>26-Dec-2020</b></h5>
                        </div>
                        <div>
                            <p>Active</p>
                            <h5><b>Yes</b></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pro5">
                <h3><b>Complaint</b></h3>
                <div class="ui-sec-container shadowCustomMid">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3><b>Register a Complaint</b></h3>
                            <p class="mt-2">Add a Complaint</p>
                        </div>
                        <button class="btn btn-danger px-4 mr-4 py-2 h-100 rounded-lg">
                            <h4 class="m-0 px-4 "><b>Add</b></h4>
                        </button>
                    </div>
                </div>
                <div class="ui-sec-container shadowCustomMid">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3><b>Complaint Status</b></h3>
                            <p class="mt-2">View Status</p>
                        </div>
                        <button class="btn btn-success px-4 mr-4 py-2 h-100 rounded-lg">
                            <h4 class="m-0 px-4 "><b>View</b></h4>
                        </button>
                    </div>
                </div>
                <div class="ui-sec-container shadowCustomMid">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3><b>Resolved Complaint(s)</b></h3>
                            <p class="mt-2">View Resolve</p>
                        </div>
                        <button class="btn btn-success px-4 mr-4 py-2 h-100 rounded-lg">
                            <h4 class="m-0 px-4 "><b>View</b></h4>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui-footer-container">
        <div class="d-flex justify-content-center ui-footer-top">
            <div class="ui-footer-comp">
                <h3>INFORMATION</h3>
                <p>About Us</p>
                <p>Directory of transport</p>
                <p>Help</p>
                <p>Blog</p>
            </div>
            <div class="ui-footer-comp">
                <h3>TERMS AND CONDITIONS</h3>
                <p>Privacy Policy</p>
                <p>Terms of use</p>
            </div>
            <div class="ui-footer-comp">
                <h3>HELP</h3>
                <p>Help and Contact</p>
                <p>Travel updates</p>
                <p>Special assistance</p>
                <p>FAQ</p>
            </div>
            <div class="ui-footer-comp">
                <h3>RESERVATION NO</h3>
                <p>+088 111 222 333</p>
                <p>+088 111 444 5555</p>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center ui-footer-bottom">
            <div>
                <b class="mb-0">Copyright &#169; 2020 - All Rights Reserved</b>
            </div>
            <div class="d-flex">
                <p class="mb-0 ui-footer-icon"><i class="icofont-facebook"></i></p>
                <p class="mb-0 ui-footer-icon"><i class="icofont-twitter"></i></p>
            </div>
        </div>
    </div>
</div>

<!-- Js Link -->
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/custom.script.js"></script>
<script src="./assets/js/profile.js"></script>
<script>
    let base = "<?php echo $base_url; ?>";
    
    function addSearchedTicketInfo(){
        $.ajax({
            url   : base + '/db.php',
            method: 'POSt',
            data  : $("#searchTicketForm").serialize(),
        }).done(function (response){
            let result = JSON.parse(response);
            if (result.success){
                window.location.reload();
            }
        });
    }
    
    function getSearchedTicketData(){
        $.ajax({
            url     : base + '/db.php',
            method  : 'POST',
            dataType: 'json',
            data    : {
                "action": "get_searched_ticket_data",
                "id"    : "<?php echo $_SESSION['ticket_search_insert_id']; ?>"
            },
        }).done(function (response){
            if (response){
                $("#searchTicketForm").find("select[name='departure']").val(response.departure).end();
                $("#searchTicketForm").find("select[name='arrival']").val(response.arrival).end();
                $("#searchTicketForm").find("input[name='date']").val(response.date).end();
                $("#searchTicketForm").find("select[name='class']").val(response.class).end();
                $("#searchTicketForm").find("select[name='passenger_no']").val(response.passenger_no).end();
                $("#searchTicketForm").find("select[name='child_no']").val(response.child_no).end();
                $("#searchTicketForm").find("input[name='id']").val(response.id).end();
            }
        });
    }
    
    $("#e_ticket_print").click(function (){
        w = window.open('mpdf.php');
        w.print();
    });
    
    $(document).ready(function (){
        getSearchedTicketData();
    });
</script>
</body>
</html>
