<?php

include('header.php');
include('db_conn.php');
?>
<div class="row">

    <div class="col-8">
        <div class="card text-dark">
            <div class="card-header bg-secondary text-center">User Information</div>
            <div class="card-body" class="table-responsive">

                <table align="center">
                    <tbody>
                        <td>
                            <form action="user_manage.php" method="POST" align="center">
                                <input type="submit" class="btn btn-outline-primary" name="ascending" value="Ascending">
                                <input type="submit" class="btn btn-outline-secondary" name="descending" value="Descending">

                            </form>
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

                <table class="table table-bordered" id="searchresult">

                    <thead>
                        <tr>
                            <th scope="col">NO.</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">User Type</th>
                            <th scope="col">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['ascending'])) {
                            $count = 0;
                            if ($connect->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $query = "SELECT * FROM users ORDER BY name ASC";
                            if ($result = $connect->query($query)) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $count++;
                                        echo "<tr>";
                                        echo "<td>{$count}</td>";
                                        echo "<td>{$row['user_name']}</td>";
                                        echo "<td>{$row['name']}</td>";
                                        echo "<td>{$row['email']}</td>";
                                        echo "<td>{$row['usertype']}</td>";
                                        echo "<td>----</td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                        } else if (isset($_POST['descending'])) {
                            $count = 0;
                            if ($connect->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $query = "SELECT * FROM users ORDER BY name DESC";
                            if ($result = $connect->query($query)) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $count++;
                                        echo "<tr>";
                                        echo "<td>{$count}</td>";
                                        echo "<td>{$row['user_name']}</td>";
                                        echo "<td>{$row['name']}</td>";
                                        echo "<td>{$row['email']}</td>";
                                        echo "<td>{$row['usertype']}</td>";
                                        echo "<td>----</td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                        } else {
                            $count = 0;
                            if ($connect->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $query = "SELECT * FROM users ";
                            if ($result = $connect->query($query)) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $count++;
                                        echo "<tr>";
                                        echo "<td>{$count}</td>";
                                        echo "<td>{$row['user_name']}</td>";
                                        echo "<td>{$row['name']}</td>";
                                        echo "<td>{$row['email']}</td>";
                                        echo "<td>{$row['usertype']}</td>";
                                        echo "<td>----</td>";
                                        echo "</tr>";
                                    }
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
            <div class="card-header bg-secondary">Add User</div>
            <div class="card-body">
                <form action="user_manage_data.php" method="POST">
                    <?php if (isset($_SESSION['error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['error'] ?></label>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['success'])) : ?>
                        <label class="text-success"><?= $_SESSION['success'] ?></label>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <?php if (isset($_SESSION['name_error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['name_error'] ?></label>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">User Name</label>
                        <input type="text" class="form-control" name="uname" placeholder="User Name">
                    </div>
                    <?php if (isset($_SESSION['uname_error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['uname_error'] ?></label>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">User Email</label>
                        <br>
                        <input type="text" class="form-control" name="uemail" placeholder="User Email">
                    </div>
                    <?php if (isset($_SESSION['uemail_error'])) : ?>
                        <label class="text-danger"><?= $_SESSION['uemail_error'] ?></label>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <?php if (isset($_SESSION['password'])) : ?>
                        <label class="text-danger"><?= $_SESSION['password'] ?></label>
                    <?php endif; ?>
                    <label class="form-label">User Type</label>
                    <select class="form-control" name="usertype">
                        <option value="">Select</option>
                        <option value="NON-ADMIN">NON-ADMIN</option>
                        <option value="ADMIN">ADMIN</option>
                    </select>

                    <button type="submit" class="btn btn-success" name="adduser" value="Add">Add User</button>
                </form>
            </div>
        </div>

    </div>
</div>
</div>
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
                    url: "user_fetch.php",
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
                url: "user_fetch.php",
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
unset($_SESSION['uname_error']);
unset($_SESSION['name_error']);
unset($_SESSION['password']);
unset($_SESSION['user_type_error']);
unset($_SESSION['error']);
unset($_SESSION['success']);
unset($_SESSION['uemail_error']);
?>