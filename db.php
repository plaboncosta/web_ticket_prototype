<?php
include 'config.php';
session_start();
date_default_timezone_set('Asia/Dhaka');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (is_ajax()) {
    if (isset($_POST["action"]) && !empty($_POST["action"])) {
        $action = $_POST['action'];
        switch ($action) {
            case "search-ticket":
                addSearchedTicketInfo($conn);
                break;
            case "get_searched_ticket_data":
                getSearchedTicketData($conn);
                break;
            case "registration-form":
                addUser($conn);
                break;
            case "login":
                loginUser($conn);
                break;
            case "add_passenger":
                addPassengerInformation($conn);
                break;
            case "payment_form_submission":
                addPaymentInformation($conn);
                break;
            case "passenger_file_upload":
                savePassengerFile($conn);
                break;
            case "logout":
                logOutUser();
                break;
        }
    }
}

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function addSearchedTicketInfo($conn) {
    $id           = $_POST['id'];
    $arrival      = $_POST['arrival'];
    $departure    = $_POST['departure'];
    $date         = $_POST['date'];
    $class        = $_POST['class'];
    $passenger_no = $_POST['passenger_no'];
    $child_no     = $_POST['child_no'];
    $created_at   = (new DateTime())->format('Y-m-d H:i:s');
    $updated_at   = (new DateTime())->format('Y-m-d H:i:s');
    
    if ($id) {
        $sql      = "UPDATE web_ticket_demo.ticket_search
                SET departure = '$departure', arrival = '$arrival', date = '$date', class = '$class', passenger_no = '$passenger_no',
                    child_no  = '$child_no', updated_at = '$updated_at'
                WHERE id = '$id'";
        $response = array(
            'success' => true,
            'message' => 'Updated successfully'
        );
    } else {
        $sql      = "INSERT INTO ticket_search (departure, arrival, date, class, passenger_no, child_no,
                                           created_at) VALUES ('$departure', '$arrival', '$date', '$class',
                                           '$passenger_no', '$child_no', '$created_at')";
        $response = array(
            'success' => true,
            'message' => 'Added successfully'
        );
    }
    
    if ($conn->query($sql) === true) {
        if ($id) {
            $_SESSION["ticket_search_insert_id"] = $id;
        } else {
            $_SESSION["ticket_search_insert_id"] = $conn->insert_id;
        }
        
        echo json_encode($response);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function getSearchedTicketData($conn) {
    $id     = $_POST['id'];
    $sql    = "select * from ticket_search where id = '$id';";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo json_encode($row);
        }
    } else {
        echo json_encode('');
    }
}

function addUser($conn) {
    $first_name             = $_POST['first_name'];
    $last_name              = $_POST['last_name'];
    $phone_number           = $_POST['phone_number'];
    $confirm_phone          = $_POST['confirm_phone'];
    $national_id            = $_POST['national_id'];
    $email                  = $_POST['email'];
    $password               = $_POST['password'];
    $confirm_password       = $_POST['confirm_password'];
    $registration_from_menu = $_POST['registration_from_menu'];
    $terms_of_service       = $_POST['terms_of_service'] == 'on' ? 1 : 0;
    $created_at             = (new DateTime())->format('Y-m-d H:i:s');
    
    if ($phone_number != $confirm_phone) {
        $response = array(
            'success' => false,
            'message' => 'Phone Number and Confirm Phone Number not matched!'
        );
        echo json_encode($response);
    }
    
    if ($password != $confirm_password) {
        $response = array(
            'success' => false,
            'message' => 'Password and Confirm Password not matched!'
        );
        echo json_encode($response);
    }
    
    $sql = "INSERT INTO users (first_name, last_name, email, national_id, password, phone_number,
                                   terms_of_service, created_at)
            VALUES ('$first_name', '$last_name', '$email', '$national_id', '$password', '$phone_number', $terms_of_service, '$created_at');";
    
    if ($conn->query($sql) === true) {
        $_SESSION["user_id"] = $conn->insert_id;
        $user_id             = $conn->insert_id;
        
        if ($registration_from_menu != 'true') {
            $search_id = $_SESSION["ticket_search_insert_id"];
            $conn->query("UPDATE web_ticket_demo.ticket_search SET search_by = '$user_id' WHERE id = '$search_id'");
        }
        
        $sql_two   = "select * from users where id = '$user_id';";
        $result    = $conn->query($sql_two);
        $user_info = '';
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_info = $row;
            }
        }
        
        $_SESSION["user_info"] = $user_info;
        $response              = array(
            'success' => true,
            'message' => 'Added successfully'
        );
        
        echo json_encode($response);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function loginUser($conn) {
    $mobile_number   = $_POST['mobile_number'];
    $password        = $_POST['password'];
    $login_from_menu = $_POST['login_from_menu'];
    $sql             = "select * from users where phone_number = '$mobile_number' and password = '$password';";
    $result          = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION["user_info"] = $row;
            $user_id               = $row['id'];
            $_SESSION["user_id"]   = $user_id;
            
            if ($login_from_menu == 'true') {
                $response = array(
                    'success'         => true,
                    'login_from_menu' => true,
                    'message'         => 'User exists',
                    'data'            => $row
                );
            } else {
                $search_id = $_SESSION["ticket_search_insert_id"];
                $conn->query("UPDATE web_ticket_demo.ticket_search SET search_by = '$user_id' WHERE id = '$search_id'");
                
                $response = array(
                    'success'         => true,
                    'login_from_menu' => false,
                    'message'         => 'User exists',
                    'data'            => $row
                );
            }
            
            echo json_encode($response);
        }
    } else {
        $response = array(
            'success' => false,
            'message' => 'Phone Number or Password is incorrect!'
        );
        echo json_encode($response);
    }
}

