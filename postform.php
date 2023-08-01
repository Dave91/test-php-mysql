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
$filtCat = "";
$filtUser = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="./base.css" />
	<link rel="stylesheet" type="text/css" href="./menu.css" />
	<link rel="stylesheet" type="text/css" href="./postcard.css" />
	<link rel="stylesheet" type="text/css" href="./postform.css" />
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
		</div>
	</header>
	<main>
		<?php
		$label = "Create Post";
		echo "<div id='post-cont'>
			<form id='post-form' action='processpost'>
			<h2>{$label}</h2>
			<div id='form-fields'>
			<label>Title (required):</label>
			<input id='title' type='text' required placeholder='post title'></input>
			<label>Content (required):</label>
			<textarea id='content' required placeholder='post text'></textarea>
			<label>Category (required):</label>
			<select id='category' required>
				<option>books</option>
				<option>games</option>
				<option>movies</option>
				<option>music</option>
				<option>nature</option>
				<option>poetry</option>
			</select>
			<label>Image (optional):</label>
			<input id='image' type='file'></input>
			</div>
			<div id='form-actions'>
				<button type='submit' id='form-button'>
					{$label}
				</button>
			</div>
			</form>
			</div>
			";
		/*//user data
		$query = "SELECT * FROM users WHERE u_id = '$filtUser'";
		$userdata = mysqli_query($conn, $query)
			or die("Failed to get data: " . mysqli_error($conn));
		$row = mysqli_fetch_array($userdata);

		if ($row) {
			echo "<div id='post-cont'>
					<h4>Welcome, {$row['u_name']} !</h4>
					<form>
					<br>
					<label>Password</label>
					<input placeholder='new password'></input>
					<input placeholder='new password again'></input>
					<button type='submit'>Modify</button>
					</form>
					</div>";
			//<img src=`{$row['u_icon']}` alt=''></img> cat api??
			//<input placeholder=`{$row['u_email']}`></input> ??
		}
		*/ ?>
	</main>
</body>

</html>

<?php
include("footer.php");
