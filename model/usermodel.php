<?php
// include('dbconnection.php');
session_start();

class User
{

    // function __construct()
    // {
    //     $this->conn = new mysqli("localhost", "root", "", "db_gestionvols");
    // }

    // function user_insert($username, $password,$email, $grade) {	

    // 	$query= "SELECT * FROM users WHERE username=?";
    // 	$stmt = $this->conn->prepare($query);
    // 	$stmt->bind_param("s",$email);
    // 	$stmt->execute();
    // 	$result= $stmt->get_result();
    // 	$row1 = mysqli_num_rows($result);

    // 	if ($row1 == 1) {

    // 		echo "user already taken";
    // 	} else {

    // 		$stmt =$this->conn->prepare("INSERT Into users (nom, prenom, email,password, statut) values(?,?,?,?,?)");
    // 		$stmt->bind_param("sssss", $username, $password, $email, $grade);
    // 		$stmt->execute();

    // 		header("Location: ../view/login.php");
    // 	}
    // }
    // LOGIN USER
    public static function user_login($username, $password)
    {
        global $db, $errors;
        $password = md5($password);
        $resulta = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' && password = '$password' ");

        if (mysqli_num_rows($resulta) > 0) {
            $data = mysqli_fetch_array($resulta);
            $id = $data['iduser'];
            $_SESSION['user'] = $data;
            if ($_SESSION["user"]["grade"] == 1) {
                header("Location: ../view/admin.php");
                # code...
            } else {
                # code...
                header("Location: userprofil.php?id=$id");
            }
        } else {
            array_push($errors, "user not fund");
        }
    }
    // REGISTER USER
    public static function user_register($username, $email, $password_1, $password_2, $grade)
    {
        global $db, $errors;

        // receive all input values from the form

        // form validation: ensure that the form is correctly filled
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (!empty($grade)) {
            if ($grade != "1337") {
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
                $text = $_SESSION['user'];
                echo $text;
                header('location: administration.php');
            } else {
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
    // escape string
    function e($val)
    {
        global $db;
        return mysqli_real_escape_string($db, trim($val));
    }



    // Update USER
    public static function user_update($id, $username, $email, $password_1, $password_2)
    {
        global $db;
        $errors = array();

        // receive all input values from the form

        // form validation: ensure that the form is correctly filled
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
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
            $user_type = 0;
            $query = "UPDATE users SET username = '$username', password = '$password', email = '$email' WHERE iduser = '$id'";
            $result = mysqli_query($db, $query);
            echo "user is updated successfully";
        }
    }

    function user_show($id)
    {

        $query = "SELECT * from users where iduser='$id'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        // $result = $stmt->get_result();
        // $row = $result->fetch_assoc();


        $result = $stmt->get_result();
        // $row = $result->fetch_assoc();
        return  $result;
    }
}
