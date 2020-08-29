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

    <div class="row mx-0 px-0 mb-5">
        <div class="col-md-12 pt-4">
            <!--  Train info  -->
            <div class="train-info">
                <img src="./assets/images/payment-page-train-info.png" alt="">
            </div>
        </div>

        <div class="col-md-12 pt-4">
            <!--  Seat Selection info  -->
            <div class="seat-selection-info">
                <img src="./assets/images/seat-selection-info.png" alt="">
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
                        <img src="./assets/images/seat-selection.png" alt="">
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

    <!--  Footer Area  -->
    <?php include 'footer.php';?>

</div>

<!-- Js Link -->
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/jquery.slim.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function (){
        for (let i = 0; i <= 80; i++){
            $('#age').append($('<option>', {
                value: i,
                text : i
            }));
        }
    });

    function addPassenger(){
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
</script>
</body>
</html>