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
                                <a class="nav-link" href="javascript:void(0);"
                                   onclick="loginFromMenu()">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);"
                                   onclick="registrationFromMenu()">Register</a>
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
                                <input type="hidden" name="login_from_menu" value="false">
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
                                <input type="hidden" name="registration_from_menu" value="false">
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
                                        <label for="" class="cursor-pointer">I agree to the <span
                                                    class="text-success" onclick="showTermsAndConditions()">Terms of Service</span></label>
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

    <!--  Terms and Conditions Modal  -->
    <div class="modal fade" id="terms-and-conditions-modal" tabindex="-1" role="dialog"
         aria-labelledby="termsAndConditionModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="login-modal-close-button">
                    <i class="icofont-close-line-circled" data-dismiss="modal"></i>
                </div>
                <div class="modal-header login-modal-header-area">
                    <h5 class="modal-title login-modal-title" id="termsAndConditionModalLabel">Terms and
                        Conditions</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="article" id="content">
                                <div id="placeholders">
                                    <h2><strong>Terms and Conditions</strong></h2>
                                    <p>Welcome to <span class="highlight preview_website_name">E Ticket Online Platform</span>!
                                    </p>
                                    <p>These terms and conditions outline the rules and regulations for the
                                        use of <span
                                                class="highlight preview_company_name">Company Name</span>'s
                                        Website, located at <span
                                                class="highlight preview_website_url">Website.com</span>.</p>
                                    <p>By accessing this website we assume you accept these terms and
                                        conditions. Do not continue to use <span
                                                class="highlight preview_website_name">Website Name</span> if
                                        you do not agree to take all of the
                                        terms and conditions stated on this page.</p>
                                    <p>The following terminology applies to these Terms and Conditions,
                                        Privacy Statement and Disclaimer Notice and
                                        all Agreements: “Client”, “You” and “Your” refers to you, the person
                                        log on this website and compliant to the
                                        Company's terms and conditions. “The Company”, “Ourselves”, “We”,
                                        “Our” and “Us”, refers to our Company.
                                        “Party”, “Parties”, or “Us”, refers to both the Client and ourselves.
                                        All terms refer to the offer, acceptance
                                        and consideration of payment necessary to undertake the process of our
                                        assistance to the Client in the most
                                        appropriate manner for the express purpose of meeting the Client's
                                        needs in respect of provision of the
                                        Company's stated services, in accordance with and subject to,
                                        prevailing law of Netherlands. Any use of the
                                        above terminology or other words in the singular, plural,
                                        capitalization and/or he/she or they, are taken as
                                        interchangeable and therefore as referring to same.</p>
                                    <h3><strong>Cookies</strong></h3>
                                    <p>We employ the use of cookies. By accessing <span
                                                class="highlight preview_website_name">Website Name</span>,
                                        you agreed to use cookies in agreement with the <span
                                                class="highlight preview_company_name">Company Name</span>'s
                                        Privacy Policy.</p>
                                    <p>Most interactive websites use cookies to let us retrieve the user's
                                        details for each visit. Cookies are used by
                                        our website to enable the functionality of certain areas to make it
                                        easier for people visiting our website.
                                        Some of our affiliate/advertising partners may also use cookies.</p>
                                    <h3><strong>License</strong></h3>
                                    <p>Unless otherwise stated, <span class="highlight preview_company_name">Company Name</span>
                                        and/or its licensors
                                        own the intellectual property rights for all material on <span
                                                class="highlight preview_website_name">Website Name</span>.
                                        All intellectual property rights are reserved. You may access this
                                        from <span
                                                class="highlight preview_website_name">Website Name</span> for
                                        your own personal use subjected to
                                        restrictions set in these terms and conditions.</p>
                                    <p>You must not:</p>
                                    <ul>
                                        <li>Republish material from <span
                                                    class="highlight preview_website_name">Website Name</span>
                                        </li>
                                        <li>Sell, rent or sub-license material from <span
                                                    class="highlight preview_website_name">Website Name</span>
                                        </li>
                                        <li>Reproduce, duplicate or copy material from <span
                                                    class="highlight preview_website_name">Website Name</span>
                                        </li>
                                        <li>Redistribute content from <span
                                                    class="highlight preview_website_name">Website Name</span>
                                        </li>
                                    </ul>
                                    <p>This Agreement shall begin on the date hereof.</p>
                                    <p>Parts of this website offer an opportunity for users to post and
                                        exchange opinions and information in certain
                                        areas of the website. <span class="highlight preview_company_name">Company Name</span>
                                        does not filter, edit,
                                        publish or review Comments prior to their presence on the website.
                                        Comments do not reflect the views and
                                        opinions of <span
                                                class="highlight preview_company_name">Company Name</span>,its
                                        agents and/or affiliates.
                                        Comments reflect the views and opinions of the person who post their
                                        views and opinions. To the extent
                                        permitted by applicable laws, <span
                                                class="highlight preview_company_name">Company Name</span>
                                        shall not be
                                        liable for the Comments or for any liability, damages or expenses
                                        caused and/or suffered as a result of any
                                        use of and/or posting of and/or appearance of the Comments on this
                                        website.</p>
                                    <p><span class="highlight preview_company_name">Company Name</span>
                                        reserves the right to monitor all Comments and
                                        to remove any Comments which can be considered inappropriate,
                                        offensive or causes breach of these Terms and
                                        Conditions.</p>
                                    <p>You warrant and represent that:</p>
                                    <ul>
                                        <li>You are entitled to post the Comments on our website and have all
                                            necessary licenses and consents to do
                                            so;
                                        </li>
                                        <li>The Comments do not invade any intellectual property right,
                                            including without limitation copyright, patent
                                            or trademark of any third party;
                                        </li>
                                        <li>The Comments do not contain any defamatory, libelous, offensive,
                                            indecent or otherwise unlawful material
                                            which is an invasion of privacy
                                        </li>
                                        <li>The Comments will not be used to solicit or promote business or
                                            custom or present commercial activities or
                                            unlawful activity.
                                        </li>
                                    </ul>
                                    <p>You hereby grant <span class="highlight preview_company_name">Company Name</span>
                                        a non-exclusive license to
                                        use, reproduce, edit and authorize others to use, reproduce and edit
                                        any of your Comments in any and all
                                        forms, formats or media.</p>
                                    <h3><strong>Hyperlinking to our Content</strong></h3>
                                    <p>The following organizations may link to our Website without prior
                                        written approval:</p>
                                    <ul>
                                        <li>Government agencies;</li>
                                        <li>Search engines;</li>
                                        <li>News organizations;</li>
                                        <li>Online directory distributors may link to our Website in the same
                                            manner as they hyperlink to the Websites
                                            of other listed businesses; and
                                        </li>
                                        <li>System wide Accredited Businesses except soliciting non-profit
                                            organizations, charity shopping malls, and
                                            charity fundraising groups which may not hyperlink to our Web
                                            site.
                                        </li>
                                    </ul>
                                    <p>These organizations may link to our home page, to publications or to
                                        other Website information so long as the
                                        link: (a) is not in any way deceptive; (b) does not falsely imply
                                        sponsorship, endorsement or approval of the
                                        linking party and its products and/or services; and (c) fits within
                                        the context of the linking party's
                                        site.</p>
                                    <p>We may consider and approve other link requests from the following
                                        types of organizations:</p>
                                    <ul>
                                        <li>commonly-known consumer and/or business information sources;</li>
                                        <li>dot.com community sites;</li>
                                        <li>associations or other groups representing charities;</li>
                                        <li>online directory distributors;</li>
                                        <li>internet portals;</li>
                                        <li>accounting, law and consulting firms; and</li>
                                        <li>educational institutions and trade associations.</li>
                                    </ul>
                                    <p>We will approve link requests from these organizations if we decide
                                        that: (a) the link would not make us look
                                        unfavorably to ourselves or to our accredited businesses; (b) the
                                        organization does not have any negative
                                        records with us; (c) the benefit to us from the visibility of the
                                        hyperlink compensates the absence of <span
                                                class="highlight preview_company_name">Company Name</span>;
                                        and (d) the link is in the context of
                                        general resource information.</p>
                                    <p>These organizations may link to our home page so long as the link: (a)
                                        is not in any way deceptive; (b) does
                                        not falsely imply sponsorship, endorsement or approval of the linking
                                        party and its products or services; and
                                        (c) fits within the context of the linking party's site.</p>
                                    <p>If you are one of the organizations listed in paragraph 2 above and are
                                        interested in linking to our website,
                                        you must inform us by sending an e-mail to <span
                                                class="highlight preview_company_name">Company Name</span>.
                                        Please include your name, your organization name, contact information
                                        as well as the URL of your site, a list
                                        of any URLs from which you intend to link to our Website, and a list
                                        of the URLs on our site to which you
                                        would like to link. Wait 2-3 weeks for a response.</p>
                                    <p>Approved organizations may hyperlink to our Website as follows:</p>
                                    <ul>
                                        <li>By use of our corporate name; or</li>
                                        <li>By use of the uniform resource locator being linked to; or</li>
                                        <li>By use of any other description of our Website being linked to
                                            that makes sense within the context and
                                            format of content on the linking party's site.
                                        </li>
                                    </ul>
                                    <p>No use of <span
                                                class="highlight preview_company_name">Company Name</span>'s
                                        logo or other artwork will be
                                        allowed for linking absent a trademark license agreement.</p>
                                    <h3><strong>iFrames</strong></h3>
                                    <p>Without prior approval and written permission, you may not create
                                        frames around our Webpages that alter in any
                                        way the visual presentation or appearance of our Website.</p>
                                    <h3><strong>Content Liability</strong></h3>
                                    <p>We shall not be hold responsible for any content that appears on your
                                        Website. You agree to protect and defend
                                        us against all claims that is rising on your Website. No link(s)
                                        should appear on any Website that may be
                                        interpreted as libelous, obscene or criminal, or which infringes,
                                        otherwise violates, or advocates the
                                        infringement or other violation of, any third party rights.</p>
                                    <h3><strong>Reservation of Rights</strong></h3>
                                    <p>We reserve the right to request that you remove all links or any
                                        particular link to our Website. You approve to
                                        immediately remove all links to our Website upon request. We also
                                        reserve the right to amen these terms and
                                        conditions and it's linking policy at any time. By continuously
                                        linking to our Website, you agree to be bound
                                        to and follow these linking terms and conditions.</p>
                                    <h3><strong>Removal of links from our website</strong></h3>
                                    <p>If you find any link on our Website that is offensive for any reason,
                                        you are free to contact and inform us any
                                        moment. We will consider requests to remove links but we are not
                                        obligated to or so or to respond to you
                                        directly.</p>
                                    <p>We do not ensure that the information on this website is correct, we do
                                        not warrant its completeness or
                                        accuracy; nor do we promise to ensure that the website remains
                                        available or that the material on the website
                                        is kept up to date.</p>
                                    <h3><strong>Disclaimer</strong></h3>
                                    <p>To the maximum extent permitted by applicable law, we exclude all
                                        representations, warranties and conditions
                                        relating to our website and the use of this website. Nothing in this
                                        disclaimer will:</p>
                                    <ul>
                                        <li>limit or exclude our or your liability for death or personal
                                            injury;
                                        </li>
                                        <li>limit or exclude our or your liability for fraud or fraudulent
                                            misrepresentation;
                                        </li>
                                        <li>limit any of our or your liabilities in any way that is not
                                            permitted under applicable law; or
                                        </li>
                                        <li>exclude any of our or your liabilities that may not be excluded
                                            under applicable law.
                                        </li>
                                    </ul>
                                    <p>The limitations and prohibitions of liability set in this Section and
                                        elsewhere in this disclaimer: (a) are
                                        subject to the preceding paragraph; and (b) govern all liabilities
                                        arising under the disclaimer, including
                                        liabilities arising in contract, in tort and for breach of statutory
                                        duty.</p>
                                    <p>As long as the website and the information and services on the website
                                        are provided free of charge, we will not
                                        be liable for any loss or damage of any nature.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="user_id"
       value="<?php echo !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : '' ?>">

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
                if (result.login_from_menu){
                    window.location.reload();
                } else{
                    window.location.href = 'trainDetails.php';
                }
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
        let passenger_no = $("select[name='passenger_no']").val();
        let child_no     = $("select[name='child_no']").val();
        
        if (parseInt(passenger_no) + parseInt(child_no) > 4){
            alert('You can select maximum 4 passengers(including child)!');
            return false;
        }
        
        $.ajax({
            url   : base + '/db.php',
            method: 'POST',
            data  : $("#searchTicketForm").serialize(),
        }).done(function (response){
            let result = JSON.parse(response);
            if (result.success){
                $("input[name='login_from_menu']").val(false);
                $("input[name='registration_from_menu']").val(false);
                
                let user_id = $("input[name='user_id']").val();
                if (user_id){
                    window.location.href = 'trainDetails.php';
                } else{
                    $("#login-modal").modal('show');
                }
            }
        });
    }
    
    function confirmOTPNumber(){
        $("#mobile-otp-modal").modal('hide');
        
        let registration_from_menu = $("input[name='registration_from_menu']").val();
        if (registration_from_menu == 'true'){
            window.location.reload();
        } else{
            window.location.href = 'trainDetails.php';
        }
    }
    
    function loginFromMenu(){
        $("input[name='login_from_menu']").val(true);
        $("#login-modal").modal('show');
    }
    
    function registrationFromMenu(){
        $("input[name='registration_from_menu']").val(true);
        $("#registration-modal").modal('show');
    }
    
    function showTermsAndConditions(){
        $('#terms-and-conditions-modal').modal('show');
    }
</script>
</body>
</html>