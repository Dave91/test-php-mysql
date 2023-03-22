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
</head>

<body>

	<header id="menu-cont">
		<form action='user.php'>
			<button type='submit'>Home</button>
		</form>
		<form action='myposts.php'>
			<button type='submit'>My Posts</button>
		</form>
		<form action='mycomms.php'>
			<button type='submit'>My Comments</button>
		</form>
		<form action='mylikes.php'>
			<button type='submit'>My Likes</button>
		</form>
		<form action='process.php'>
			<button type='submit'>Logout</button>
		</form>
		<div id="filt-panel">
		</div>
	</header>
	<main>
		<?php
		//user data
		$query = "SELECT * FROM users WHERE u_id = '$filtUser'";
		$userdata = mysqli_query($conn, $query)
			or die("Failed to get data: " . mysqli_error($conn));
		$row = mysqli_fetch_array($userdata);

		if ($row) {
			echo "<div id='post-cont'>
					<h4>{$row['u_name']}</h4>
					<form>
					<input></input>
					<input></input>
					<button type='submit'>Save</button>
					</form>
					</div>";
			//<img src=`{$userdata['u_icon']}` alt=''></img> cat api??
			//<input placeholder=`{$userdata['u_email']}`></input> ??
		}
		?>
		<?php
		//my posts
		$query = "SELECT * FROM posts WHERE users_id = '$filtUser' ORDER BY p_id DESC LIMIT 3";
		$userposts = mysqli_query($conn, $query)
			or die("Failed to get data: " . mysqli_error($conn));
		$row = mysqli_fetch_array($userposts);
		if ($userposts) {
			echo "<div id='post-cont'>";
			foreach ($userposts as $post) {
				echo "<h2>{$post['p_title']}</h2>";
			}
			echo "<form action='myposts.php'>
			<button type='submit'>View All</button>
			</form>
			</div>";
		}
		?>
		<?php
		//my comms
		$query = "SELECT * FROM posts WHERE users_id = '$filtUser' ORDER BY p_id DESC LIMIT 3";
		$userposts = mysqli_query($conn, $query)
			or die("Failed to get data: " . mysqli_error($conn));
		$row = mysqli_fetch_array($userposts);
		if ($userposts) {
			echo "<div id='post-cont'>";
			foreach ($userposts as $post) {
				echo "<h2>{$post['p_title']}</h2>";
			}
			echo "<form action='myposts.php'>
			<button type='submit'>View All</button>
			</form>
			</div>";
		}
		?>
		<?php
		//my likes
		$query = "SELECT * FROM posts WHERE users_id = '$filtUser' ORDER BY p_id DESC LIMIT 3";
		$userposts = mysqli_query($conn, $query)
			or die("Failed to get data: " . mysqli_error($conn));
		$row = mysqli_fetch_array($userposts);
		if ($userposts) {
			echo "<div id='post-cont'>";
			foreach ($userposts as $post) {
				echo "<h2>{$post['p_title']}</h2>";
			}
			echo "<form action='myposts.php'>
			<button type='submit'>View All</button>
			</form>
			</div>";
		}
		?>
	</main>
</body>

</html>

<?php
include("footer.php");
