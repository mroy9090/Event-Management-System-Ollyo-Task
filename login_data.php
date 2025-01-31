<?php
session_start();
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	$uname = trim($_POST['uname']);
	$pass = trim($_POST['password']);

	if (empty($uname)) {
		$_SESSION['user_error'] = "User Name is required";
		header("Location: index.php");
		exit();
	} else if (empty($pass)) {
		$_SESSION['pass_error'] = "Password is required";
		header("Location: index.php");
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE user_name = ?";
		$stmt = $connect->prepare($sql);
		if ($stmt) {
			$stmt->bind_param("s", $uname); 
			$stmt->execute();
			$result = $stmt->get_result();

			if ($result->num_rows === 1) {
				$row = $result->fetch_assoc();
				if (password_verify($pass, $row['password'])) {
					$_SESSION['user_name'] = $row['user_name'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['id'] = $row['id'];
					$_SESSION['usertype']= $row['usertype'];
					header("Location: home.php");
					exit();
				} else {
					$_SESSION['login_error'] = "Incorrect User Name or Password";
					header("Location: index.php");
					exit();
				}
			} else {
				$_SESSION['login_error'] = "Incorrect User Name or Password";
				header("Location: index.php");
				exit();
			}
		} else {
			$_SESSION['db_error'] = "Database error occurred";
			header("Location: index.php");
			exit();
		}
	}
} else {
	header("Location: index.php");
	exit();
}