function addPassengerInformation($conn) {
    $passenger_name = $_POST['passenger_name'];
    $gender         = $_POST['gender'];
    $age            = $_POST['age'];
    $is_infant      = explode(',', $_POST['hidden_infant']);
    $nationality    = 'Bangladeshi';
    $search_id      = $_SESSION["ticket_search_insert_id"];
    $created_at     = (new DateTime())->format('Y-m-d H:i:s');
    
    $sql       = "INSERT INTO `passengers` (`search_id`, `name`, `age`, `nationality`, `gender`,
                `is_infant`, `createdAt`, `updatedAt`) VALUES ";
    $value_str = "";
    
    if (count($passenger_name) > 0) {
        foreach ($passenger_name as $key => $item) {
            $str =
                "('$search_id', '$item', '$age[$key]', '$nationality', '$gender[$key]', '$is_infant[$key]', '$created_at', null)";
            if ($key < count($passenger_name)) {
                $str = $str . ',';
            }
            $value_str .= $str;
        }
    }
    
    $value_str = trim($value_str, ',');
    $sql       .= $value_str;
    
    /* Fetch Passenger Data */
    $sql_two        = "select * from passengers where search_id = '$search_id'";
    $result_two     = $conn->query($sql_two);
    $passenger_info = array();
    
    if ($result_two->num_rows > 0) {
        while ($row = $result_two->fetch_assoc()) {
            array_push($passenger_info, $row);
        }
    }
    
    if (count($passenger_info) > 0) {
        foreach ($passenger_info as $item) {
            if ($item['image_url']) {
                $path = $item['image_url'];
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }
    }
    
    $drop_sql = "delete from passengers where search_id = '$search_id'";
    $conn->query($drop_sql);
    
    if ($conn->query($sql) === true) {
        $conn->query("UPDATE web_ticket_demo.ticket_search SET status = 2 WHERE id = '$search_id'");
        
        $response = array(
            'success' => true,
            'message' => 'Added successfully'
        );
        
        echo json_encode($response);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function addPaymentInformation($conn) {
    $search_id      = $_SESSION["ticket_search_insert_id"];
    $payment_amount = '1,689.00';
    $payment_option = $_POST['payment_option'];
    $created_at     = (new DateTime())->format('Y-m-d H:i:s');
    
    $sql = "INSERT INTO web_ticket_demo.payments (search_id, payment_amount, payment_option, transaction_id,
                                      createdAt, updatedAt)
            VALUES ($search_id, '$payment_amount', '$payment_option', null, '$created_at', null)";
    
    if ($conn->query($sql) === true) {
        $conn->query("UPDATE web_ticket_demo.ticket_search SET status = 3 WHERE id = '$search_id'");
        
        /* Fetch Search Ticket Data */
        $sql           = "select * from ticket_search where id = '$search_id';";
        $result        = $conn->query($sql);
        $ticket_search = '';
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ticket_search = $row;
            }
        }
        
        /* Fetch Passenger Data */
        $sql_two        = "select * from passengers where search_id = '$search_id'";
        $result_two     = $conn->query($sql_two);
        $passenger_info = array();
        
        if ($result_two->num_rows > 0) {
            while ($row = $result_two->fetch_assoc()) {
                array_push($passenger_info, $row);
            }
        }
        
        /* Fetch Payments Information */
        $sql_three       = "select * from payments where search_id = '$search_id';";
        $result_three    = $conn->query($sql_three);
        $payment_details = '';
        
        if ($result_three->num_rows > 0) {
            while ($row = $result_three->fetch_assoc()) {
                $payment_details = $row;
            }
        }
        
        echo getTicketContent($ticket_search, $passenger_info, $payment_details);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function getTicketContent($ticket_search, $passenger_info, $payment_details) {
    $passenger_str = '';
    foreach ($passenger_info as $key => $item) {
        $passenger_str .= '<p class="mb-2">' . $item['name'] . ', ' . $item['age'] . ', ' .
            ($item['gender'] ==
            'Male' ? 'M' : 'F') . '</p>';
    }
    
    $total_passenger = ($ticket_search['passenger_no'] ? $ticket_search['passenger_no'] : 0) +
        ($ticket_search['child_no'] ? $ticket_search['child_no'] : 0);
    
    $payment_str = '';
    if ($payment_details['payment_option'] == 'bKash') {
        $payment_str .= '<p class="text-right mb-0">MFS - ' . $payment_details['payment_option'];
    } else {
        $payment_str .= '<p class="text-right mb-0">Credit Card - VISA</p>';
    }
    
    return '
    <div class="ui-ticket">
                                        <div class="row">
                                            <div class="col-md-5 border-right-dashed pr-4">
                                                <h4 class="text-white ticket-title-bar-text"><b>PANCHAGARH EXPRESS</b></h4>
                                                <p class="mb-3"><b>(793)</b></p>
                                                <div class="d-flex justify-content-between w-100">
                                                    <p><b>AC Berth Class</b></p>
                                                    <p><b>General Quota</b></p>
                                                </div>
                                                <div class="w-100">
                                                    <div class="d-flex  justify-content-between">
                                                        <p><b>' . $ticket_search['departure'] . '</b></p>
                                                        <p><b>' . $ticket_search['arrival'] . '</b></p>
                                                    </div>
                                                    <div class="d-flex position-relative ui-locationTo justify-content-between">
                                                        <div>
                                                            <p class="text-yellow"><b>DAKA</b></p>
                                                            <p class="mb-0 ui-time">12:10 AM</p>
                                                            <p class="mb-0 ui-time">
                                                            ' .
        date("d/m/Y", strtotime($ticket_search['date'])) . '
                                                         </p>
                                                        </div>
                                                        <div>
                                                            <p class="text-right text-yellow"><b>DGP</b></p>
                                                            <p class="mb-0 text-right ui-time">12:10 AM</p>
                                                            <p class="mb-0 text-right ui-time">
                                                            ' .
        date("d/m/Y", strtotime($ticket_search['date'])) . '
                                                           </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="px-3">
                                                    <div class="d-flex justify-content-between mb-4">
                                                        <h4 class="text-white ticket-title-bar-text"><b>Ticket No: </b><b class="text-yellow">2425188484961</b>
                                                        </h4>
                                                        <h4 class="text-white ticket-title-bar-text"><b>07h 27m</b></h4>
                                                    </div>
                                                    <div class="d-flex justify-content-between pb-2 border-bottom-dashed mb-4">
                                                        <div>
                                                            <p class="mb-2">Passenger ' . $total_passenger . '</p>
                                                            ' . $passenger_str . '
                                                            </div>
                                                        <div class="text-center">
                                                            <p class="mb-2">Coach</p>
                                                            <p class="mb-2">A1-01</p>
                                                            <p class="mb-2">A1-01</p>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="mb-2">Seat / Berth</p>
                                                            <p class="mb-2"><span class="text-yellow">31</span>, Upper
                                                                Berth</p>
                                                            <p class="mb-2"><span class="text-yellow">32</span>, Lower
                                                                Berth</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <p class="mb-2">Total Fare</p>
                                                            <p class="mb-2">Payment Mode</p>
                                                        </div>
                                                        <div>
                                                            <h6 class="text-right text-yellow">BDT 2980.00</h6>
                                                            ' . $payment_str . '
                                                            <p class="text-right ">P6541-xxxx-xxxx-xxxx</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    ';
}

function savePassengerFile($conn) {
    if (!empty($_FILES['image_url'])) {
        $path = "assets/uploads/";
        $path = $path . basename($_FILES['image_url']['name']);
        $id   = $_POST['id'];
        
        if (!file_exists('./assets/uploads/')) {
            mkdir("./assets/uploads", 0777);
        }
        
        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $path)) {
            $conn->query("UPDATE web_ticket_demo.passengers SET image_url = '$path' WHERE id = '$id'");
            $response = array(
                'success' => true,
                'message' => 'File Uploaded',
                'path'    => $path
            );
            echo json_encode($response);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Something went wrong!'
            );
            echo json_encode($response);
        }
    }
}

function logOutUser() {
    unset($_SESSION["ticket_search_insert_id"]);
    unset($_SESSION["user_id"]);
    unset($_SESSION["user_info"]);
    
    $response = array(
        'success' => true,
        'message' => 'Successfully Logged out'
    );
    echo json_encode($response);
}

$conn->close();
