<?php
require_once('db_conn.php');
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="attendees_list.csv"');
$output = fopen('php://output', 'w');
$header_line = ["No", "Attendee Name", "Contact Number", "Event Name", "Event Date", "Event Time", "Venue Information", "Status"];
fputcsv($output, $header_line);
$count = 0;
$query = "SELECT * FROM attendee_registration INNER JOIN users ON attendee_registration.user_id = users.user_id INNER JOIN events ON attendee_registration.event_id = events.id ";
$stmt = $connect->prepare($query);
$stmt->execute();
$read_result = $stmt->get_result();
while ($row = $read_result->fetch_assoc()) {
    $line = [$count++, $row['user_name'], $row['attendee_contact_number'], $row['event_name'], $row['event_date'], $row['event_time'], $row['venue_name'], $row['usertype']];
    fputcsv($output, $line);
}
fclose($output);
?>
