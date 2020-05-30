<?php
// include('dbconnection.php');
    session_start();

    class User{

		function __construct() {
			$this->conn = new mysqli("localhost","root","","db_gestionvols");
		}

		function user_insert($username, $password,$email, $grade) {	

			$query= "SELECT * FROM users WHERE username=?";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param("s",$email);
			$stmt->execute();
			$result= $stmt->get_result();
			$row1 = mysqli_num_rows($result);

			if ($row1 == 1) {
			
				echo "user already taken";
			} else {
				
				$stmt =$this->conn->prepare("INSERT Into users (nom, prenom, email,password, statut) values(?,?,?,?,?)");
				$stmt->bind_param("sssss", $username, $password, $email, $grade);
				$stmt->execute();
				
				header("Location: ../view/login.php");
			}
        }
        
		function user_check($username, $password) {

			$query= "SELECT * FROM users WHERE username=? && password =? ";
			$stmt =$this->conn->prepare($query);
			$stmt->bind_param("ss",$username,$password);
			$stmt->execute();
			$result= $stmt->get_result();
			$row1 = mysqli_num_rows($result);
			$row2 = $result->fetch_assoc();

			$_SESSION["user"] = $row2;

			// The mysqli_num_rows() function returns the number of rows in a result set.

			if ($row1 == 1 ) {
				if ($row2["grade"] == 1) {
					header("Location: ../view/admin.php");
					# code...
				} else {
					# code...
					header("Location: ../view/index2.php");
				}
					
			} else {
				header("Location: ../view/index.php");
			}
        }
        
		function user_update($id,$username, $password,$email, $password) {
            $password = md5($password);
			mysqli_query($this->conn, "UPDATE `users` SET `username` = '$username', `password` = '$password', `email` = '$email' , `password` = '$password' WHERE `iduser` = '$id'") or die(mysqli_error());
			header("location: ../view/login.php");
        }
        
		function user_show($id) {

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
?>