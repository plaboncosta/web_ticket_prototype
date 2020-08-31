<div class="searched-content-area">
    <div class="searched-content-overlay"></div>
    <div class="position-relative ui-body">
        <?php include 'navbar.php'; ?>
        <div class="searched-content-form-body">
            <div class="row">
                <div class="col-md-2">
                    <img src="./assets/images/britslogo.png" class="logo-image" alt="">
                </div>
                <div class="col-md-8">
                    <form onsubmit="addSearchedTicketInfo(); return false;" id="searchTicketForm">
                        <input type="hidden" name="id">
                        <input type="hidden" name="action" value="search-ticket">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="d-block font-weight-bold" for="from">FROM</label>
                                <select name="departure" class="form-control searched-content-form-input"
                                        id="from">
                                    <option value="">Departure</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Dinajpur">Dinajpur</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Khulna">Khuna</option>
                                </select>
                                <span class="searched-content-form-input-highlight-text">Starting Location</span>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="d-block font-weight-bold" for="to">TO</label>
                                <select name="arrival" class="form-control searched-content-form-input"
                                        id="to">
                                    <option value="">Arrival</option>
                                    <option value="Dinajpur">Dinajpur</option>
                                    <option value="Khulna">Khuna</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="Dhaka">Dhaka</option>
                                </select>
                                <span class="searched-content-form-input-highlight-text">Where to go</span>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="d-block font-weight-bold" for="date">DATE</label>
                                <input type="date" name="date"
                                       class="form-control searched-content-form-input restrict-date"
                                       id="date">
                                <span class="searched-content-form-input-highlight-text">Depart Date</span>
                            </div>
                            <div class="col-md-3">
                                <label class="d-block font-weight-bold">&nbsp;</label>
                                <button type="submit" class="btn btn-danger btn-block font-weight-bold">Find Trains
                                    <i class="icofont-search d-inline-block pl-1"></i>
                                </button>
                                <span class="searched-content-form-input-highlight-text">Click here for advanced
                                options</span>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="d-block font-weight-bold" for="class">CLASS</label>
                                <select name="class" class="form-control searched-content-form-input"
                                        id="class">
                                    <option value="">Choose a class</option>
                                    <option value="AC_B">AC_B</option>
                                    <option value="AC_S">AC_S</option>
                                    <option value="F_BERTH">F_BERTH</option>
                                    <option value="F_SEAT">F_SEAT</option>
                                    <option value="SHOVAN">SHOVAN</option>
                                    <option value="S_CHAIR">S_CHAIR</option>
                                </select>
                                <span class="searched-content-form-input-highlight-text">Select a Class</span>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="d-block font-weight-bold" for="passenger">PASSENGER(S)</label>
                                <select name="passenger_no" class="form-control searched-content-form-input"
                                        id="passenger">
                                    <option value="">Select no of Adult's</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                </select>
                                <span class="searched-content-form-input-highlight-text">Adult Passenger(s)</span>
                                <span class="searched-content-form-input-highlight-text">
                                <span class="d-block">
                                    <span class="text-danger">*</span>
                                    <span>Maximum 4 seats can be issued</span>
                                </span>
                            </span>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="d-block font-weight-bold" for="child">CHILD</label>
                                <select name="child_no" class="form-control searched-content-form-input"
                                        id="child">
                                    <option value="">Select no of Child's</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                </select>
                                <span class="searched-content-form-input-highlight-text">Child Passenger(s)</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</div><?php
