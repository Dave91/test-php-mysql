<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="./login.css" />
</head>

<body>
	<div id="form-cont">
		<form action="process.php" method="post">
			<input type="text" name="username" id="username" placeholder="username">
			<input type="password" name="password" id="password" placeholder="password">
			<button type="submit" id="submit-btn">Login</button>
		</form>
	</div>
</body>

<?php include("footer.php"); ?>

</html>