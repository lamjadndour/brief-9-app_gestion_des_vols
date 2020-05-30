<?php 
    session_start();
    // connect to database
    include ('DB_connection.php');
	

	// variable initia
	$username = "";
	$email    = "";
	$password = "";
	$grade    = '';
	$errors   = array(); 

	// call the register() function if register_btn is clicked
	if (isset($_POST['register'])) {
		register();
	}

	// call the login() function if register_btn is clicked
	if (isset($_POST['login'])) {
		login();
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ../login.php");
	}

	// REGISTER USER
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password']);
        $password_2  =  e($_POST['c_password']);
        $grade       = e($_POST['grade']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		if (!empty($grade)) { 
            if($grade != "1337"){
                array_push($errors, "admin code is wrong"); 
            }
			
		}
		
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);

			if ($grade == "1337") {
				$user_type = 1;
				$query = "INSERT INTO users VALUES('','$username','$password', '$email', '$user_type')";
                mysqli_query($db, $query);
                $logged_in_user_id = mysqli_insert_id($db);
                $_SESSION['user'] = getUserById($logged_in_user_id);
                $_SESSION['grade'] = "admin";
				$_SESSION['success']  = "New admin_user  successfully created!!";
				header('location: administration.php');
			}else{
				$user_type = 0;
				$query = "INSERT INTO users VALUES('','$username','$password', '$email', '$user_type')";
                mysqli_query($db, $query);
                $logged_in_user_id = mysqli_insert_id($db);
                $_SESSION['user'] = getUserById($logged_in_user_id);
                $_SESSION['grade'] = "user";
				$_SESSION['success']  = "New user  successfully created!!";
				header('location: index.php');			
			}

		}

	}

	// return user array from their id
	function getUserById($id){  
		global $db;
		$query = "SELECT * FROM users WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
                // check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['grade'] == 1) {

					$_SESSION['user'] = $logged_in_user;
                    $_SESSION['success']  = "You are now logged in";
					header('location: administration.php');		  
				}else{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: index.php');
				}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['grade'] == '1' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}


