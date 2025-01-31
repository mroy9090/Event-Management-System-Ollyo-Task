<?php

include('db_conn.php');
session_start();
if (isset($_POST['input'])) {
    //add pagination logic
    $limit = 3;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $input = $_POST['input'];
    $sql = "SELECT * FROM events WHERE event_name LIKE ? LIMIT {$offset}, {$limit}";
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
                        <th scope="col">No.</th>
                        <th scope="col">Event Name</th>
                        <th scope="col">Event Date</th>
                        <th scope="col">Event Time</th>
                        <th scope="col">Event Category</th>
                        <th scope="col">Venue</th>
                        <th scope="col">Event Descriuption</th>
                        <th scope="col">Event Ticket Price</th>
                        <th scope="col">Event Ticket PriceEvent Ticket Total</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    while ($row = $result->fetch_assoc()) {
                        $count++;
                        echo "<tr>";
                        echo "<td>{$count}</td>";
                        echo "<td>{$row['event_name']}</td>";
                        echo "<td>{$row['event_date']}</td>";
                        echo "<td>{$row['event_time']}</td>";
                        echo "<td>{$row['event_category']}</td>";
                        echo "<td>{$row['venue_name']}</td>";
                        echo "<td>{$row['event_decription']}</td>";
                        echo "<td>{$row['event_ticket_price']}</td>";
                        echo "<td>{$row['event_ticket_total']}</td>";
                        echo "<td>
                                <a href='edit_event.php?id=" . $row['id'] . "' class='btn btn-outline-warning' name='edit'>Edit</a>
                                <a href='delete_event.php?id=" . $row['id'] . "' name='delete' class='btn btn-outline-danger'>Delete</a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

        <?php
        } else { ?>
            <div class="alert alert-danger text-center">
                No Event found matching
            </div>
<?php
        }
    } else {
        echo "<div class='alert alert-danger'>Error preparing the statement.</div>";
    }
}
?>


<!-- logic for event filter functionality -->
<?php


include('db_conn.php');

if (isset($_POST['request'])) {

    //add pagination logic
    $limit = 3;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $input = $_POST['request'];
    $sql = "SELECT * FROM events WHERE event_category LIKE ? LIMIT {$offset}, {$limit}";
    $stmt = $connect->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $input);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Event Name</th>
                        <th scope="col">Event Date</th>
                        <th scope="col">Event Time</th>
                        <th scope="col">Event Category</th>
                        <th scope="col">Venue</th>
                        <th scope="col">Event Descriuption</th>
                        <th scope="col">Event Ticket Price</th>
                        <th scope="col">Event Ticket PriceEvent Ticket Total</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    while ($row = $result->fetch_assoc()) {
                        $count++;
                        echo "<tr>";
                        echo "<td>{$count}</td>";
                        echo "<td>{$row['event_name']}</td>";
                        echo "<td>{$row['event_date']}</td>";
                        echo "<td>{$row['event_time']}</td>";
                        echo "<td>{$row['event_category']}</td>";
                        echo "<td>{$row['venue_name']}</td>";
                        echo "<td>{$row['event_decription']}</td>";
                        echo "<td>{$row['event_ticket_price']}</td>";
                        echo "<td>{$row['event_ticket_total']}</td>";
                        echo "<td>
                                <a href='edit_event.php?id=" . $row['id'] . "' class='btn btn-outline-warning' name='edit'>Edit</a>
                                <a href='delete_event.php?id=" . $row['id'] . "' name='delete' class='btn btn-outline-danger'>Delete</a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

        <?php
        } else { ?>
            <div class="alert alert-danger text-center">
                No Category found matching
            </div>
<?php
        }
    } else {
        echo "<div class='alert alert-danger'>Error preparing the statement.</div>";
    }
}
?>