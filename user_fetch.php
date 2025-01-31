<?php
include('db_conn.php');
session_start();

if (isset($_POST['input'])) {
    $input = trim($_POST['input']); // Trim input to remove unnecessary spaces
    $sql = "SELECT * FROM users WHERE user_name LIKE ?";
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
                        <th scope="col">User Name</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">User Type</th>
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
                        echo "<td>{$row['user_name']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['usertype']}</td>";
                        echo "<td>----</td>";
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