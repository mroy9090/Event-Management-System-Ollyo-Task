<?php

include('db_conn.php');
session_start();
if (isset($_POST['input'])) {

    $input = $_POST['input'];
    $sql = "SELECT * FROM attendee_registration INNER JOIN users on attendee_registration.user_id= users.user_id INNER JOIN events on attendee_registration.event_id=events.id WHERE user_name LIKE ?";
    $stmt = $connect->prepare($sql);

    if ($stmt) {
        $search_param = $input . '%';
        $stmt->bind_param("s", $search_param);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">NO.</th>
                        <th scope="col">Attendee Name</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Event Name</th>
                        <th scope="col">Event Date</th>
                        <th scope="col">Event Time</th>
                        <th scope="col">Venue Information</th>
                        <th scope="col">status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    while ($row = $result->fetch_assoc()) {
                        $count++;
                        echo "<tr>";
                        echo "<td>{$count}</td>";
                        echo "<td>{$row['user_name']}</td>";
                        echo "<td>{$row['attendee_contact_number']}</td>";
                        echo "<td>{$row['event_name']}</td>";
                        echo "<td>{$row['event_date']}</td>";
                        echo "<td>{$row['event_time']}</td>";
                        echo "<td>{$row['venue_name']}</td>";
                        echo "<td>{$row['usertype']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

        <?php
        } else { ?>
            <div class="alert alert-warning text-center">
                No users found matching "<strong><?php echo htmlspecialchars($input); ?></strong>"
            </div>
<?php
        }
    } else {
        echo "<div class='alert alert-danger'>Error preparing the statement.</div>";
    }
}
?>