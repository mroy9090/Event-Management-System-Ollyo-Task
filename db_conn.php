<?php

$sname= "localhost";
$unmae= "root";
$password = "";
$db_name = "event";
$connect = new mysqli($sname, $unmae, $password, $db_name);

if (!$connect) {
	echo "Connection failed!";
}