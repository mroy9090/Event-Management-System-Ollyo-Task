<?php

include('header.php');
include('db_conn.php');

?>



<div class="row">

    <div class="col-8">
        <div class="card text-dark">
            <div class="card-header bg-secondary text-center">Event Information</div>
            <div class="card-body">
                <?php if (isset($_SESSION['event_delete'])) : ?>
                    <label class="text-success"><?= $_SESSION['event_delete'] ?></label>
                <?php endif; ?>

                <?php if (isset($_SESSION['fail_delete'])) : ?>
                    <label class="text-success"><?= $_SESSION['fail_delete'] ?></label>
                <?php endif; ?>

                <?php if (isset($_SESSION['update_info'])) : ?>
                    <label class="text-danger"><?= $_SESSION['update_info'] ?></label>
                <?php endif; ?>

                <?php if (isset($_SESSION['update_name'])) : ?>
                    <label class="text-danger"><?= $_SESSION['update_name'] ?></label>
                <?php endif; ?>

                <?php if (isset($_SESSION['update_succes'])) : ?>
                    <label class="text-danger"><?= $_SESSION['update_succes'] ?></label>
                <?php endif; ?>
                <?php if (isset($_SESSION['update_event_name'])) : ?>
                    <label class="text-danger"><?= $_SESSION['update_event_name'] ?></label>
                <?php endif; ?>

                <?php if (isset($_SESSION['update_event_date'])) : ?>
                    <label class="text-danger"><?= $_SESSION['update_event_date'] ?></label>
                <?php endif; ?>
                <?php if (isset($_SESSION['update_event_category'])) : ?>
                    <label class="text-danger"><?= $_SESSION['update_event_category'] ?></label>
                <?php endif; ?>
                <?php if (isset($_SESSION['update_event_time'])) : ?>
                    <label class="text-danger"><?= $_SESSION['update_event_time'] ?></label>
                <?php endif; ?>
                <?php if (isset($_SESSION['update_event_description'])) : ?>
                    <label class="text-danger"><?= $_SESSION['update_event_description'] ?></label>
                <?php endif; ?>
                <?php if (isset($_SESSION['update_event_venue'])) : ?>
                    <label class="text-danger"><?= $_SESSION['update_event_venue'] ?></label>
                <?php endif; ?>
                <?php if (isset($_SESSION['update_event_ticketprice'])) : ?>
                    <label class="text-danger"><?= $_SESSION['update_event_ticketprice'] ?></label>
                <?php endif; ?>
                <?php if (isset($_SESSION['update_event_tickettotal'])) : ?>
                    <label class="text-danger"><?= $_SESSION['update_event_tickettotal'] ?></label>
                <?php endif; ?>
                <?php if (isset($_SESSION['already_event_booked'])) : ?>
                    <label class="text-danger"><?= $_SESSION['already_event_booked'] ?></label>
                <?php endif; ?>
                <?php if (isset($_SESSION['search_error'])) : ?>
                    <label class="text-danger"><?= $_SESSION['search_error'] ?></label>
                <?php endif; ?>
                <div class="table-responsive">

                    <table align="center" >
                        <tbody>
                            <td>
                                <form action="event.php" method="POST" align="center">
                                    <input type="submit" class="btn btn-outline-primary" name="ascending" value="Ascending">
                                    <input type="submit" class="btn btn-outline-secondary" name="descending" value="Descending">

                                </form>
                            </td>
                            <td>
                                <label>Search</label>
                            </td>
                            <td>
                                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" id="event_search">
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary" id="clear-search">Clear Search</button>
                            </td>
                            <td>
                                <div id="filters">

                                    <select name="fetchval" id="fetchval" class="form-select">
                                        <option value="" disabled selected>Select Filter</option>
                                        <?php
                                        $query = "SELECT * FROM events";
                                        if ($result = $connect->query($query)) {
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['event_category'] . "'>" . $row['event_category'] . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tbody>
                    </table>
                    </br>
                    <table class="table table-bordered" id="searchresult">


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
                                <th scope="col">Event Ticket Total</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['ascending'])) {
                                $count = 0;
                                //add pagination logic
                                $limit = 3;
                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $offset = ($page - 1) * $limit;

                                if ($connect->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $query = "SELECT * FROM events ORDER BY event_name ASC LIMIT {$offset},{$limit}";
                                if ($result = $connect->query($query)) {
                                    if ($result->num_rows > 0) {
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
                                    }
                                }
                            } else if (isset($_POST['descending'])) {
                                $count = 0;
                                //add pagination logic
                                $limit = 3;
                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $offset = ($page - 1) * $limit;

                                if ($connect->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $query = "SELECT * FROM events ORDER BY event_name DESC LIMIT {$offset},{$limit}";
                                if ($result = $connect->query($query)) {
                                    if ($result->num_rows > 0) {
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
                                    }
                                }
                            } else {
                                $count = 0;
                                //add pagination logic
                                $limit = 3;
                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $offset = ($page - 1) * $limit;

                                if ($connect->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $query = "SELECT * FROM events LIMIT {$offset},{$limit}";
                                if ($result = $connect->query($query)) {
                                    if ($result->num_rows > 0) {
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
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- fetch data for pagination -->
                    <div class="page-info">
                        Showing <?= isset($_GET['page']) ? (int)$_GET['page'] : 1 ?> of Pages
                    </div>
                    <?php
                    $sql1 = "SELECT * FROM events";
                    $result1 = $connect->query($sql1);
                    if ($result1 && $result1->num_rows > 0) {
                        $total_records = $result1->num_rows;

                        $total_page = ceil($total_records / $limit);
                    ?>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">

                                <?php
                                for ($i = 1; $i <= $total_page; $i++) {
                                    echo '<li class="page-item"><a class="page-link" href="event.php?page=' . $i . '">' . $i . '</a></li>';
                                }
                                ?>
                            </ul>
                        <?php
                    }
                        ?>

                        <!-- <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav> -->

                </div>


            </div>
        </div>

    </div>


    <div class="col-4">
        <div class="card text-black  mb-3" style="max-width: 40rem;">
            <div class="card-header bg-secondary">Add Event Information</div>
            <div class="card-body">
                <form action="event_manage_data.php" method="POST">

                    <?php if (isset($_SESSION['event_add_success'])) : ?>
                        <label class="text-success"><?= $_SESSION['event_add_success'] ?></label>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['event_add_error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['event_add_error'] ?></label>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['event_name_error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['event_name_error'] ?></label>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['event_date_error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['event_date_error'] ?></label>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['event_time_error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['event_time_error'] ?></label>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['event_description_error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['event_description_error'] ?></label>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['event_category_error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['event_category_error'] ?></label>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['event_ticketprice_error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['event_ticketprice_error'] ?></label>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['event_tickettotal_error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['event_tickettotal_error'] ?></label>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['duplicate_time_error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['duplicate_time_error'] ?></label>
                    <?php endif; ?>


                    <div class="mb-3">
                        <label class="form-label">Event Name</label>
                        <input type="text" class="form-control" name="event_name" placeholder=" Event Name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="event_date" placeholder="Date">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Time</label>
                        <input type="time" class="form-control" name="event_time" placeholder="Time">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category of Event</label>
                        <input type="text" class="form-control" name="event_category" placeholder="eg: Celebration, Movie, Gathering, Fair etc.">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Event Descirption</label>
                        <input type="text" class="form-control" name="event_description" placeholder="Event Descirption">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Venue Name</label>
                        <input type="text" class="form-control" name="event_venue" placeholder="Venue Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Event Ticket Price</label>
                        <input type="number" class="form-control" name="event_ticketprice" placeholder="Event Ticket Price">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Number of Tickets</label>
                        <input type="number" class="form-control" name="event_tickettotal" placeholder="Number of Tickets">
                    </div>
                    <button type="submit" class="btn btn-success" name="addevent" value="Add">Enter Event Information</button>
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


<!-- ajax query for search functionalities -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#event_search').keyup(function() {
            var input = $(this).val();
            // alert(input);
            if (input != "") {
                $.ajax({
                    url: "event_fetch.php",
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
                url: "event_fetch.php",
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

<!-- for filter functionality -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#fetchval").on('change', function() {
            var value = $(this).val();
            //alert(value);
            $.ajax({
                url: "event_fetch.php",
                type: "POST",
                data: {
                    request: value
                },
                beforeSend: function() {
                    $("#searchresult").html("<span>Working...</span>");
                },
                success: function(data) {
                    $("#searchresult").html(data);
                }
            });
        });
    });
</script>

</body>

</html>


<?php
unset($_SESSION['event_add_success']);
unset($_SESSION['event_add_error']);
unset($_SESSION['event_delete']);
unset($_SESSION['update_event_name']);
unset($_SESSION['update_event_date']);
unset($_SESSION['update_event_category']);
unset($_SESSION['update_event_time']);
unset($_SESSION['update_event_description']);
unset($_SESSION['update_event_venue']);
unset($_SESSION['update_event_ticketprice']);
unset($_SESSION['update_event_tickettotal']);
unset($_SESSION['duplicate_time_error']);
unset($_SESSION['event_name_error']);
unset($_SESSION['event_date_error']);
unset($_SESSION['event_time_error']);
unset($_SESSION['event_description_error']);
unset($_SESSION['event_category_error']);
unset($_SESSION['event_ticketprice_error']);
unset($_SESSION['event_tickettotal_error']);
unset($_SESSION['already_event_booked']);
unset($_SESSION['search_error']);

?>