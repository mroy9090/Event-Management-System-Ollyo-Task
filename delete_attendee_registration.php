<?php
include('db_conn.php');
session_start();

if (isset($_GET['id']) && isset($_GET['event_name'])) {
    $id = $_GET['id'];
    $event_name = $_GET['event_name'];
    $stmt = $connect->prepare("DELETE FROM attendee_registration WHERE registration_id =?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $ticket_query = "SELECT event_ticket_sold FROM events WHERE event_name = ?";
    $stmt2 = $connect->prepare($ticket_query);
    $stmt2->bind_param("s", $event_name);
    $stmt2->execute();
    $result = $stmt2->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $ticket_sold = $row['event_ticket_sold'];
        if ($ticket_sold > 0) {
            $new_ticket_sold = $ticket_sold - 1;
            $update_query = "UPDATE events SET event_ticket_sold = ? WHERE event_name = ?";
            $stmt3 = $connect->prepare($update_query);
            $stmt3->bind_param("ii", $new_ticket_sold, $event_name);
            $stmt3->execute();
        }
    }
    $_SESSION['attendee_registration_cancel'] = "Registration has been canceled successfully";
    header("Location: attendee_registration.php");
    exit();
} else {
    echo "No Event name provided.";
    header("Location: attendee_registration.php");
    exit();
}
?>

