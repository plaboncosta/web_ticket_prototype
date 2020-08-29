<?php
include 'config.php';
session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

if(is_ajax()){
    if(isset($_POST["action"]) && !empty($_POST["action"])){
        $action = $_POST['action'];
        switch($action){
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
        }
    }
}

function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function addSearchedTicketInfo($conn){
    $id           = $_POST['id'];
    $arrival      = $_POST['arrival'];
    $departure    = $_POST['departure'];
    $date         = $_POST['date'];
    $class        = $_POST['class'];
    $passenger_no = $_POST['passenger_no'];
    $child_no     = $_POST['child_no'];
    $created_at   = (new DateTime())->format('Y-m-d H:i:s');
    $updated_at   = (new DateTime())->format('Y-m-d H:i:s');
    
    if($id){
        $sql      = "UPDATE web_ticket_demo.ticket_search
                SET departure = '$departure', arrival = '$arrival', date = '$date', class = '$class', passenger_no = '$passenger_no',
                    child_no  = '$child_no', updated_at = '$updated_at'
                WHERE id = '$id'";
        $response = array(
            'success' => true,
            'message' => 'Updated successfully'
        );
    } else{
        $sql      = "INSERT INTO ticket_search (departure, arrival, date, class, passenger_no, child_no,
                                           created_at) VALUES ('$departure', '$arrival', '$date', '$class',
                                           '$passenger_no', '$child_no', '$created_at')";
        $response = array(
            'success' => true,
            'message' => 'Added successfully'
        );
    }
    
    if($conn->query($sql) === true){
        if($id){
            $_SESSION["ticket_search_insert_id"] = $id;
        } else{
            $_SESSION["ticket_search_insert_id"] = $conn->insert_id;
        }
        
        echo json_encode($response);
    } else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function getSearchedTicketData($conn){
    $id     = $_POST['id'];
    $sql    = "select * from ticket_search where id = '$id';";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo json_encode($row);
        }
    } else{
        echo json_encode('');
    }
}

function addUser($conn){
    $first_name       = $_POST['first_name'];
    $last_name        = $_POST['last_name'];
    $phone_number     = $_POST['phone_number'];
    $confirm_phone    = $_POST['confirm_phone'];
    $national_id      = $_POST['national_id'];
    $email            = $_POST['email'];
    $password         = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $terms_of_service = $_POST['terms_of_service'] == 'on' ? 1 : 0;
    $created_at       = (new DateTime())->format('Y-m-d H:i:s');
    
    if($phone_number != $confirm_phone){
        $response = array(
            'success' => false,
            'message' => 'Phone Number and Confirm Phone Number not matched!'
        );
        echo json_encode($response);
    }
    
    if($password != $confirm_password){
        $response = array(
            'success' => false,
            'message' => 'Password and Confirm Password not matched!'
        );
        echo json_encode($response);
    }
    
    $sql = "INSERT INTO users (first_name, last_name, email, national_id, password, phone_number,
                                   terms_of_service, created_at)
            VALUES ('$first_name', '$last_name', '$email', '$national_id', '$password', '$phone_number', $terms_of_service, '$created_at');";
    
    if($conn->query($sql) === true){
        $_SESSION["user_id"] = $conn->insert_id;
        $user_id             = $conn->insert_id;
        $search_id           = $_SESSION["ticket_search_insert_id"];
        $conn->query("UPDATE web_ticket_demo.ticket_search SET search_by = '$user_id' WHERE id = '$search_id'");
        
        $response = array(
            'success' => true,
            'message' => 'Added successfully'
        );
        
        echo json_encode($response);
    } else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function loginUser($conn){
    $mobile_number = $_POST['mobile_number'];
    $password      = $_POST['password'];
    $sql           = "select * from users where phone_number = '$mobile_number' and password = '$password';";
    $result        = $conn->query($sql);
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $_SESSION["user_info"] = $row;
            $user_id               = $row['id'];
            $search_id             = $_SESSION["ticket_search_insert_id"];
            $conn->query("UPDATE web_ticket_demo.ticket_search SET search_by = '$user_id' WHERE id = '$search_id'");
            
            $response = array(
                'success' => true,
                'message' => 'User exists',
                'data'    => $row
            );
            echo json_encode($response);
        }
    } else{
        $response = array(
            'success' => false,
            'message' => 'Phone Number or Password is incorrect!'
        );
        echo json_encode($response);
    }
}

$conn->close();
