<?php
try {
	require 'db.php';
} catch (Exception $e) {
	echo 'DB file error: ',  $e->getMessage(), "\n";
}

$records = mysqli_query($conn, "SELECT * FROM posts")
	or die("Failed to get data: " . mysqli_error($conn));
$users = mysqli_query($conn, "SELECT * FROM users")
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
		<h2>{$record['p_title']}</h2>
		<h4>by {$name}</h4>
		<img src=`{$record['p_image']}` alt=''></img>
		<p>{$record['p_text']}</p>
		<p>{$record['p_category']}</p>
		<p>{$record['p_edited']}</p>
		<p>{$record['p_created']}</p>
		</div>";
	}
} else {
	echo "<div id='post-cont'>No posts found.</div>";
}
