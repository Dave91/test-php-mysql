<?php
include("db.php");
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//$conn = mysqli_connect("localhost", "dbadmin", "admin8891", "testphpblog");

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);


$result = mysqli_query($conn, "SELECT * FROM users WHERE users_name = '$username' AND users_pass = '$password'")
	or die("Failed to get data: " . mysqli_error($conn));
$row = mysqli_fetch_array($result);
if ($row['users_name'] == $username && $row['users_pass'] == $password) {
	echo "Logged in as " . $row['users_name'];
} else {
	echo "Login failed.";
}
