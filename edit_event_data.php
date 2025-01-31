<?php
include('db_conn.php');
session_start();

if(isset($_POST['addevent'])){
    $event_id=$_POST['id'];
    $edit_event_name = $_POST['edit_event_name'];
    $edit_event_date = $_POST['edit_event_date'];
    $edit_event_time = $_POST['edit_event_time'];
    $edit_event_category = $_POST['edit_event_category'];
    $edit_event_description = $_POST['edit_event_description'];
    $edit_event_venue = $_POST['edit_event_venue'];
    $edit_event_ticketprice = $_POST['edit_event_ticketprice'];
    $edit_event_tickettotal = $_POST['edit_event_tickettotal'];
    if (($edit_event_name == '') && ($edit_event_date == '') && ($edit_event_time == '') && ($edit_event_category == '') && ($edit_event_description == '') && ($edit_event_venue == '') && ($edit_event_ticketprice == '') && ($edit_event_tickettotal == '')) {
        $_SESSION['empty_value'] = "Please enter perfered information to update";
        header("Location: edit_event.php");
        exit();
    } else{
        if (($edit_event_name != '')){
            $query = "UPDATE events SET event_name= ? WHERE id= ?";
            $stmt = $connect->prepare($query);
            if ($stmt === false) {
                $_SESSION['update_fail'] = "Prepare failed: (" . $connect->errno . ") " . $connect->error;
                header("Location: edit_event.php");
                exit();
            }
            $stmt->bind_param("ss", $edit_event_name, $event_id);
            if ($stmt->execute()) {
                $_SESSION['update_event_name'] = "Update event name successfully";
                header("Location: event.php");
                exit();
            } else {
                $_SESSION['fail_update_name'] = "Fail to update event name. Please try again";
                header("Location: edit_event.php");
                exit();
            }
        }else if (($edit_event_date != '')) {
            $query = "UPDATE events SET event_date= ? WHERE id= ?";
            $stmt = $connect->prepare($query);
            if ($stmt === false) {
                $_SESSION['update_fail'] = "Prepare failed: (" . $connect->errno . ") " . $connect->error;
                header("Location: edit_event.php");
                exit();
            }
            $stmt->bind_param("ss", $edit_event_date, $event_id);
            if ($stmt->execute()) {
                $_SESSION['update_event_date'] = "Update event date successfully";
                header("Location: event.php");
                exit();
            } else {
                $_SESSION['fail_update_date'] = "Fail to update event date. Please try again";
                header("Location: edit_event.php");
                exit();
            }
        } else if (($edit_event_time != '')) {
            $query = "UPDATE events SET event_time= ? WHERE id= ?";
            $stmt = $connect->prepare($query);
            if ($stmt === false) {
                $_SESSION['update_fail'] = "Prepare failed: (" . $connect->errno . ") " . $connect->error;
                header("Location: edit_event.php");
                exit();
            }
            $stmt->bind_param("ss", $edit_event_time, $event_id);
            if ($stmt->execute()) {
                $_SESSION['update_event_time'] = "Update event time successfully";
                header("Location: event.php");
                exit();
            } else {
                $_SESSION['fail_update_time'] = "Fail to update event time. Please try again";
                header("Location: edit_event.php");
                exit();
            }
        } else if (($edit_event_category != '')) {
            $query = "UPDATE events SET event_category= ? WHERE id= ?";
            $stmt = $connect->prepare($query);
            if ($stmt === false) {
                $_SESSION['update_fail'] = "Prepare failed: (" . $connect->errno . ") " . $connect->error;
                header("Location: edit_event.php");
                exit();
            }
            $stmt->bind_param("ss", $edit_event_category, $event_id);
            if ($stmt->execute()) {
                $_SESSION['update_event_category'] = "Update event category successfully";
                header("Location: event.php");
                exit();
            } else {
                $_SESSION['fail_update_category'] = "Fail to update event category. Please try again";
                header("Location: edit_event.php");
                exit();
            }
        } else if (($edit_event_description != '')) {
            $query = "UPDATE events SET event_decription= ? WHERE id= ?";
            $stmt = $connect->prepare($query);
            if ($stmt === false) {
                $_SESSION['update_fail'] = "Prepare failed: (" . $connect->errno . ") " . $connect->error;
                header("Location: edit_event.php");
                exit();
            }
            $stmt->bind_param("ss", $edit_event_description, $event_id);
            if ($stmt->execute()) {
                $_SESSION['update_event_description'] = "Update event description successfully";
                header("Location: event.php");
                exit();
            } else {
                $_SESSION['fail_update_description'] = "Fail to update event description. Please try again";
                header("Location: edit_event.php");
                exit();
            }
        } else if (($edit_event_ticketprice != '')) {
            $query = "UPDATE events SET event_ticket_price= ? WHERE id= ?";
            $stmt = $connect->prepare($query);
            if ($stmt === false) {
                $_SESSION['update_fail'] = "Prepare failed: (" . $connect->errno . ") " . $connect->error;
                header("Location: edit_event.php");
                exit();
            }
            $stmt->bind_param("ds", $edit_event_ticketprice, $event_id);
            if ($stmt->execute()) {
                $_SESSION['update_event_ticketprice'] = "Update event ticket price successfully";
                header("Location: event.php");
                exit();
            } else {
                $_SESSION['fail_update_ticketprice'] = "Fail to update event ticket price. Please try again";
                header("Location: edit_event.php");
                exit();
            }
        } else if (($edit_event_tickettotal != '')) {
            $query = "UPDATE events SET event_ticket_total= ? WHERE id= ?";
            $stmt = $connect->prepare($query);
            if ($stmt === false) {
                $_SESSION['update_fail'] = "Prepare failed: (" . $connect->errno . ") " . $connect->error;
                header("Location: edit_event.php");
                exit();
            }
            $stmt->bind_param("is", $edit_event_tickettotal, $event_id);
            if ($stmt->execute()) {
                $_SESSION['update_event_tickettotal'] = "Update event ticket total successfully";
                header("Location: event.php");
                exit();
            } else {
                $_SESSION['fail_update_tickettotal'] = "Fail to update event ticket price. Please try again";
                header("Location: edit_event.php");
                exit();
            }
        } else if (($edit_event_venue != '')) {
            $query = "UPDATE events SET venue_name= ? WHERE id= ?";
            $stmt = $connect->prepare($query);
            if ($stmt === false) {
                $_SESSION['update_fail'] = "Prepare failed: (" . $connect->errno . ") " . $connect->error;
                header("Location: edit_event.php");
                exit();
            }
            $stmt->bind_param("ss", $edit_event_venue, $event_id);
            if ($stmt->execute()) {
                $_SESSION['update_event_venue'] = "Update event venue successfully";
                header("Location: event.php");
                exit();
            } else {
                $_SESSION['fail_update_veneu'] = "Fail to update event venue. Please try again";
                header("Location: edit_event.php");
                exit();
            }
        } else {
            $_SESSION['update_fail'] = "Prepare failed: (" . $connect->errno . ") " . $connect->error;
            header("Location: edit_venue.php");
            exit();
        }
    }


}

?>