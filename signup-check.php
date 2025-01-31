<?php
session_start();
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['re_password']) && isset($_POST['usertype'])) {
	$uname = trim($_POST['uname']);
	$pass = trim($_POST['password']);
	$re_pass = trim($_POST['re_password']);
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$utype = trim($_POST['usertype']);
	$user_data = 'uname=' . $uname . '&name=' . $name;
	//generate unique user_id for user table
	$random_id = "event-" . mt_rand(10, 1000);
	$uid = $random_id;
	

	if (empty($uname)) {
		$_SESSION['uname'] = "User Name is required";
		header("Location: signup.php");
		exit();
	}
	 else if (empty($pass)) {
		$_SESSION['password_error'] =" Password is required";
		header("Location: signup.php");
		exit();
	} else if (empty($re_pass)) {
		$_SESSION['re_password_error'] = "Re Password is required";
		header("Location: signup.php");
		exit();
	} else if (empty($name)) {
		$_SESSION['name'] = "Name is required";
		header("Location: signup.php");
		exit();
	} else if (empty($email)) {
		$_SESSION['email'] = "User Email is required";
		header("Location: signup.php");
		exit();
	} else if ($pass != $re_pass) {
		$_SESSION['pass_match_error'] = "The confirmation password does not match";
		header("Location: signup.php");
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
			
			$sql2 = "INSERT INTO users (user_name, password, name, user_id, email, usertype) VALUES (?, ?, ?, ?, ?, ?)";
			$stmt2 = $connect->prepare($sql2);
			$stmt2->bind_param("ssssss", $uname, $hashed_password, $name, $uid, $email, $utype);
			if ($stmt2->execute()) {
				$_SESSION['name'] = $uname;
				$_SESSION['usertype'] = $utype;
				header("Location: login.php");
				exit();
			} else {
				$_SESSION['error'] = "An unknown error occurred";
				header("Location: signup.php");
				exit();
			}
		}
	}
} else {
	header("Location: signup.php");
	exit();
}
