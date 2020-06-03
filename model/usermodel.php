<?php
// include('dbconnection.php');
session_start();

class User
{

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
                header("Location: adminprofil.php");
                # code...
            } else {
                # code...
                header("Location: userprofil.php?id=$id");
            }
        } else {
            array_push($errors, "Data insert is false");
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
                $results = mysqli_query($db, $query);
                $logged_in_user = mysqli_fetch_array($results);
                $_SESSION['user'] = $logged_in_user;

                $_SESSION['success']  = "New admin_user  successfully created!!";
                header('location: adminprofil.php');
            } else {
                $user_type = 0;
                $query = "INSERT INTO users VALUES('','$username','$password', '$email', '$user_type')";
                $results = mysqli_query($db, $query);
                $logged_in_user = mysqli_fetch_array($db);
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success']  = "New user  successfully created!!";
                header('location: index.php');
            }
        }
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

            $query = "UPDATE users SET username = '$username', password = '$password', email = '$email' WHERE iduser = '$id'";
            $result = mysqli_query($db, $query);
        }
    }

    function user_show($id)
    {
        global $db;
        $query = "SELECT * from users where iduser='$id'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return  $result;
    }
}
