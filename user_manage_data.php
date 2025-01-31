<?php
include("db_conn.php");
session_start();

// User Add Logic
if (isset($_POST['adduser'])) {
    $uname = trim($_POST['uname']);
    $pass = trim($_POST['password']);
    $name = trim($_POST['name']);
    $email = trim($_POST['uemail']);
    $utype = trim($_POST['usertype']);
    $random_id = "event-" . mt_rand(10, 1000);
    $uid = $random_id;

    if (empty($uname)) {
        $_SESSION['uname_error'] = "User Name is required";
        header("Location: user_manage.php");
        exit(); // Always exit after a header redirect
    } else if (empty($pass)) {
        $_SESSION['password'] = "Password is required";
        header("Location: user_manage.php");
        exit();
    } else if (empty($name)) {
        $_SESSION['name_error'] = "Name is required";
        header("Location: user_manage.php");
        exit();
    } else if (empty($email)) {
        $_SESSION['uemail_error'] = "User Email is required";
        header("Location: user_manage.php");
        exit();
    } else if (empty($utype)) {
        $_SESSION['user_type_error'] = "User Type is required";
        header("Location: user_manage.php");
        exit();
    } else {
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM users WHERE user_name = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header("Location: signup.php?error=The username is taken. Try another&$user_data");
            exit();
        } else {

            $sql2 = "INSERT INTO users (user_id, user_name, password, name, email, usertype) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt2 = $connect->prepare($sql2);
            if (!$stmt2) {
                // Output the error if prepare() fails
                echo "Error preparing query: " . $connect->error;
                exit();
            }
            $stmt2->bind_param("ssssss", $uid, $uname, $hashed_password, $name, $email, $utype);

            // Execute the query
            if ($stmt2->execute()) {
                $_SESSION['success'] = "User Added successfully";
                header("Location: user_manage.php");
                exit();
            } else {
                // Output the actual error if execution fails
                $_SESSION['error'] = "Error: " . $stmt2->error;
                header("Location: user_manage.php");
                exit();
            }
        }
    }


}



//user edit logic




?>
