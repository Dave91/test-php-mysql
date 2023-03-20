<?php
session_start();
if (!isset($_SESSION['user_id'])) {
	header("Location: /test-php-mysql/home.php");
}

try {
	require 'db.php';
} catch (Exception $e) {
	echo 'DB file error: ',  $e->getMessage(), "\n";
}
$filtCat = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['filtByCat'] : "";
$filtUser = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['filtByUser'] : "";
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

	<header id="menu-cont">
		<form action='profile.php'>
			<button type='submit'>My Profile</button>
		</form>
		<form action='process.php'>
			<button type='submit'>Logout</button>
		</form>
		<div id="filt-panel">
			<form method="post">
				<button type="submit">Filter</button>
				<select name="filtByCat">
					<option></option>
					<option <?php echo ($filtCat === 'books') ? 'selected' : '' ?>>books</option>
					<option <?php echo ($filtCat === 'movies') ? 'selected' : '' ?>>movies</option>
					<option <?php echo ($filtCat === 'music') ? 'selected' : '' ?>>music</option>
					<option <?php echo ($filtCat === 'nature') ? 'selected' : '' ?>>nature</option>
					<option <?php echo ($filtCat === 'poetry') ? 'selected' : '' ?>>poetry</option>
				</select>
				<select name="filtByUser">
					<option></option>
					<?php
					$users = mysqli_query($conn, "SELECT * FROM users")
						or die("Failed to get data: " . mysqli_error($conn));
					$row = mysqli_fetch_array($users);

					if ($users) {
						foreach ($users as $user) {
							$selected = ($filtUser === $user['u_id']) ? 'selected' : '';
							echo "<option value={$user['u_id']} {$selected}>{$user['u_name']}</option>";
						}
					}
					?>
				</select>
			</form>
		</div>
	</header>
</body>

</html>

<?php

if ($filtCat !== "" || $filtUser !== "") {
	include("filtPosts.php");
} else {
	include("allPosts.php");
}
?>

<?php
include("footer.php");
