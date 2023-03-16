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

//$username = stripcslashes($username);
//$password = stripcslashes($password);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$result = mysqli_query($conn, "SELECT * FROM users WHERE u_name = '$username' AND u_pass = '$password'")
	or die("Failed to get data: " . mysqli_error($conn));
$row = mysqli_fetch_array($result);
if ($row['u_name'] == $username && $row['u_pass'] == $password) {
	echo "Logged in as " . $row['u_name'];
	header("Location: /test-php-mysql/home.php");
} else {
	echo "Login failed.";
	header("Location: /test-php-mysql/login.php");
}
