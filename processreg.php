<?php
try {
	require 'db.php';
} catch (Exception $e) {
	echo 'DB file error: ',  $e->getMessage(), "\n";
}

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$hashedpass = password_hash($password, PASSWORD_DEFAULT);

$check = mysqli_query($conn, "SELECT * FROM users WHERE u_name = '$username'")
	or die("Failed to get data: " . mysqli_error($conn));
$row = mysqli_fetch_array($check);
if (!$row) {
	$newuser = mysqli_query($conn, "INSERT INTO users (u_name, u_pass) VALUES ('$username', '$hashedpass')")
		or die("Failed to send data: " . mysqli_error($conn));
	echo "Registered as " . $newuser['u_name'];
	header("Location: /test-php-mysql/login.php");
} else {
	echo "Registration failed.";
	header("Location: /test-php-mysql/register.php");
}
