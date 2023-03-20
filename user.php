<?php
session_start();
if (!isset($_SESSION['user_id'])) {
	exit;
}

try {
	require 'db.php';
} catch (Exception $e) {
	echo 'DB file error: ',  $e->getMessage(), "\n";
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
	<header id="menu-cont">
		<form action='process.php'>
			<button id="btn-log" type='submit'>Logout</button>
		</form>
		<script>
			var fCat = false;
			var fUser = false;

			function onFiltCat(inp) {
				fCat = inp.current.value;
				console.log(fCat);
			}

			function onFiltUser() {
				fUser = true;
			}
		</script>
		<form method="post">
			<button type="submit">Filter</button>
			<select name="filtByCat" onchange=onFiltCat(inp)>
				<option></option>
				<option>books</option>
				<option>movies</option>
				<option>music</option>
				<option>nature</option>
				<option>poetry</option>
			</select>
			<select name="filtByUser" onchange=onFiltUser()>
				<option></option>
				<?php
				$users = mysqli_query($conn, "SELECT * FROM users")
					or die("Failed to get data: " . mysqli_error($conn));
				$row = mysqli_fetch_array($users);

				if ($users) {
					foreach ($users as $user) {
						echo "<option value={$user['u_id']}>{$user['u_name']}</option>";
					}
				}
				?>
			</select>
		</form>
	</header>
</body>

</html>

<?php
$filtCat = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['filtByCat'] : "";
$filtUser = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['filtByUser'] : "";

if ($filtCat !== "" || $filtUser !== "") {
	include("filtPosts.php");
} else {
	include("allPosts.php");
}
?>

<?php
include("footer.php");
