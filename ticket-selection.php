<?php
include 'config.php';
session_start();

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
    <title>BANGLADESH RAILWAYS TICKETS</title>
    <link rel="shortcut icon" type="image/jpg" href="./assets/images/britslogo.png" />

    <!--  Css Link  -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link rel="stylesheet" href="./assets/css/ticket-selection.css">
    <link rel="stylesheet" href="./assets/css/icofont.min.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
</head>
<body>
<!-- Wrapper Defined -->
<div id="wrapper">

    <div class="p-4">
        <div class="row mx-0 px-0">
            <div class="col-md-12 pt-4">
                <!--  Train info  -->
                <div class="train-info bg-white">
                    <h4 class="ui-header mb-5"><b>Train Info</b></h4>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="mr-5">
                                <h5 class="mb-0"><b>PANCHAGARH EXPRESS(793)</b></h5>
                            </div>
                            <div class="mr-1 ml-5">
                                <b class="ui-top"><?php echo !empty($ticket_search['departure']) ? $ticket_search['departure'] : ''; ?></b>
                                <p class="mb-0">12:10 AM</p>
                            </div>
                            <div class="mr-1 ml-3">
                                <i class="icofont-rounded-right"></i>
                            </div>
                            <div class="mr-5 ml-3">
                                <b class="ui-top"><?php echo !empty($ticket_search['arrival']) ? $ticket_search['arrival'] : ''; ?></b>
                                <p class="mb-0">07:37 AM</p>
                            </div>
                            <div class="mr-5 ml-5">
                                <b class="ui-top">Passenger <?php echo $total_passenger; ?></b>
                                <p class="mb-0">General Quota</p>
                            </div>
                            <div class="mr-5 ml-5">
                                <b class="ui-top">07h 27m</b>
                                <p class="mb-0">10 Stops</p>
                            </div>
                            <div class="mr-5 ml-5">
                                <b class="ui-top"><?php echo !empty($ticket_search['date']) ? date("M j, Y",
                                                                  strtotime($ticket_search['date'])) : '' ?></b>
                                <p class="mb-0">Departure</p>
                            </div>
                        </div>
                        <div>
                            <button onclick="window.location.href = 'trainDetails.php'"
                                    class="btn btn-outline-secondary">Change
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 pt-4">
                <!--  Seat Selection info  -->
                <div class="train-info bg-white">
                    <h4 class="ui-header mb-5"><b>Seat Selection</b></h4>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="form-check mr-5">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                       id="inlineRadio1" checked
                                       value="option1">
                                <label class="form-check-label ml-3 mb-2" for="inlineRadio1"><b
                                            class="ui-top">AC
                                        Berth</b></label>
                                <p class="ml-3">02 Seats Available</p>
                            </div>
                            <div class="form-check mr-5 ml-4">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                       id="inlineRadio2"
                                       value="option1">
                                <label class="form-check-label ml-3 mb-2" for="inlineRadio2"><b
                                            class="ui-top">AC
                                        Chair</b></label>
                                <p class="ml-3">06 Seats Available</p>
                            </div>
                            <div class="form-check mr-5 ml-4">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                       id="inlineRadio3"
                                       value="option1">
                                <label class="form-check-label ml-3 mb-2" for="inlineRadio3"><b
                                            class="ui-top">Shovon
                                        Chain</b></label>
                                <p class="ml-3">12 Seats Available</p>
                            </div>
                            <div class="form-check mr-5 ml-4">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                       id="inlineRadio4"
                                       value="option1">
                                <label class="form-check-label ml-3 mb-2" for="inlineRadio4"><b
                                            class="ui-top">Shovon</b></label>
                                <p class="ml-3">Unavailable</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 pt-4">
                <!--  Seat Selection  -->
                <div class="seat-selection">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="seat-selection-info">
                                <h4>AC Berth</h4>
                                <h4>Class Coach</h4>
                                <p class="mt-4">Coach Code: AI</p>
                                <p>From Seat: 25</p>
                                <p>To Seat: 49</p>
                            </div>
                            <div class="mt-3 seat-selection-info">
                                <h4>Coach Legend</h4>
                                <div class="mt-4 d-flex row">
                                    <div class="col-md-7">
                                        <p>Lower Berth</p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="seat-selection-symbol seat-selection-red-symbol"></div>
                                    </div>
                                </div>
                                <div class="d-flex row">
                                    <div class="col-md-7">
                                        <p>Upper Berth</p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="seat-selection-symbol seat-selection-green-symbol"></div>
                                    </div>
                                </div>
                                <div class="d-flex row">
                                    <div class="col-md-7">
                                        <p>Booked Seat</p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="seat-selection-symbol seat-selection-black-symbol"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="d-flex">
                                <p class="pl-3 seat-selection-coach-id-text">Select Coach ID</p>
                                <div class="seat-selection-coach-number-first">
                                    A1-01
                                </div>
                                <div class="seat-selection-coach-number-second">
                                    A1-02
                                </div>
                                <div class="seat-selection-coach-number-third">
                                    A1-03
                                </div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="ui-train-container">
                                    <div class="ui-train-subContainer">
                                        <div class="d-flex h-100 flex-column justify-content-between">
                                            <div class="ui-toilet">Toilet</div>
                                            <div class="ui-toilet">Toilet</div>
                                        </div>
                                        <div class="d-flex w-75 justify-content-center">
                                            <div class="ui-sits">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="ui-singleSit">L</div>
                                                    <div class="ui-singleSit">U</div>
                                                    <p class="font-weight-bold">A</p>
                                                </div>
                                            </div>
                                            <div class="ui-sits">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="ui-singleSit">L</div>
                                                    <div class="ui-singleSit">U</div>
                                                    <p class="font-weight-bold">B</p>
                                                </div>
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="ui-singleSit">L</div>
                                                    <div class="ui-singleSit">U</div>
                                                    <p class="font-weight-bold">C</p>
                                                </div>
                                                <p></p>
                                            </div>
                                            <div class="ui-sits">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="ui-singleSit bg-green">L</div>
                                                    <div class="ui-singleSit bg-red">U</div>
                                                    <p class="font-weight-bold">D</p>
                                                </div>
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="ui-singleSit">L</div>
                                                    <div class="ui-singleSit">U</div>
                                                    <p class="font-weight-bold">E</p>
                                                </div>
                                                <p></p>
                                            </div>
                                            <div class="ui-sits">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="ui-singleSit">L</div>
                                                    <div class="ui-singleSit">U</div>
                                                    <p class="font-weight-bold">F</p>
                                                </div>
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="ui-singleSit">L</div>
                                                    <div class="ui-singleSit">U</div>
                                                    <p class="font-weight-bold">G</p>
                                                </div>
                                                <p></p>
                                            </div>
                                            <div class="ui-sits">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="ui-singleSit">L</div>
                                                    <div class="ui-singleSit">U</div>
                                                    <p class="font-weight-bold">H</p>
                                                </div>
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="ui-singleSit">L</div>
                                                    <div class="ui-singleSit">U</div>
                                                    <p class="font-weight-bold">I</p>
                                                </div>
                                                <p></p>
                                            </div>
                                            <div class="ui-sits">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="ui-singleSit">L</div>
                                                    <div class="ui-singleSit">U</div>
                                                    <p class="font-weight-bold">J</p>
                                                </div>
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="ui-singleSit">L</div>
                                                    <div class="ui-singleSit">U</div>
                                                    <p class="font-weight-bold">K</p>
                                                </div>
                                                <p></p>
                                            </div>
                                            <div>
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="ui-singleSit">L</div>
                                                    <div class="ui-singleSit">U</div>
                                                    <p class="font-weight-bold">L</p>
                                                </div>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="d-flex h-100 flex-column justify-content-between">
                                            <div class="ui-toilet">Toilet</div>
                                            <div class="ui-toilet">Toilet</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 pt-4">
                <!--  Passenger Details  -->
                <div class="passenger-details">
                    <div class="passenger-details-header d-flex justify-content-between">
                        <h5>Passenger Details</h5>
                    </div>
                    <div class="passenger-details-body mt-3" id="passenger-details-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="d-block font-weight-bold" for="passenger_name">Name</label>
                                <input type="text" name="passenger_name[]"
                                       class="form-control banner-form-input"
                                       id="passenger_name" placeholder="Passenger Name">
                                <span class="banner-form-input-highlight-text">Name should match with your
                                Travel Documents</span>
                            </div>
                            <div class="col-md-2">
                                <label class="d-block font-weight-bold" for="age">Age</label>
                                <select name="age[]" class="form-control banner-form-input" id="age">
                                    <option value="">Select Age</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="d-block font-weight-bold" for="gender">Gender</label>
                                <select name="gender[]" class="form-control banner-form-input" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="d-block font-weight-bold" for="infant">&nbsp;</label>
                                <input type="checkbox" name="infant[]" id="infant">
                                <span class="d-inline-block pl-2"><strong>Infant</strong>
                                <span>(Travelling with a child)</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 d-flex">
                            <a href="javascript:void(0);" onclick="addPassenger()"
                               class="passenger-details-plus-button">
                                <div class="passenger-details-plus-icon">
                                    <i class="icofont-plus"></i>
                                </div>
                                <span class="add-passenger-text">Add Passenger</span>
                            </a>
                        </div>
                    </div>
                    <div class="passenger-details-footer">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end">
                                <a href="payment.php"
                                   class="go-to-payment btn btn-danger banner-form-input text-decoration-none font-weight-bold px-3">Go
                                    to Payment
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Footer Area  -->
    <?php include 'footer.php'; ?>

