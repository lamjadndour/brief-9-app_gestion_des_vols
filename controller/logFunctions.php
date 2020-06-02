<?php

include "model/usermodel.php";


$errors   = array();

// call the register() function if register_btn is clicked
if (isset($_POST['register'])) {
	ft_register();
}

// call the login() function if register_btn is clicked
if (isset($_POST['login'])) {
	ft_login();
}

function ft_register()
{
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password']);
	$password_2  =  e($_POST['c_password']);
	$grade		 = 	e($_POST['grade']);
	$logup_user = new User;
	$logup_user->user_register($username, $email, $password_1, $password_2, $grade);
}

function ft_login()
{
	$username    =  e($_POST['username']);
	$password  =  e($_POST['password']);
	$login_user = new User;
	$login_user->user_login($username, $password);
}


// escape string
function e($val)
{
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

// display errors
function display_error()
{
	global $errors;

	if (count($errors) > 0) {
		echo '<div class="bg-red">';
		foreach ($errors as $error) {
			echo $error . '<br>';
		}
		echo '</div>';
	}
}
