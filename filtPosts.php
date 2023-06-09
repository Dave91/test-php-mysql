<?php
try {
	require 'db.php';
} catch (Exception $e) {
	echo 'DB file error: ',  $e->getMessage(), "\n";
}
$query = "";
if ($filtCat !== "" && $filtUser !== "") {
	$query = "SELECT * FROM posts WHERE users_id = '$filtUser' AND p_category = '$filtCat'";
} else {
	$query = "SELECT * FROM posts WHERE users_id = '$filtUser' OR p_category = '$filtCat'";
}
$records = mysqli_query($conn, $query)
	or die("Failed to get data: " . mysqli_error($conn));
$users = mysqli_query($conn, "SELECT * FROM posts, users WHERE users_id = u_id")
	or die("Failed to get data: " . mysqli_error($conn));
$row = mysqli_fetch_array($records);

if ($records) {
	foreach ($records as $record) {
		$name = "";
		foreach ($users as $user) {
			if ($user['u_id'] === $record['users_id']) {
				$name =  $user['u_name'];
			}
		}
		echo "<div id='post-cont'>
		<h4>#{$record['p_category']}</h4>
		<h2>{$record['p_title']}</h2>
		<h4>by {$name}</h4>
		<img src=`{$record['p_image']}` alt=''></img>
		<p>{$record['p_text']}</p>
		<h5>Edited: {$record['p_edited']}</h5>
		<h5>Created: {$record['p_created']}</h5>
		</div>";
	}
} else {
	echo "<div id='post-cont'>No posts found.</div>";
}
