<?php
include('db_conn.php');
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM attendee_registration INNER JOIN events ON attendee_registration.event_id = events.id WHERE events.id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $read_result = $stmt->get_result();

    if ($read_result->num_rows > 0) {
        $_SESSION['already_event_booked'] = "Already Event have booked! Please cancel booking first.";
        header("Location: event.php");
        exit();
    } else {
        $stmt = $connect->prepare("DELETE FROM events WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $_SESSION['event_delete'] = "Event has been deleted successfully";
            header("Location: event.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
            exit();
        }
    }
} else {
    echo "No Event ID provided.";
    header("Location: event.php");
    exit();
}
