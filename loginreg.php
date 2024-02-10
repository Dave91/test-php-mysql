<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="./loginreg.css" />
</head>

<body>

	<div class="container" id="container">
		<div class="form-container sign-up" id="reg-form">
			<form action="processreg.php" method="post">
				<h1>Register</h1>
				<input type="text" name="username" id="username" placeholder="username">
				<input type="password" name="password" id="password" placeholder="password">
				<button type="submit" id="signupbtn">Register</button>
			</form>
		</div>
		<div class="form-container sign-in" id="login-form">
			<form action="process.php" method="post">
				<h1>Login</h1>
				<input type="text" name="username" id="username" placeholder="username">
				<input type="password" name="password" id="password" placeholder="password">
				<a href="#">Forgot Your Password?</a>
				<button type="submit" id="signinbtn">Login</button>
			</form>
		</div>
		<div class="toggle-container">
			<div class="toggle">
				<div class="toggle-panel toggle-left">
					<h1>Welcome Back!</h1>
					<button class="hidden" id="login">Login</button>
				</div>
				<div class="toggle-panel toggle-right">
					<h1>Welcome!</h1>
					<button class="hidden" id="register">Register</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		const container = document.getElementById('container');
		const registerBtn = document.getElementById('register');
		const loginBtn = document.getElementById('login');

		registerBtn.addEventListener('click', () => {
			container.classList.add("active");
		});

		loginBtn.addEventListener('click', () => {
			container.classList.remove("active");
		});
	</script>

	<?php include("footer.php"); ?>

</body>

</html>