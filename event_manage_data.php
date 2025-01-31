<?php
include('db_conn.php');
// include('header.php');
session_start();
$uname = $_SESSION['name'];
$read_user_name = "SELECT user_id FROM users WHERE user_name = ?";
$stmt_read_user_name = $connect->prepare($read_user_name);
$stmt_read_user_name->bind_param("s", $uname);
$stmt_read_user_name->execute();
$result_user_name = $stmt_read_user_name->get_result();
$row_user_name = $result_user_name->fetch_assoc();
$uid = $row_user_name['user_id'];



if(isset($_POST['addevent'])){
    
    $name = $_POST['event_name'];
    $date = $_POST['event_date'];
    $time = $_POST['event_time'];
    $description = $_POST['event_description'];
    $category = $_POST['event_category'];
    $venue = $_POST['event_venue'];
    $price = $_POST['event_ticketprice'];
    $total = $_POST['event_tickettotal'];
    $time_event = $time. ':00';
    $sold = 0;
    if (empty($name)) {
        $_SESSION['event_name_error'] = "Event Name is required";
        header("Location: event.php");
        exit();
    } else if (empty($date)) {
        $_SESSION['event_date_error'] = "Date is required";
        header("Location: event.php");
        exit();
    } else if (empty($time)) {
       
        $_SESSION['event_time_error'] = "Time is required";
        header("Location: event.php");
        exit();
    } else if (empty($description)) {
        $_SESSION['event_description_error'] = "Event description is required";
        header("Location: event.php");
        exit();
    } else if (empty($category)) {
        $_SESSION['event_category_error'] = "Event Category is required";
        header("Location: event.php");
        exit();
    } else if (empty($price)) {
        $_SESSION['event_ticketprice_error'] = "Event Ticket Price is required";
        header("Location: event.php");
        exit();
    } else if (empty($total)) {
        $_SESSION['event_tickettotal_error'] = "Event Ticket Total is required";
        header("Location: event.php");
        exit();
    } else if (empty($venue)) {
        $_SESSION['event_cvenue_error'] = "Venue is required";
        header("Location: event.php");
        exit();
    }  else {
        $query = "SELECT COUNT(*) AS count FROM events WHERE event_time = ?";
        $time_query = $connect->prepare($query);
        $time_query->bind_param("s", $time_event);
        $time_query->execute();
        $result_event_time = $time_query->get_result();
        $duplicate_event_time = $result_event_time->fetch_assoc();
        if ($duplicate_event_time['count'] > 0) {
            $_SESSION['duplicate_time_error'] = "Event time already taken. Please choose a different time.";
            header("Location: event.php");
            exit();
        }else {
            $insert_event = "INSERT INTO events (event_name, event_date, event_time, event_category, event_decription, venue_name, event_ticket_price, event_ticket_total,event_ticket_sold) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert_event = $connect->prepare($insert_event);
            $stmt_insert_event->bind_param("ssssssdis", $name, $date, $time_event, $category, $description, $venue, $price,$total, $sold);
           

            if ($stmt_insert_event->execute()) {
                $_SESSION['event_add_success'] = "Event added successfully";
                header("Location: event.php");
                exit();
            } else {
                $_SESSION['event_add_error'] = "Failed to add event. Please try again.";
                header("Location: event.php");
                exit();
            }
        }

        

    }
    
}



?>