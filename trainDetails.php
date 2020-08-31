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

$id            = $_SESSION['ticket_search_insert_id'];
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BANGLADESH RAILWAYS TICKETS</title>
    <link rel="shortcut icon" type="image/jpg" href="./assets/images/britslogo.png" />

    <!--  Css Link  -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/icofont.min.css">
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link rel="stylesheet" href="./assets/css/detailsStyle.css">
    <link rel="stylesheet" href="./assets/css/searched-content.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
</head>
<body>

<!--  Searched Content Area  -->
<?php include 'searched-content-area.php'; ?>

<div class="ui-details">
    <div class='detailsContainer p-4'>
        <div>
            <h3>Train Details</h3>
            <div class='ui-main-details'>
                <div class="d-flex mt-3">
                    <p class="title-margin ml-4 font-weight-bold">Train No</p>
                    <p class="title-margin font-weight-bold">Train Name</p>
                    <p class="title-margin font-weight-bold">Departure</p>
                    <p class="title-margin font-weight-bold">Arrival</p>
                    <p class="title-margin font-weight-bold">Duration</p>
                    <p class="title-margin font-weight-bold">Fare</p>
                </div>
                <div class="ui-details-card">
                    <p class="ui-head-title">PANCHAGARH EXPRESS</p>
                    <div>
                        <h2 class="ml-4"><b>793</b></h2>
                        <p class="text-secondary ml-4 ui-sub-small">Train No</p>
                    </div>
                    <div class="ui-details-train-name">
                        <b>PANCHAGARH EXPRESS(793)</b>
                        <p class="mb-0 text-secondary gray-text"><?php echo !empty($ticket_search['departure']) ?
                                $ticket_search['departure'] : 'Dhaka'; ?> to</p>
                        <p class="mb-0 text-secondary gray-text"><?php echo !empty($ticket_search['arrival']) ?
                                $ticket_search['arrival'] : 'Dinajpur'; ?></p>
                    </div>
                    <div>

                        <h6>12:10 AM</h6>
                        <p class="mb-0"><b
                                    class="text-success"><?php echo !empty($ticket_search['departure']) ?
                                    $ticket_search['departure'] : 'Dhaka'; ?></b></p>
                        <p class="mb-0"><b class="text-success"><?php echo !empty($ticket_search['date']) ?
                                    date("M j, Y",
                                         strtotime($ticket_search['date'])) :
                                    '' ?></b></p>
                        <p class="mb-0"><b class="text-secondary">Departure @</b></p>
                        <p class="mb-0"><b class="text-danger red-text">(Dhaka Airport Station)</b></p>
                    </div>
                    <div>
                        <h6>07:37 AM</h6>
                        <p class="mb-0"><b class="text-success"><?php echo !empty($ticket_search['arrival']) ?
                                    $ticket_search['arrival'] : 'Dinajpur'; ?></b></p>
                        <p class="mb-0"><b class="text-secondary">Arrival @</b></p>
                        <p class="mb-0"><b class="text-danger red-text">(Main Station)</b></p>
                    </div>
                    <div>
                        <p class="mb-0 ui-smaller"><b>7 Hours</b></p>
                        <p class="mb-0 ui-smaller"><b>27 Minutes</b></p>
                        <p class="mb-0"><i class="ui-sub-small text-secondary">Today</i></p>
                        <p class="mb-0"><i class="ui-sub-small text-secondary">Journey Time</i></p>
                    </div>
                    <div>
                        <h3 class="text-danger text-amount mb-0">BDT 1,689.00</h3>
                        <b class=" ui-sub-small">For Adult</b>
                        <h3 class="text-danger text-amount mb-0">BDT 1,100.00</h3>
                        <b class=" ui-sub-small">For Child</b>
                        <p class="mb-0 ui-sub-small"><b>Inclusive of all TAX</b></p>
                    </div>
                    <div id="first" class="position-relative mt-0 cursor-pointer">
                        <img src="./assets/images/click_here.png" class="cursor-pointer" alt="">
                        <section class="click-img-content position-absolute">
                            <p class="text-white mb-1"><b>Click here</b></p>
                            <p class="text-white mb-1"><b>for Fare by</b></p>
                            <p class="text-white mb-1"><b>Class &</b></p>
                            <p class="text-white mb-1"><b>Availability</b></p>
                        </section>
                    </div>
                </div>
                <div class="ui-route" id="route1">
                    <h4 class="text-danger ml-4"><b>Route</b></h4>
                    <img src="./assets/images/trainDetRoute.png" class="mb-3" alt="">
                    <h5><b class="ui-ticket-availability ml-4">Ticket Availability</b></h5>
                    <div class="d-flex mt-3">
                        <p class="title-margin ml-4 font-weight-bold">Class</p>
                        <p class="title-margin font-weight-bold">Seat(Online)</p>
                        <p class="title-margin font-weight-bold">Seat(Counter)</p>
                        <p class="title-margin font-weight-bold">Fare(Adult)</p>
                        <p class="title-margin font-weight-bold">Fare(Child)</p>
                    </div>
                    <div class="ui-availability-grid-container">
                        <div class="ui-availability-grid">
                            <p class="font-weight-bold text-danger mb-0">AC_B</p>
                            <p class="font-weight-bold text-danger mb-0">02</p>
                            <p class="font-weight-bold text-danger mb-0">58</p>
                            <p class="font-weight-bold text-danger mb-0">BDT 1,689.00</p>
                            <p class="font-weight-bold text-danger mb-0">BDT 1,100.00</p>
                            <a href="ticket-selection.php" class="text-decoration-none">Book <i
                                        class="icofont-shopping-cart"></i></a>
                        </div>
                        <div class="ui-availability-grid">
                            <p class="font-weight-bold text-success">SNIGDHA</p>
                            <p class="font-weight-bold text-success">06</p>
                            <p class="font-weight-bold text-success">18</p>
                            <p class="font-weight-bold text-success">BDT 889.00</p>
                            <p class="font-weight-bold text-success">BDT 520.00</p>
                            <a href="ticket-selection.php" class="text-decoration-none">Book <i
                                        class="icofont-shopping-cart"></i></a>
                        </div>
                        <div class="ui-availability-grid">
                            <p class="font-weight-bold text-danger mb-0">S_CHAIR</p>
                            <p class="font-weight-bold text-danger mb-0">12</p>
                            <p class="font-weight-bold text-danger mb-0">58</p>
                            <p class="font-weight-bold text-danger mb-0">BDT 485.00</p>
                            <p class="font-weight-bold text-danger mb-0">BDT 310.00</p>
                            <a href="ticket-selection.php" class="text-decoration-none">Book <i
                                        class="icofont-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class='ui-main-details'>
                <div class="d-flex mt-3">
                    <p class="title-margin ml-4 font-weight-bold">Train No</p>
                    <p class="title-margin font-weight-bold">Train Name</p>
                    <p class="title-margin font-weight-bold">Departure</p>
                    <p class="title-margin font-weight-bold">Arrival</p>
                    <p class="title-margin font-weight-bold">Duration</p>
                    <p class="title-margin font-weight-bold">Fare</p>
                </div>
                <div class="ui-details-card">
                    <p class="ui-head-title">EKOTA EXPRESS</p>
                    <div>
                        <h2 class="ml-4"><b>705</b></h2>
                        <p class="text-secondary ml-4 ui-sub-small">Train No</p>
                    </div>
                    <div>
                        <b>EKOTA EXPRESS(705)</b>
                        <p class="mb-0 text-secondary gray-text"><?php echo !empty($ticket_search['departure']) ?
                                $ticket_search['departure'] : 'Dhaka'; ?> to</p>
                        <p class="mb-0 text-secondary gray-text"><?php echo !empty($ticket_search['arrival']) ?
                                $ticket_search['arrival'] : 'Dinajpur'; ?></p>
                    </div>
                    <div>

                        <h6>10:10 AM</h6>
                        <p class="mb-0"><b
                                    class="text-success"><?php echo !empty($ticket_search['departure']) ?
                                    $ticket_search['departure'] : 'Dhaka'; ?></b></p>
                        <p class="mb-0"><b class="text-success"><?php echo !empty($ticket_search['date']) ?
                                    date("M j, Y",
                                         strtotime($ticket_search['date'])) :
                                    '' ?></b></p>
                        <p class="mb-0"><b class="text-secondary">Departure @</b></p>
                        <p class="mb-0"><b class="text-danger red-text">(Dhaka Airport Station)</b></p>
                    </div>
                    <div>
                        <h6>07:05 PM</h6>
                        <p class="mb-0"><b class="text-success"><?php echo !empty($ticket_search['arrival']) ?
                                    $ticket_search['arrival'] : 'Dinajpur'; ?></b></p>
                        <p class="mb-0"><b class="text-secondary">Arrival @</b></p>
                        <p class="mb-0"><b class="text-danger red-text">(Main Station)</b></p>
                    </div>
                    <div>
                        <p class="mb-0 ui-smaller"><b>8 Hours</b></p>
                        <p class="mb-0 ui-smaller"><b>55 Minutes</b></p>
                        <p class="mb-0"><i class="ui-sub-small text-secondary">Today</i></p>
                        <p class="mb-0"><i class="ui-sub-small text-secondary">Journey Time</i></p>
                    </div>
                    <div>
                        <h3 class="text-danger text-amount mb-0">BDT 1,689.00</h3>
                        <b class=" ui-sub-small">For Adult</b>
                        <h3 class="text-danger text-amount mb-0">BDT 1,100.00</h3>
                        <b class=" ui-sub-small">For Child</b>
                        <p class="mb-0 ui-sub-small"><b>Inclusive of all TAX</b></p>
                    </div>
                    <div id="second" class="position-relative mt-0 cursor-pointer">
                        <img src="./assets/images/click_here.png" class="cursor-pointer" alt="">
                        <section class="click-img-content position-absolute">
                            <p class="text-white mb-1"><b>Click here</b></p>
                            <p class="text-white mb-1"><b>for Fare by</b></p>
                            <p class="text-white mb-1"><b>Class &</b></p>
                            <p class="text-white mb-1"><b>Availability</b></p>
                        </section>
                    </div>
                </div>
                <div class="ui-route" id="route2">
                    <h4 class="text-danger ml-4"><b>Route</b></h4>
                    <img src="./assets/images/trainDetRoute.png" class="mb-3" alt="">
                    <h5><b class="ui-ticket-availability ml-4">Ticket Availability</b></h5>
                    <div class="d-flex mt-3">
                        <p class="title-margin ml-4 font-weight-bold">Class</p>
                        <p class="title-margin font-weight-bold">Seat(Online)</p>
                        <p class="title-margin font-weight-bold">Seat(Counter)</p>
                        <p class="title-margin font-weight-bold">Fare(Adult)</p>
                        <p class="title-margin font-weight-bold">Fare(Child)</p>
                    </div>
                    <div class="ui-availability-grid-container">
                        <div class="ui-availability-grid">
                            <p class="font-weight-bold text-danger mb-0">AC_B</p>
                            <p class="font-weight-bold text-danger mb-0">02</p>
                            <p class="font-weight-bold text-danger mb-0">58</p>
                            <p class="font-weight-bold text-danger mb-0">BDT 1,689.00</p>
                            <p class="font-weight-bold text-danger mb-0">BDT 1,100.00</p>
                            <a href="ticket-selection.php" class="text-decoration-none">Book <i
                                        class="icofont-shopping-cart"></i></a>
                        </div>
                        <div class="ui-availability-grid">
                            <p class="font-weight-bold text-success">SNIGDHA</p>
                            <p class="font-weight-bold text-success">06</p>
                            <p class="font-weight-bold text-success">18</p>
                            <p class="font-weight-bold text-success">BDT 889.00</p>
                            <p class="font-weight-bold text-success">BDT 520.00</p>
                            <a href="ticket-selection.php" class="text-decoration-none">Book <i
                                        class="icofont-shopping-cart"></i></a>
                        </div>
                        <div class="ui-availability-grid">
                            <p class="font-weight-bold text-danger mb-0">S_CHAIR</p>
                            <p class="font-weight-bold text-danger mb-0">12</p>
                            <p class="font-weight-bold text-danger mb-0">58</p>
                            <p class="font-weight-bold text-danger mb-0">BDT 485.00</p>
                            <p class="font-weight-bold text-danger mb-0">BDT 310.00</p>
                            <a href="ticket-selection.php" class="text-decoration-none">Book <i
                                        class="icofont-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui-filterBy">
            <header class="d-flex"><p class="m-0">Filter By</p> <i class="icofont-filter"></i></header>
            <div class="p-4">
                <div class="position-relative">
                    <p class="ui-filter-label">Train</p>
                    <div class="input-group mb-2">
                        <input class="form-control" type="text" placeholder="Train Name">
                        <div class="input-group-append">
                            <span class="input-group-text text-danger"><h5 class="m-0"><i
                                            class="icofont-train-line"></i>   </h5></span>
                        </div>
                    </div>
                    <p class="text-danger">by Train Name</p>
                </div>
                <div class="position-relative">
                    <p class="ui-filter-label">Date</p>
                    <div class="form-group">
                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                    </div>
                    <p class="text-danger">by Date Of Journey</p>
                </div>
                <div class="position-relative">
                    <p class="ui-filter-label">Time</p>
                    <div class="input-group mb-2">
                        <input class="form-control" type="text" placeholder="Time">
                        <div class="input-group-append">
                            <span class="input-group-text text-danger"><h5 class="m-0"><i
                                            class="icofont-apple-watch"></i></h5></span>
                        </div>
                    </div>
                    <p class="text-danger">by Time of Journey</p>
                </div>
            </div>
        </div>
    </div>

    <!--  Footer Area  -->
    <div class="mt-5">
        <?php include 'footer.php'; ?>
    </div>
</div>

<!-- Js Link -->
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/custom.script.js"></script>
<script src="./assets/js/trainDetails.js"></script>
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
    
    $(document).ready(function (){
        getSearchedTicketData();
    });
</script>
</body>
</html>
