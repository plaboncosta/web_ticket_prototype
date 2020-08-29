<?php
include 'config.php';
session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$id = $_SESSION['ticket_search_insert_id'];

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
    <link rel="stylesheet" href="./assets/css/payment.css">
    <link rel="stylesheet" href="./assets/css/icofont.min.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
</head>
<body>
<!-- Wrapper Defined -->
<div id="wrapper">

    <div class="row mx-0 px-0 mb-5 ui-payment-container">
        <div class="col-md-12 pt-4">
            <!--  Train info  -->
            <?php include 'train-info.php'; ?>
        </div>
        <div class="col-md-12 pt-4">
            <!--  Passenger info  -->
            <!--  Train info  -->
            <div class="train-info bg-white shadowCustom">
                <h4 class="ui-header mb-5"><b>Passenger Details</b></h4>
                <div>
                    <?php foreach($passenger_info as $key => $item){ ?>
                        <div class="d-flex align-items-center <?php echo $key == 0 ? 'mb-5' : '' ?>">
                            <div class="col-md-8">
                                <div class="d-flex justify-content-between">
                                    <div class="w-50 d-flex">
                                        <div class="ui-avatar"><i class="icofont-user-alt-2"></i></div>
                                        <div>
                                            <h4 class="mb-3"><b><?php echo !empty($item['name']) ?
                                                        $item['name'] : '' ?></b></h4>
                                            <p><span><?php echo !empty($item['age']) ? $item['age'] : '' ?> years old | <?php echo !empty($item['gender']) ?
                                                        $item['gender'] : '' ?></span></p>
                                        </div>
                                    </div>
                                    <div class="w-50">
                                        <p><span>Class</span></p>
                                        <h4><b>AC Berth Class</b></h4>
                                    </div>
                                    <div class="w-50">
                                        <p><span>Date of Journey</span></p>
                                        <h4><b><?php echo !empty($ticket_search['date']) ? date("M j, Y",
                                                                                                strtotime($ticket_search['date'])) :
                                                    '' ?></b></h4>
                                    </div>
                                    <div class="w-50">
                                        <p><span>Fare</span></p>
                                        <h4><b>BDT 1,689.00</b></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div><h4 class="mb-3"><b>Availability Status: </b><b class="text-success">Available
                                            0002</b></h4></div>
                                <div class="bg-pink"><p>Please cary your ID card while traveling</p></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-12 pt-4">
            <!--  Bank info  -->
            <div class="bank-info shadowCustom">
                <div class="bank-info-header d-flex justify-content-between">
                    <h4 class="ui-header"><b>Choose your payment option</b></h4>
                    <div class="bank-info-header-right">
                        <h4 class="mb-0"><b>Amount to be paid:</b> <span
                                    class="font-weight-bold text-danger ml-3">BDT 2980.00</span></h4>
                        <span class="d-block text-right font-weight-bold mt-2">inclusive of all TAX</span>
                    </div>
                </div>
                <div class="bank-info-body">
                    <ul class="nav nav-tabs py-3">
                        <li class="active"><a class="active" data-toggle="tab" href="#card">Credit/Debit
                                Card</a></li>
                        <li><a data-toggle="tab" href="#mfs">MFS</a></li>
                        <li><a data-toggle="tab" href="#wallet">Wallet</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="card" class="tab-pane fade in active show">
                            <div class="row">
                                <div class="col-md-2">
                                    <input name="card_type" type="radio" value="visa" id="visa">
                                    <label for="visa">
                                        <img src="./assets/images/visa.png" width="60px" alt="">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <input name="card_type" type="radio" value="master-card" id="master-card">
                                    <label for="master-card">
                                        <img src="./assets/images/mastercard.jpg" width="45px" alt="">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <input name="card_type" type="radio" value="payment-card"
                                           id="payment-card">
                                    <label for="payment-card">
                                        <img src="./assets/images/payment-card-2.png" width="45px" alt="">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <input name="card_type" type="radio" value="american-express"
                                           id="american-express">
                                    <label for="american-express">
                                        <img src="./assets/images/american-express.png" width="45px" alt="">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <input name="card_type" type="radio" value="discover-card"
                                           id="discover-card">
                                    <label for="discover-card">
                                        <img src="./assets/images/discover-card.png" width="60px" alt="">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="mfs" class="tab-pane fade">
                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <input name="card_type" type="radio" value="bkash" id="bkash">
                                    <label for="bkash">
                                        <img src="./assets/images/bkash.jpg" width="80px" alt="">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <input name="card_type" type="radio" value="nagad" id="nagad">
                                    <label for="nagad">
                                        <img src="./assets/images/nagad.jpg" width="100px" alt="">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="wallet" class="tab-pane fade">
                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <input name="card_type" type="radio" value="br_wallet" id="br_wallet">
                                    <label for="br_wallet">
                                        BR Wallet
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bank-info-footer">
                    <div class="row">
                        <div class="col-md-8">
                            <span class="safe-secure-payments">Safe and Secure Payments</span>
                            <span class="condition">In case of cancellation, the refund will be applicable as
                                    New Railway Refund Rules, Please read <span class="text-danger">Terms and Conditions</span></span>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <button onclick="confirmPaymentModalShow()"
                                    class="confirm-payment btn btn-danger banner-form-input">Confirm
                                Payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Visa Card Modal  -->
    <div class="modal fade" id="visa-card" tabindex="-1" role="dialog" aria-labelledby="visaModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row mt-4">
                        <div class="col-md-12 visa-modal-image-area d-flex justify-content-center">
                            <img src="./assets/images/visa.png" alt="">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-7 offset-md-1">
                            <label for="card_number" class="font-weight-bold">CARD NUMBER</label>
                            <input type="text" name="card_number" class="form-control visa-card-input"
                                   id="card_number" placeholder="CARD NUMBER">
                        </div>
                        <div class="col-md-3">
                            <label for="cvc" class="font-weight-bold">CVC</label>
                            <input type="text" name="cvc" class="form-control visa-card-input"
                                   id="cvc" placeholder="CVC">
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-10 offset-md-1">
                            <label for="card_holder_name" class="font-weight-bold">CARD HOLDER NAME</label>
                            <input type="text" name="card_holder_name" class="form-control visa-card-input"
                                   id="card_holder_name" placeholder="Card Holder Name">
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-10 offset-md-1">
                            <label class="font-weight-bold">EXPIRATION DATE</label>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 offset-md-1">
                            <select name="month" class="form-control visa-card-input"
                                    id="month">
                                <option value="">Month</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="year" class="form-control visa-card-input" id="year">
                                <option value="">Year</option>
                            </select>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-10 offset-md-1">
                            <button onclick="getConfirmationModal()"
                                    class="btn btn-block btn-danger visa-card-input font-weight-bold visa-card-button">
                                COMPLETE
                                ORDER(TOTAL BDT 2980
                                .00)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Bkash Modal  -->
    <div class="modal fade" id="bkash-modal" tabindex="-1" role="dialog" aria-labelledby="visaModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row py-4">
                        <div class="col-md-10 offset-md-1">
                            <div class="bkash-modal-content">
                                <div class="bkash-modal-header">
                                    <div class="visa-modal-image-area d-flex justify-content-center">
                                        <img src="./assets/images/bkash.jpg" alt="">
                                    </div>
                                </div>
                                <div class="bkash-modal-body">
                                    <div class="row">
                                        <div class="col-md-12 bkash-checkout-text">
                                            <p>bKash Checkout</p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="merchant-details">
                                                <p>Merchant: BRITS</p>
                                                <p>Transaction id: fa542xAUhsq52</p>
                                                <p>Amount: BDT 2980</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <p class="bkash-account-number-text">Your bKash account number</p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-8 offset-md-2">
                                                    <input type="text" class="form-control"
                                                           name="bkash_number"
                                                           placeholder="eg. 01xxxxxxxxx">
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 bkash-terms-conditions-area">
                                            <input type="radio" name="" id="">
                                            <label for="" class="bkash-terms-conditions">I agree to the terms
                                                and
                                                conditions</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4 offset-md-2">
                                                    <button
                                                            class="btn btn-light py-2 px-3 bkash-modal-button"
                                                            onclick="showBKashConfirmationModal()">
                                                        PROCEED
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button
                                                            class="btn btn-light py-2 px-3 bkash-modal-button"
                                                            data-dismiss="modal">
                                                        CLOSE
                                                    </button>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Bkash Verification Modal  -->
    <div class="modal fade" id="bkash-verification-modal" tabindex="-1" role="dialog"
         aria-labelledby="visaModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row py-4">
                        <div class="col-md-10 offset-md-1">
                            <div class="bkash-modal-content">
                                <div class="bkash-modal-header">
                                    <div class="visa-modal-image-area d-flex justify-content-center">
                                        <img src="./assets/images/bkash.jpg" alt="">
                                    </div>
                                </div>
                                <div class="bkash-modal-body">
                                    <div class="row">
                                        <div class="col-md-12 bkash-checkout-text">
                                            <p>bKash Checkout</p>
                                        </div>
                                        <div class="col-md-12">
                                            <p class="bkash-account-number-text">Enter Verification Code</p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-8 offset-md-2">
                                                    <input type="text" class="form-control"
                                                           name="bkash_verification_code"
                                                           placeholder="xxxxx">
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row mt-5">
                                                <div class="col-md-4">
                                                    <button
                                                            class="btn btn-light py-2 px-3 bkash-modal-button"
                                                            onclick="showBKashPinModal()">
                                                        PROCEED
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button
                                                            class="btn btn-light py-2 px-3 bkash-modal-button">
                                                        RESEND
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button
                                                            class="btn btn-light py-2 px-3 bkash-modal-button"
                                                            data-dismiss="modal">
                                                        CLOSE
                                                    </button>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Bkash Pin Submission Modal  -->
    <div class="modal fade" id="bkash-pin-modal" tabindex="-1" role="dialog"
         aria-labelledby="bkashPinModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row py-4">
                        <div class="col-md-10 offset-md-1">
                            <div class="bkash-modal-content">
                                <div class="bkash-modal-header">
                                    <div class="visa-modal-image-area d-flex justify-content-center">
                                        <img src="./assets/images/bkash.jpg" alt="">
                                    </div>
                                </div>
                                <div class="bkash-modal-body">
                                    <div class="row">
                                        <div class="col-md-12 bkash-checkout-text">
                                            <p>bKash Checkout</p>
                                        </div>
                                        <div class="col-md-12">
                                            <p class="bkash-account-number-text">Enter Pin</p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-8 offset-md-2">
                                                    <input type="text" class="form-control"
                                                           name="bkash_pin"
                                                           placeholder="xxxx">
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row mt-5">
                                                <div class="col-md-4 offset-md-2">
                                                    <button onclick="getConfirmationModal()"
                                                            class="btn btn-light py-2 px-3 bkash-modal-button">
                                                        CONFIRM
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-light py-2 px-3 bkash-modal-button"
                                                            data-dismiss="modal">
                                                        CLOSE
                                                    </button>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Ticket Confirmation Modal  -->
    <div class="modal fade" id="ticket-confirmation" tabindex="-1" role="dialog"
         aria-labelledby="visaModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row py-4">
                        <div class="col-md-10 offset-md-1">
                            <div class="ticket-confirmation-content">
                                <div class="ticket-confirmation-header">
                                    <div class="d-flex justify-content-center">
                                        <img class="img-fluid" src="./assets/images/ticket-confirmation.png"
                                             alt="">
                                    </div>
                                </div>
                                <div class="ticket-confirmation-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button onclick="printTicket()"
                                                    class="btn btn-block btn-danger ticket-confirmation-button py-3">
                                                <i class="icofont-print"></i>
                                                Print the Ticket
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <button onclick="downloadTicket()"
                                                    class="btn btn-block btn-danger ticket-confirmation-button py-3">
                                                <i class="icofont-download"></i>
                                                Download
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <button onclick="window.location.href = 'profile.php'"
                                                    class="btn btn-block btn-danger ticket-confirmation-button py-3">
                                                <i class="icofont-home"></i>
                                                Home
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mt-4 ticket-confirmation-journey-area">
                                        <div class="col-md-6">
                                            <button onclick="window.location.href = 'trainDetails.php'"
                                                    class="btn btn-block ticket-confirmation-journey py-3">
                                                Book Another Journey
                                            </button>
                                        </div>
                                        <div class="col-md-6">
                                            <button onclick="window.location.href = 'trainDetails.php'"
                                                    class="btn btn-block ticket-confirmation-journey py-3">
                                                Book Return Journey
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="print-ticket-modal" tabindex="-1" role="dialog"
         aria-labelledby="visaModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body" style="height: 700px;">
                    <iframe id="print-ticket" src="./assets/images/print-image.png"
                            style="width: 100%; height: 100%"
                            frameborder="0"
                            allowfullscreen="false"></iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="download-ticket-modal" tabindex="-1" role="dialog"
         aria-labelledby="visaModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body" style="height: 700px;">
                    <iframe id="download-ticket" src="./assets/images/download-ticket.png"
                            style="width: 100%; height: 100%"
                            frameborder="0"
                            allowfullscreen="false"></iframe>
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
    function confirmPaymentModalShow(){
        let card_type = $("input[name='card_type']:checked").val();
        if (card_type == 'bkash'){
            $("#bkash-modal").modal('show');
        } else if (card_type == 'visa'){
            $("#visa-card").modal('show');
        } else{
            alert('Please select Visa or bKash Payment Gateway!');
        }
    }
    
    function showBKashConfirmationModal(){
        $("#bkash-modal").modal('hide');
        $("#bkash-verification-modal").modal('show');
    }
    
    function showBKashPinModal(){
        $("#bkash-verification-modal").modal('hide');
        $("#bkash-pin-modal").modal('show');
    }
    
    function getConfirmationModal(){
        $("#bkash-pin-modal").modal('hide');
        $("#visa-card").modal('hide');
        $("#ticket-confirmation").modal('show');
    }
    
    function printTicket(){
        $("#print-ticket-modal").modal('show');
        $("#print-ticket").on("load", function (){
            $(this).contents().find('img').css({width: '100%', height: '100%', objectFit: 'cover'});
            
        });
    }
    
    function downloadTicket(){
        $("#download-ticket-modal").modal('show');
        $("#download-ticket").on("load", function (){
            $(this).contents().find('img').css({width: '100%', height: '100%', objectFit: 'cover'});
            
        });
    }
</script>
</body>
</html>