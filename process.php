<?php
include("db.php");
/* try {
    require 'db.php';
} catch (Exception $e) {
    echo 'DB file error: ',  $e->getMessage(), "\n";
} */
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

//same logic to be used in home when filtering e.g. show only user posts
session_start();
if (!isset($_SESSION['user_id'])) {
	//can login
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$result = mysqli_query($conn, "SELECT * FROM users WHERE u_name = '$username' AND u_pass = '$password'")
		or die("Failed to get data: " . mysqli_error($conn));
	$row = mysqli_fetch_array($result);
	if ($row['u_name'] == $username && $row['u_pass'] == $password) {
		echo "Logged in as " . $row['u_name'];
		$_SESSION['user_id'] = $row['u_id'];
		session_regenerate_id();
		header("Location: /test-php-mysql/user.php");
	} else {
		echo "Login failed.";
		header("Location: /test-php-mysql/login.php");
	}
} else {
	//to logout
	unset($_SESSION['user_id']);
	session_regenerate_id();
	header("Location: /test-php-mysql/login.php");
}
