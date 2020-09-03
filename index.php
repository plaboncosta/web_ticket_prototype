<?php
include 'config.php';
session_start();

$string       = file_get_contents("./assets/json/station_list.json");
$station_list = json_decode($string, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BANGLADESH RAILWAY TICKETS</title>
    <link rel="shortcut icon" type="image/jpg" href="./assets/images/britslogo.png" />

    <!--  Css Link  -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/icofont.min.css">
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/home.css">
    <style>
        .modal-lg {
            width: 650px !important;
            }
    </style>
</head>
<body>
<!-- Wrapper Defined -->
<div id="wrapper">

    <!--  Banner Area  -->
    <div class="banner-area">
        <div class="banner-overlay"></div>
        <div class="position-relative ui-body">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <img src="./assets/images/britslogo.png" class="logo-image" alt="">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <?php if(isset($_SESSION['user_id'])){ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);" onclick="logOutUser()">Log
                                    out</a>
                            </li>
                        <?php } else{ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Register</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ENG
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">BANG</a>
                                <a class="dropdown-item" href="#">ENG</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="banner-text">
                <h3>BANGLADESH RAILWAY</h3>
                <p>Safety l Security l Punctuality</p>
            </div>
            <div class="banner-form">
                <div class="banner-form-header">
                    <h5>Book Tickets</h5>
                </div>
                <div class="banner-form-body">
                    <form onsubmit="searchTicketInfo(); return false;" id="searchTicketForm">
                        <input type="hidden" name="id">
                        <input type="hidden" name="action" value="search-ticket">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="d-block font-weight-bold" for="from">FROM</label>
                                <select name="departure" class="form-control banner-form-input" id="from"
                                        required>
                                    <option value="">Departure</option>
                                    <?php foreach($station_list as $item){ ?>
                                        <option value="<?php echo $item['stn_name']; ?>"><?php echo $item['stn_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="banner-form-input-highlight-text">Starting Location</span>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="d-block font-weight-bold" for="to">TO</label>
                                <select name="arrival" class="form-control banner-form-input" id="to"
                                        required>
                                    <option value="">Arrival</option>
                                    <?php foreach($station_list as $item){ ?>
                                        <option value="<?php echo $item['stn_name']; ?>"><?php echo $item['stn_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="banner-form-input-highlight-text">Where to go</span>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="d-block font-weight-bold" for="date">DATE</label>
                                <input type="date" name="date"
                                       class="form-control banner-form-input restrict-date"
                                       id="date" required>
                                <span class="banner-form-input-highlight-text">Depart Date</span>
                            </div>
                            <div class="col-md-3">
                                <label class="d-block font-weight-bold">&nbsp;</label>
                                <button type="submit"
                                        class="btn btn-danger btn-block font-weight-bold text-decoration-none">
                                    Find Trains
                                    <i class="icofont-search d-inline-block pl-1"></i>
                                </button>
                                <span class="banner-form-input-highlight-text">Click here for advanced
                                    options</span>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="d-block font-weight-bold" for="class">CLASS</label>
                                <select name="class" class="form-control banner-form-input" id="class"
                                        required>
                                    <option value="">Choose a class</option>
                                    <option value="AC_B">AC_B</option>
                                    <option value="AC_S">AC_S</option>
                                    <option value="F_BERTH">F_BERTH</option>
                                    <option value="F_SEAT">F_SEAT</option>
                                    <option value="SHOVAN">SHOVAN</option>
                                    <option value="S_CHAIR">S_CHAIR</option>
                                </select>
                                <span class="banner-form-input-highlight-text">Select a Class</span>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="d-block font-weight-bold" for="passenger">PASSENGER(S)</label>
                                <select name="passenger_no" class="form-control banner-form-input"
                                        id="passenger" required>
                                    <option value="">Select no of Adult's</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                </select>
                                <span class="banner-form-input-highlight-text">Adult Passenger(s)</span>
                                <span class="banner-form-input-highlight-text">
                                    <span class="d-block">
                                        <span class="text-danger">*</span>
                                        <span>Maximum 4 seats can be issued</span>
                                    </span>
                                </span>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="d-block font-weight-bold" for="child">CHILD</label>
                                <select name="child_no" class="form-control banner-form-input" id="child">
                                    <option value="">Select no of Child's</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                </select>
                                <span class="banner-form-input-highlight-text">Child Passenger(s)</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--  Home Page Body Area  -->
    <div class="home-page-body bg-white">
        <div class="ui-top position-relative">
            <p class="ui-title">FIND YOUR WAY</p>
            <p class="ui-subTitle">We Make Travel Easy</p>
        </div>
        <img src="./assets/images/slider.png" alt="">
    </div>

    <!--  Footer Area  -->
    <?php include 'footer.php'; ?>

    <!--  Login Modal  -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="login-modal-close-button">
                    <i class="icofont-close-line-circled" data-dismiss="modal"></i>
                </div>
                <div class="modal-header login-modal-header-area">
                    <h5 class="modal-title login-modal-title" id="exampleModalLabel">Login</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <form onsubmit="searchTicketDetails(); return false;" id="loginForm">
                                <input type="hidden" name="action" value="login">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="d-block font-weight-bold" for="mobile_number">Mobile
                                            Number</label>
                                        <input type="number" class="form-control banner-form-input"
                                               name="mobile_number" minlength="11" maxlength="11"
                                               oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                               id="mobile_number" placeholder="Mobile Number" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-block font-weight-bold"
                                               for="password">Password</label>
                                        <input type="password" class="form-control banner-form-input"
                                               name="password" minlength="6"
                                               id="password" placeholder="Password" required>
                                    </div>
                                    <div class="col-md-6 offset-md-6 text-success">
                                        Forget Password?
                                    </div>
                                    <div class="col-md-12 pt-3">
                                        <button type="submit"
                                                class="btn btn-danger btn-block font-weight-bold banner-form-input login-modal-button">
                                            Login
                                        </button>
                                    </div>
                                    <div class="col-md-12 pt-1 text-center">
                                        <p>Don't have an account?
                                            <span class="text-success cursor-pointer"
                                                  onclick="showRegistrationModal()">Sign
                                                    up</span>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Registration Modal  -->
    <div class="modal fade" id="registration-modal" tabindex="-1" role="dialog"
         aria-labelledby="registrationModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="registration-modal-close-button">
                    <i class="icofont-close-line-circled" data-dismiss="modal"></i>
                </div>
                <div class="modal-header registration-modal-header-area">
                    <h5 class="modal-title registration-modal-title" id="registrationModalLabel">Sign Up</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <form onsubmit="searchLoginModal(); return false;" id="registrationForm">
                                <input type="hidden" name="id">
                                <input type="hidden" name="action" value="registration-form">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="d-block font-weight-bold" for="first_name">First
                                            Name</label>
                                        <input type="text" class="form-control banner-form-input"
                                               name="first_name"
                                               id="first_name" placeholder="First Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-block font-weight-bold" for="reg_last_name">Last
                                            Name</label>
                                        <input type="text" class="form-control banner-form-input"
                                               name="last_name" id="reg_last_name" placeholder="Last Name"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-block font-weight-bold" for="phone_number">Mobile
                                            Number</label>
                                        <input type="number" class="form-control banner-form-input"
                                               name="phone_number"
                                               oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                               id="phone_number" placeholder="Retype Mobile Number"
                                               minlength="11" maxlength="11"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-block font-weight-bold" for="confirm_phone">Confirm
                                            Mobile
                                            Number</label>
                                        <input type="number" class="form-control banner-form-input"
                                               name="confirm_phone"
                                               oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                               id="confirm_phone" placeholder="Confirm Mobile Number"
                                               minlength="11" maxlength="11"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-block font-weight-bold" for="national_id">National
                                            Id Number</label>
                                        <input type="text" class="form-control banner-form-input"
                                               name="national_id"
                                               id="national_id" placeholder="National Id Number" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-block font-weight-bold" for="reg_email">Email
                                            Address</label>
                                        <input type="email" class="form-control banner-form-input"
                                               name="email"
                                               id="reg_email" placeholder="Email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-block font-weight-bold" for="reg_password">Password
                                        </label>
                                        <input type="password" class="form-control banner-form-input"
                                               name="password" minlength="6"
                                               id="reg_password" placeholder="Password" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-block font-weight-bold"
                                               for="confirm_password">Confirm
                                            Password </label>
                                        <input type="password" class="form-control banner-form-input"
                                               name="confirm_password" minlength="6"
                                               id="confirm_password" placeholder="Retype Confirm Password"
                                               required>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" class="text-success" name="terms_of_service"
                                               id="terms_of_service" required>
                                        <label for="terms_of_service">I agree to the <span
                                                    class="text-success">Terms of Service</span></label>
                                    </div>
                                    <div class="col-md-12 pt-3">
                                        <button type="submit"
                                                class="btn btn-danger btn-block font-weight-bold banner-form-input registration-modal-button">
                                            Sign Up
                                        </button>
                                    </div>
                                    <div class="col-md-12 pt-1 text-center">
                                        <p>Already Registered?
                                            <span class="text-success cursor-pointer"
                                                  onclick="showLoginModal()">Login
                                                </span>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  OTP Modal  -->
    <button class="btn btn-success" data-toggle="modal" data-target="#mobile-otp-modal">OTP</button>
    <div class="modal fade" id="mobile-otp-modal" tabindex="-1" role="dialog" aria-labelledby="mobileOtpModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="login-modal-close-button">
                    <i class="icofont-close-line-circled" data-dismiss="modal"></i>
                </div>
                <div class="modal-header login-modal-header-area">
                    <h5 class="modal-title login-modal-title" id="mobileOtpModal">OTP Confirmation</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <form onsubmit="confirmOTPNumber(); return false;" id="otpForm">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="d-block font-weight-bold" for="otp_number">OTP
                                            Number</label>
                                        <input type="text" class="form-control banner-form-input"
                                               name="otp_number" minlength="5" maxlength="5"
                                               id="mobile_number" placeholder="OTP Number" required>
                                    </div>
                                    <div class="col-md-12 pt-3">
                                        <button type="submit"
                                                class="btn btn-danger btn-block font-weight-bold banner-form-input login-modal-button">
                                            Confirm
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Js Link -->
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/custom.script.js"></script>

<script>
    let base = "<?php echo $base_url; ?>";
    
    function searchTicketInfo(){
        addSearchedTicketInfo();
    }
    
    function searchLoginModal(){
        let phone_number     = $("#phone_number").val();
        let confirm_phone    = $("#confirm_phone").val();
        let reg_password     = $("#reg_password").val();
        let confirm_password = $("#confirm_password").val();
        
        if (phone_number != confirm_phone){
            alert('Phone Number And Confirm Phone Number are not matched!');
            return false;
        }
        
        if (reg_password != confirm_password){
            alert('Password and Confirm Password are not matched!');
            return false;
        }
        
        $.ajax({
            url   : base + '/db.php',
            method: 'POST',
            data  : $("#registrationForm").serialize(),
        }).done(function (response){
            let result = JSON.parse(response);
            if (result.success){
                $("#registration-modal").modal('hide');
                $("#mobile-otp-modal").modal('show');
            }
        });
    }
    
    function searchTicketDetails(){
        $.ajax({
            url   : base + '/db.php',
            method: 'POST',
            data  : $("#loginForm").serialize(),
        }).done(function (response){
            let result = JSON.parse(response);
            if (result.success){
                $("#login-modal").modal('hide');
                window.location.href = 'trainDetails.php';
            } else{
                alert(result.message);
            }
        });
    }
    
    function showRegistrationModal(){
        $("#login-modal").modal('hide');
        $("#registration-modal").modal('show');
    }
    
    function showLoginModal(){
        $("#registration-modal").modal('hide');
        $("#login-modal").modal('show');
    }
    
    function addSearchedTicketInfo(){
        $.ajax({
            url   : base + '/db.php',
            method: 'POST',
            data  : $("#searchTicketForm").serialize(),
        }).done(function (response){
            let result = JSON.parse(response);
            if (result.success){
                $("#login-modal").modal('show');
            }
        });
    }
    
    function confirmOTPNumber(){
        $("#mobile-otp-modal").modal('hide');
        window.location.href = 'trainDetails.php';
    }
</script>
</body>
</html>