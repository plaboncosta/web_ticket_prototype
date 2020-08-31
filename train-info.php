<div class="train-info bg-white shadowCustom">
    <h4 class="ui-header mb-5"><b>Train Info</b></h4>
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <div class="mr-5">
                <h5 class="mb-0"><b>PANCHAGARH EXPRESS(793)</b></h5>
            </div>
            <div class="mr-1 ml-5">
                <b class="ui-top"><?php echo !empty($ticket_search['departure']) ?
                        $ticket_search['departure'] : ''; ?></b>
                <p class="mb-0">12:10 AM</p>
            </div>
            <div class="mr-1 ml-3">
                <i class="icofont-rounded-right"></i>
            </div>
            <div class="mr-5 ml-3">
                <b class="ui-top"><?php echo !empty($ticket_search['arrival']) ?
                        $ticket_search['arrival'] : ''; ?></b>
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
                                                                                   strtotime($ticket_search['date'])) :
                        '' ?></b>
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