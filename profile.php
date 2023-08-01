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
		<form action="postform.php">
			<button type="submit">Create Post</button>
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
		$query = "SELECT * FROM comms WHERE users_id = '$filtUser' ORDER BY c_id DESC LIMIT 3";
		$userposts = mysqli_query($conn, $query)
			or die("Failed to get data: " . mysqli_error($conn));
		$row = mysqli_fetch_array($userposts);
		if ($userposts) {
			echo "<div id='post-cont'>";
			foreach ($userposts as $post) {
				//title of commented post needed here first
				echo "<h2>{$post['c_text']}</h2>";
			}
			echo "<form action='mycomms.php'>
			<button type='submit'>View All</button>
			</form>
			</div>";
		}
		?>
		<?php
		//my likes
		$query = "SELECT * FROM likes WHERE users_id = '$filtUser' ORDER BY l_id DESC LIMIT 3";
		$userposts = mysqli_query($conn, $query)
			or die("Failed to get data: " . mysqli_error($conn));
		$row = mysqli_fetch_array($userposts);
		if ($userposts) {
			echo "<div id='post-cont'>";
			foreach ($userposts as $post) {
				echo "<h2>{$post['l_title']}</h2>";
			}
			echo "<form action='mylikes.php'>
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
