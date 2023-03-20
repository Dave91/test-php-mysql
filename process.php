<?php
try {
	require 'db.php';
} catch (Exception $e) {
	echo 'DB file error: ',  $e->getMessage(), "\n";
}

session_start();
if (!isset($_SESSION['user_id'])) {
	//can login
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$result = mysqli_query($conn, "SELECT * FROM users WHERE u_name = '$username'")
		or die("Failed to get data: " . mysqli_error($conn));
	$row = mysqli_fetch_array($result);
	$hashedpass = $row['u_pass'];
	if (password_verify($password, $hashedpass)) {
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
