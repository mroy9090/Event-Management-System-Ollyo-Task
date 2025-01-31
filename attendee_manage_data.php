<?php
include('db_conn.php');
session_start();
$uname = $_SESSION['user_name'];
$read_user_name = "SELECT user_id FROM users WHERE user_name = ?";
$stmt_read_user_name = $connect->prepare($read_user_name);
$stmt_read_user_name->bind_param("s", $uname);
$stmt_read_user_name->execute();
$result_user_name = $stmt_read_user_name->get_result();
$row_user_name = $result_user_name->fetch_assoc();
$uid = $row_user_name['user_id'];

if ($_SESSION['user_name'] != null) {
    $attendee_contact_number = $_POST['attendee_contact_number'];
    $event_id = $_POST['event_id'];
    if (empty($attendee_contact_number)) {
        $_SESSION['contact_number_error'] = "Provide contact number";
        header("Location: attendee_registration.php");
        exit();
    } else {

    $ticket_info = "SELECT event_ticket_total, event_ticket_sold FROM events WHERE id=?";
    $stmt = $connect->prepare($ticket_info);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $read_ticket_info = $stmt->get_result();

    if ($read_ticket_info) {
        
        while ($row = $read_ticket_info->fetch_assoc()) {
            $tickettotal = $row['event_ticket_total'];
            $ticketsold = $row['event_ticket_sold'];

            // Check if tickets are sold out
            if ($ticketsold == $tickettotal) {
                $_SESSION['sold_out_ticket'] = "Ticket sold out!";
                header("Location: attendee_registration.php");
                exit();
            } else {
                $currentsoldticket = $ticketsold + 1;
                $update_sold_ticket = "UPDATE events SET event_ticket_sold=? WHERE id=?";
                $stmt_update_sold_ticket = $connect->prepare($update_sold_ticket);
                if (!$stmt_update_sold_ticket) {
                    die("Prepare failed: " . $connect->error);
                }
                $stmt_update_sold_ticket->bind_param("ii", $currentsoldticket, $event_id);
                $stmt_update_sold_ticket->execute();
                if ($stmt_update_sold_ticket) {
                    date_default_timezone_set('Asia/Kuala_Lumpur');
                    $time = date('Y-m-d H:i:s');
                    $registration = "INSERT INTO attendee_registration (attendee_contact_number,registration_time_stamp, user_id , event_id) VALUES (?,?, ?, ?)";
                    $stmt_insert_booking = $connect->prepare($registration);
                    if (!$stmt_insert_booking) {
                        die("Prepare failed: " . $connect->error);
                    }
                    $stmt_insert_booking->bind_param("isss", $attendee_contact_number, $time, $uid, $event_id);
                    $stmt_insert_booking->execute();
                    if ($stmt_insert_booking) {
                        $_SESSION['success_purchased_ticket'] = "Successfully purchased your tickets";
                        header("Location: attendee_registration.php");
                    } else {
                        $_SESSION['fail_purchased_ticket'] = "Ticket purchase failed";
                        header("Location: attendee_registration.php");
                    }
                }
            }
        }
    }
}
} else {
    $_SESSION['login_error'] = "Please login First.";
    header("Location: login.php");
    exit();
}
