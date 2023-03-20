<?php
session_start();
if (isset($_SESSION['user_id'])) {
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="./home.css" />
	<link rel="stylesheet" type="text/css" href="./menu.css" />
</head>

<body>
	<header id="menu-cont">
		<form action='login.php'>
			<button type='submit'>Login</button>
		</form>
		<form action='register.php'>
			<button type='submit'>Register</button>
		</form>
	</header>
</body>

</html>

<?php
include("allPosts.php");
?>

<?php
include("footer.php");
