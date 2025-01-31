<?php
include('db_conn.php');
session_start();

if (isset($_GET['id'])) {
    $eid = $_GET['id'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>new page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card text-black  mb-3" style="max-width: 40rem;">
                    <div class="card-header bg-secondary">Edit Event Information</div>
                    <div class="card-body">
                        <form action="edit_event_data.php" method="POST">
                            <input type="hidden" class="form-control" value="<?= $eid ?>" name="id">

                            <?php if (isset($_SESSION['update_fail'])) : ?>
                                <label class="text-success"><?= $_SESSION['update_fail'] ?></label>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['fail_update_name'])) : ?>
                                <label class="text-success"><?= $_SESSION['fail_update_name'] ?></label>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['fail_update_date'])) : ?>
                                <label class="text-danger"><?= $_SESSION['fail_update_date'] ?></label>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['fail_update_time'])) : ?>
                                <label class="text-danger"><?= $_SESSION['fail_update_time'] ?></label>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['fail_update_category'])) : ?>
                                <label class="text-danger"><?= $_SESSION['fail_update_date'] ?></label>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['fail_update_description'])) : ?>
                                <label class="text-danger"><?= $_SESSION['fail_update_description'] ?></label>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['fail_update_veneu'])) : ?>
                                <label class="text-danger"><?= $_SESSION['fail_update_veneu'] ?></label>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['fail_update_ticketprice'])) : ?>
                                <label class="text-danger"><?= $_SESSION['fail_update_ticketprice'] ?></label>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['fail_update_tickettotal'])) : ?>
                                <label class="text-danger"><?= $_SESSION['fail_update_tickettotal'] ?></label>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label class="form-label">Event Name</label>
                                <input type="text" class="form-control" name="edit_event_name" placeholder=" Event Name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" name="edit_event_date" placeholder="Date">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control" name="edit_event_time" placeholder="Time">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category of Event</label>
                                <input type="text" class="form-control" name="edit_event_category" placeholder="eg: Celebration, Movie, Gathering, Fair etc.">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Event Descirption</label>
                                <input type="text" class="form-control" name="edit_event_description" placeholder="Event Descirption">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Venue Name</label>
                                <input type="text" class="form-control" name="edit_event_venue" placeholder="Venue Name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Event Ticket Price</label>
                                <input type="number" class="form-control" name="edit_event_ticketprice" placeholder="Event Ticket Price">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Number of Tickets</label>
                                <input type="number" class="form-control" name="edit_event_tickettotal" placeholder="Number of Tickets">
                            </div>
                            <button type="submit" class="btn btn-success" name="addevent" value="Add">Enter Event Information</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-4">

            </div>

        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-t6I8D5dJmMXjCsRLhSzCltuhNZg6P10kE0m0nAncLUjH6GeYLhRU1zfLoW3QNQDF" crossorigin="anonymous"></script>



</body>

</html>


<?php

unset($_SESSION['update_fail']);
unset($_SESSION['fail_name']);
unset($_SESSION['fail_info']);
unset($_SESSION['update_fail']);
unset($_SESSION['fail_update_name']);
unset($_SESSION['fail_update_name']);
unset($_SESSION['fail_update_date']);
unset($_SESSION['fail_update_time']);
unset($_SESSION['fail_update_category']);
unset($_SESSION['fail_update_description']);
unset($_SESSION['fail_update_veneu']);
unset($_SESSION['fail_update_ticketprice']);
unset($_SESSION['fail_update_tickettotal']);


?>