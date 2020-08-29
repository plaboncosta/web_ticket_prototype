<?php
include 'config.php';
session_start();
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
    <link rel="stylesheet" href="./assets/css/profile.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/searched-content.css">
</head>
<body>

<!--  Searched Content Area  -->
<?php include 'searched-content-area.php'; ?>

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
                <b class="ui-page-title">My Profile</b>
                <img src="./assets/images/profile.png" alt="">
            </div>
            <div id="pro2">
                <b class="ui-page-title">My Trips</b>
                <img src="./assets/images/myTrips.png" alt="">
            </div>
            <div id="pro3">
                <b class="ui-page-title">Meals</b>
                <img src="./assets/images/bookMeals.png" alt="">
            </div>
            <div id="pro4">
                <b class="ui-page-title">SMS Subscription</b>
                <img src="./assets/images/smsSubscription.png" alt="">
            </div>
            <div id="pro5">
                <b class="ui-page-title">Complaint</b>
                <img src="./assets/images/complaint.png" alt="">
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>
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
    
    $(document).ready(function (){
        getSearchedTicketData();
    });
</script>
</body>
</html>
