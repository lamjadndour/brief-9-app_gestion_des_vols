<?php

include "model/usermodel.php";


$errors   = array();

// Login respond 
if (isset($_POST['login'])) {
	$username    =  e($_POST['username']);
	$password  =  e($_POST['password']);
	User::user_login($username, $password);
}

// Sign-up respond 
if (isset($_POST['register'])) {
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password']);
	$password_2  =  e($_POST['c_password']);
	$grade		 = 	e($_POST['grade']);
	$logup_user = new User;
	$logup_user->user_register($username, $email, $password_1, $password_2, $grade);
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
