<?php 
$host = "localhost";
$user = "root";
$password = "";
$database = "db_gestionVols";

//connecte the database
$db = mysqli_connect($host,$user,$password,$database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>