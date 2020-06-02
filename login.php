<?php
// connect to database
include "source/DB_connection.php";
include 'controller/logFunctions.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="css/login.css">
</head>

<body>



	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="login.php" method="POST">
				<h1>Create Account</h1>
				<span>Please fill all input</span>
				<input type="text" placeholder="Name" name="username" required="" />
				<input type="email" placeholder="Email" name="email" required="" />
				<input type="password" placeholder="Password" name="password" minlenght="8" required="" />
				<input type="password" placeholder="Confirm your Password" name="c_password" minlenght="8" required="" />
				<label> Only Admins</label>
				<input type="text" placeholder="Admin_Code" name="grade" />
				<button type="submit" name="register">Sign Up</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="login.php" method="POST">
				<h1>Sign in</h1>
				<input type="text" placeholder="Username" name="username" required="" />
				<input type="password" placeholder="Password" name="password" required="" />
				<a href="#">Forgot your password?</a>
				<button type="submit" name="login">Sign In</button>
				<?php display_error(); ?>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>If you alredy have one </h1>
					<p>Please login with to keep connected with us </p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello, Friend!</h1>
					<p>Enter your personal details and start journey with us</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>



	<script>
		const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const container = document.getElementById('container');

		signUpButton.addEventListener('click', () => {
			container.classList.add("right-panel-active");
		});

		signInButton.addEventListener('click', () => {
			container.classList.remove("right-panel-active");
		});
	</script>
</body>

</html>