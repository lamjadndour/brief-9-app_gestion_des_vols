<?php

include "model/usermodel.php";

// variable initia
// $username = "";
// $email    = "";
// $password = "";
// $grade    = '';
$errors   = array();

// call the register() function if register_btn is clicked
if (isset($_POST['register'])) {
	ft_register();
}

// call the login() function if register_btn is clicked
if (isset($_POST['login'])) {
	ft_login();
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
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


// return user array from their id
function getUserById($id)
{
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}


function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	} else {
		return false;
	}
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['grade'] == '1') {
		return true;
	} else {
		return false;
	}
}

// escape string
function e($val)
{
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

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
