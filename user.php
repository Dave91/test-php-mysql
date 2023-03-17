<?php
session_start();
if (!isset($_SESSION['user_id'])) {
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
	<link rel="stylesheet" type="text/css" href="./user.css" />
	<link rel="stylesheet" type="text/css" href="./menu.css" />
</head>

<body>
	<form id="menu-cont" action='process.php'>
		<button id="btn-log" type='submit'>Logout</button>
		<select>
			<option>books</option>
			<option>movies</option>
			<option>music</option>
			<option>nature</option>
			<option>poetry</option>
		</select>
	</form>
</body>

</html>

<?php
include("allPosts.php");
?>

<?php
include("footer.php");