</div>

<!-- Js Link -->
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/jquery.slim.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function (){
        for (let i = 1; i <= 80; i++){
            $('#age').append($('<option>', {
                value: i,
                text : i
            }));
        }
        
    });
    
    function addPassenger(){
        let element = (document.getElementById("passenger-details-body").children).length;
        let count   = "<?php echo $total_passenger; ?>";
        
        if (parseInt(element) == parseInt(count)){
            return false;
        } else{
            let html = `
            <div class="row">
                        <div class="col-md-3">
                            <label class="d-block font-weight-bold" for="passenger_name">Name</label>
                            <input type="text" name="passenger_name[]" class="form-control banner-form-input"
                                   id="passenger_name" placeholder="Passenger Name">
                            <span class="banner-form-input-highlight-text">Name should match with your
                                Travel Documents</span>
                        </div>
                        <div class="col-md-2">
                            <label class="d-block font-weight-bold" for="age">Age</label>
                            <select name="age[]" class="form-control banner-form-input" id="age">
                                <option value="">Select Age</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="d-block font-weight-bold" for="gender">Gender</label>
                            <select name="gender[]" class="form-control banner-form-input" id="gender">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="d-block font-weight-bold" for="infant">&nbsp;</label>
                            <input type="checkbox" name="infant[]" id="infant">
                            <span class="d-inline-block pl-2"><strong>Infant</strong>
                                <span>(Travelling with a child)</span></span>
                        </div>
                    </div>
        `;
            $("#passenger-details-body").append(html);
        }
    }
</script>
</body>
</html>