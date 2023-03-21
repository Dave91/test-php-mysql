<?php
session_start();
if (isset($_SESSION['user_id'])) {
	header("Location: /test-php-mysql/user.php");
}

try {
	require 'db.php';
} catch (Exception $e) {
	echo 'DB file error: ',  $e->getMessage(), "\n";
}
//vars for filtpanel
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
	<link rel="stylesheet" type="text/css" href="./base.css" />
	<link rel="stylesheet" type="text/css" href="./menu.css" />
	<link rel="stylesheet" type="text/css" href="./postcard.css" />
</head>

<body>
	<header id="menu-cont">
		<form action='login.php'>
			<button type='submit'>Login</button>
		</form>
		<form action='register.php'>
			<button type='submit'>Register</button>
		</form>
		<div id="filt-panel">
			<?php include("filtpanel.php"); ?>
		</div>
	</header>
	<main>
		<?php
		if ($filtCat !== "" || $filtUser !== "") {
			include("filtPosts.php");
		} else {
			include("allPosts.php");
		}
		?>
	</main>
	<?php include("footer.php"); ?>
</body>

</html>