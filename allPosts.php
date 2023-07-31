<?php
try {
	require 'db.php';
} catch (Exception $e) {
	echo 'DB file error: ',  $e->getMessage(), "\n";
}

try {
	$records = mysqli_query($conn, "SELECT * FROM posts");
	$users = mysqli_query($conn, "SELECT * FROM posts, users WHERE users_id = u_id");
	$allusers = mysqli_query($conn, "SELECT * FROM users");
	$row = mysqli_fetch_array($records);
} catch (Exception $e) {
	die("" . mysqli_error($conn));
	echo 'Failed to get data: ',  $e->getMessage(), "\n";
}

if ($records) {
	foreach ($records as $record) {
		$name = "";
		foreach ($users as $user) {
			if ($user['u_id'] === $record['users_id']) {
				$name =  $user['u_name'];
			}
		}
		$pid = $record['p_id'];
		$comms = mysqli_query($conn, "SELECT * FROM comms WHERE posts_id = '$pid'")
			or die("Failed to get data: " . mysqli_error($conn));

		/*
		<div id='imgCont'></div>
    <script type=\"text/javascript\" src='placeimage.js'>
    </script>
		replace <img> with sth as above...
		*/
		$crow = mysqli_fetch_array($comms);
		echo "<div id='post-cont'>
		<h4>#{$record['p_category']}</h4>
		<h2>{$record['p_title']}</h2>
		<h4>by {$name}</h4>
		<img src=`{$record['p_image']}` alt=''></img>
		<p>{$record['p_text']}</p>
		<h5>Edited: {$record['p_edited']}</h5>
		<h5>Created: {$record['p_created']}</h5>";
		if ($comms) {
			foreach ($comms as $comm) {
				$cname = "";
				foreach ($allusers as $cuser) {
					if ($cuser['u_id'] === $comm['users_id']) {
						$cname =  $cuser['u_name'];
					}
				}
				echo "<div id='comm-cont'>
				<h4>by {$cname}</h4>
				<p>{$comm['c_text']}</p>
				<h5>Created: {$comm['c_created']}</h5>
				</div>";
			}
		} else {
			echo "<div id='comm-cont'>No comments found.</div>";
		}
		echo "</div>";
	}
} else {
	echo "<div id='post-cont'>No posts found.</div>";
}
