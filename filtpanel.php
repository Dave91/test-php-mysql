<form method="post">
	<button type="submit">Filter</button>
	<select name="filtByCat">
		<option></option>
		<option <?php echo ($filtCat === 'books') ? 'selected' : '' ?>>books</option>
		<option <?php echo ($filtCat === 'games') ? 'selected' : '' ?>>games</option>
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