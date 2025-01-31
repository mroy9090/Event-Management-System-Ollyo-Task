<?php

include('header.php');
include('db_conn.php');
$uname = $_SESSION['user_name'];
$read_user_name = "SELECT usertype FROM users WHERE user_name = ?";
$stmt_read_user_name = $connect->prepare($read_user_name);
$stmt_read_user_name->bind_param("s", $uname);
$stmt_read_user_name->execute();
$result_user_name = $stmt_read_user_name->get_result();
$row_user_name = $result_user_name->fetch_assoc();
$utype = $row_user_name['usertype'];
?>


<div class="row">

    <div class="col-8">
        <div class="card text-dark">
            <div class="card-header bg-secondary text-center">Venue Information</div>
            <div class="card-body">
                <?php if (isset($_SESSION['attendee_registration_cancel'])) : ?>
                    <label class="text-success"><?= $_SESSION['attendee_registration_cancel'] ?></label>
                <?php endif; ?>
                <?php if ($utype == 'ADMIN') { ?>
                    <div class="table-responsive" align="center">
                        <table>
                            <tbody>
                                <td>
                                    <a class="btn btn-info" href="download_atttendees_csv.php">Export Data</a>
                                </td>
                                <td>
                                    <label>Search</label>
                                </td>
                                <td>
                                    <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" id="live_search">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary" id="clear-search">Clear Search</button>
                                </td>
                            </tbody>
                        </table>
                        <br>
                    </div>
                <?php } ?>
                <table class="table table-bordered" id="searchresult">
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
                            <th scope="col">Cancel Booking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($utype == 'ADMIN') {
                            $count = 0;
                            if ($connect->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $query = "SELECT * FROM attendee_registration INNER JOIN users on attendee_registration.user_id= users.user_id INNER JOIN events on attendee_registration.event_id=events.id ";
                            $stmt = $connect->prepare($query);
                            $stmt->execute();
                            $read_result = $stmt->get_result();

                            if ($read_result->num_rows > 0) {
                                while ($row = $read_result->fetch_assoc()) {

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
                                    echo "<td><a href='delete_attendee_registration.php?id=" . $row['registration_id'] . "&event_name=" . $row['event_name'] . "' name='delete' class='btn btn-outline-danger'>Cancel</a></td>";
                                    echo "</tr>";
                                }
                            }
                        } else {
                            $count = 0;
                            if ($connect->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $uname = $_SESSION['user_name'];
                            $query = "SELECT * FROM attendee_registration INNER JOIN users on attendee_registration.user_id= users.user_id INNER JOIN events on attendee_registration.event_id=events.id where user_name= ?";
                            $stmt = $connect->prepare($query);
                            $stmt->bind_param("s", $uname);
                            $stmt->execute();
                            $read_result = $stmt->get_result();

                            if ($read_result->num_rows > 0) {
                                while ($row = $read_result->fetch_assoc()) {
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
                                    echo "<td><a href='delete_attendee_registration.php?id=" . $row['registration_id'] . "&event_name=" . $row['event_name'] . "' name='delete' class='btn btn-outline-danger'>Cancel</a></td>";
                                    echo "</tr>";
                                }
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <div class="col-4">
        <div class="card text-black  mb-3" style="max-width: 40rem;">
            <div class="card-header bg-secondary">Register Attendee</div>
            <div class="card-body">
                <?php if (isset($_SESSION['sold_out_ticket'])) : ?>
                    <label class="text-success"><?= $_SESSION['sold_out_ticket'] ?></label>
                <?php endif; ?>

                <?php if (isset($_SESSION['success_purchased_ticket'])) : ?>
                    <label class="text-success"><?= $_SESSION['success_purchased_ticket'] ?></label>
                <?php endif; ?>

                <?php if (isset($_SESSION['fail_purchased_ticket'])) : ?>
                    <label class="text-danger"><?= $_SESSION['fail_purchased_ticket'] ?></label>
                <?php endif; ?>
                <form action="attendee_manage_data.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Attendee Contact Number</label>
                        <input type="text" class="form-control" name="attendee_contact_number" placeholder="Attendee Contact Number">
                    </div>
                    <?php if (isset($_SESSION['contact_number_error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['contact_number_error'] ?></label>
                    <?php endif; ?>
                    <div id="filters">
                        <label class="form-label">Event Name</label>
                        <select name="event_id" class="form-select">
                            <option value="" disabled selected>Select Filter</option>
                            <?php
                            $query = "SELECT * FROM events";
                            if ($result = $connect->query($query)) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['event_name'] . "</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success" name="registerattendee" value="Add">Add Venue</button>
                </form>
            </div>
        </div>

    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNfghbCsoSCaU1Wj+RzTfDxLwpWWFr1EpI5UT4VpyELHT1zUtrPbZjlHggbHbx/" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-jL6iK0a85dygY8B9OjWV7RfXcCcmfwr7ZfSvA7sXpSws0AC+QLYI6mAZxr7PW5hF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-t6I8D5dJmMXjCsRLhSzCltuhNZg6P10kE0m0nAncLUjH6GeYLhRU1zfLoW3QNQDF" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#live_search').keyup(function() {
            var input = $(this).val();
            // alert(input);
            if (input != "") {
                $.ajax({
                    url: "attendee_fetch.php",
                    method: "POST",
                    data: {
                        input: input
                    },
                    success: function(data) {
                        $('#searchresult').html(data);
                    }
                });
            } else {
                return false;
            }

        });
        $('#clear-search').click(function() {
            $.ajax({
                url: "attendee_fetch.php",
                method: "POST",
                data: {
                    input: ""
                },
                success: function(data) {
                    $('#searchresult').html(data);
                }
            });
        });
    });
</script>
</body>



</html>


<?php

unset($_SESSION['sold_out_ticket']);
unset($_SESSION['success_purchased_ticket']);
unset($_SESSION['fail_purchased_ticket']);
unset($_SESSION['contact_number_error']);
unset($_SESSION['attendee_registration_cancel']);

?>