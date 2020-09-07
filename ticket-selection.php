<?php
include 'config.php';
session_start();

if( !$_SESSION["user_id"]){
    $redirect_url = $base_url . '/index.php';
    header('Location: ' . $redirect_url);
}

$user_info = $_SESSION['user_info'];

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
    <title>BANGLADESH RAILWAY TICKETS</title>
    <link rel="shortcut icon" type="image/jpg" href="./assets/images/britslogo.png" />

    <!--  Css Link  -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link rel="stylesheet" href="./assets/css/ticket-selection.css">
    <link rel="stylesheet" href="./assets/css/icofont.min.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/searched-content.css">
</head>
<body>
<!-- Wrapper Defined -->
<div id="wrapper">
    <?php include 'navbar.php'; ?>

    <div class="p-4">
        <div class="row mx-0 px-0">
            <div class="col-md-12 pt-4">
                <!--  Train info  -->
                <?php include 'train-info.php'; ?>
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
                            <div class="mt-3 seat-selection-info coach-legend-area">
                                <h4>Coach Legend</h4>
                                <div class="mt-4 d-flex row">
                                    <div class="col-md-8">
                                        <p>Lower Berth</p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="seat-selection-symbol seat-selection-red-symbol"></div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="d-flex row">
                                    <div class="col-md-8">
                                        <p>Upper Berth</p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="seat-selection-symbol seat-selection-green-symbol"></div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="d-flex row">
                                    <div class="col-md-8">
                                        <p>Booked Seat</p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="seat-selection-symbol seat-selection-black-symbol"></div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="d-flex row">
                                    <div class="col-md-8">
                                        <p>Selected Seat</p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="seat-selection-symbol bg-danger"></div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex">
                                <p class="pl-3 seat-selection-coach-id-text">Select Coach ID</p>
                                <div class="seat-selection-coach-number-first cursor-pointer" id="toggleSit">
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
                                    <div class="ui-train-subContainer ui-overlay">
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
                                                    <div class="ui-singleSit bg-red cursor-pointer">L</div>
                                                    <div class="ui-singleSit bg-green cursor-pointer">U</div>
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
                        <div class="col-md-2">
                            <div class="d-flex flex-column justify-content-center h-100 ml-2">
                                <p><b>Selected Seats</b></p>
                                <p class="text-danger"><b>One: <span id="valOne"></span></b></p>
                                <p class="text-danger"><b>Two: <span id="valTwo"></span></b></p>
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
                    <form onsubmit="addPassengerInformation(); return false;" id="passengerInfoForm">
                        <input type="hidden" name="action" value="add_passenger">
                        <input type="hidden" name="hidden_infant" id="hidden_infant">
                        <div class="passenger-details-body mt-3" id="passenger-details-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="d-block font-weight-bold" for="passenger_name">Name</label>
                                    <input type="text" name="passenger_name[]"
                                           value="<?php echo !empty($user_info['first_name']) ?
                                               $user_info['first_name'] :
                                               '' ?> <?php echo !empty($user_info['last_name']) ?
                                               $user_info['last_name'] :
                                               '' ?>"
                                           class="form-control banner-form-input"
                                           id="passenger_name" placeholder="Passenger Name" required>
                                    <span class="banner-form-input-highlight-text">Name should match with your
                                Travel Documents</span>
                                </div>
                                <div class="col-md-2">
                                    <label class="d-block font-weight-bold" for="age">Age</label>
                                    <select name="age[]" class="form-control banner-form-input" id="age"
                                            required>
                                        <option value="">Select Age</option>
                                        <?php for($i = 1; $i <= 80; $i ++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="d-block font-weight-bold" for="gender">Gender</label>
                                    <select name="gender[]" class="form-control banner-form-input"
                                            id="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="d-block font-weight-bold">&nbsp;</label>
                                    <input type="checkbox" name="infant[]" class="infant_class">
                                    <label for="infant"><span
                                                class="d-inline-block pl-2"><strong>Infant</strong></label>
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
                                    <button type="submit"
                                            class="go-to-payment btn btn-danger banner-form-input font-weight-bold px-3">
                                        Go
                                        to Payment
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--  Footer Area  -->
    <?php include 'footer.php'; ?>

</div>

<!-- Js Link -->
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/custom.script.js"></script>
<script>
    let base           = "<?php echo $base_url; ?>";
    let valOne         = document.getElementById('valOne');
    let valTwo         = document.getElementById('valTwo');
    let togSit         = document.getElementById('toggleSit');
    let overLay        = document.querySelector('.ui-train-subContainer');
    let greenSit       = document.querySelector('.bg-green');
    let redSit         = document.querySelector('.bg-red');
    let selectedSitOne = null;
    let selectedSitTwo = null;
    
    togSit.addEventListener('click', () => {
        overLay.classList.toggle('ui-overlay');
        if (togSit.style.background === "darkgreen"){
            togSit.style.background = "white";
            togSit.style.color      = 'black';
        } else{
            togSit.style.background = "darkgreen";
            togSit.style.color      = 'white';
        }
    });
    
    greenSit.addEventListener('click', () => {
        if (togSit.style.background === "darkgreen"){
            if (greenSit.style.background === 'darkred'){
                greenSit.style.background = '#34da90';
                selectedSitTwo            = null;
                valTwo.innerHTML          = null;
            } else{
                greenSit.style.background = 'darkred';
                selectedSitTwo            = 'A1-01-U-32';
                valTwo.innerHTML          = 'A1-01-U-32';
            }
        }
    });
    
    redSit.addEventListener('click', () => {
        if (togSit.style.background === "darkgreen"){
            if (redSit.style.background === 'darkred'){
                redSit.style.background = '#fe838f';
                selectedSitOne          = null;
                valOne.innerHTML        = null;
            } else{
                redSit.style.background = 'darkred';
                selectedSitOne          = 'A1-01-L-31';
                valOne.innerHTML        = 'A1-01-L-31';
            }
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
                                        <?php for($i = 1; $i <= 80; $i ++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="d-block font-weight-bold" for="gender">Gender</label>
                                    <select name="gender[]" class="form-control banner-form-input"
                                            id="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="d-block font-weight-bold" for="infant">&nbsp;</label>
                                    <input type="checkbox" name="infant[]" class="infant_class">
                                    <label for="infant"><span class="d-inline-block pl-2"><strong>Infant</strong></label>
                                <span>(Travelling with a child)</span></span>
                                </div>
                            </div>
        `;
            $("#passenger-details-body").append(html);
        }
    }
    
    function addPassengerInformation(){
        let infant_array = [];
        $('input:checkbox.infant_class').each(function (){
            infant_array.push(this.checked ? 1 : 0);
        });
        
        $("#hidden_infant").val(infant_array);
        
        $.ajax({
            url   : base + '/db.php',
            method: 'POST',
            data  : $("#passengerInfoForm").serialize(),
        }).done(function (response){
            let result = JSON.parse(response);
            if (result.success){
                window.location.href = 'payment.php';
            } else{
                alert('Something went wrong');
            }
        });
    }
</script>
</body>
</html>