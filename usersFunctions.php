<?php
//admin panal
$db = mysqli_connect('localhost', 'root', '', 'gestion_reservations');
$update = false;
$id = "";
$depart = "";
$destination = "";
$date_depart = "";
$num_place = "";
$prix = "";



if (isset($_POST['add'])) {
	$depart = $_POST['depart'];
	$destination = $_POST['destination'];
	$date_depart = $_POST['date_depart'];
	$num_place = $_POST['num_place'];
	$prix = $_POST['prix'];


	$query = "INSERT INTO vols (depart,destination,date_depart,num_place,prix)VALUES(?,?,?,?,?)";
	$stmt = $db->prepare($query);
	$stmt->bind_param("sssss", $depart, $destination, $date_depart, $num_place, $prix);
	$stmt->execute();
	header('location:admin/home.php');
	$_SESSION['response'] = "Successfully Inserted to the database!";
	$_SESSION['res_type'] = "success";
}
if (isset($_GET['delete'])) {
	$id = $_GET['delete'];

	$sql = "SELECT id FROM vols WHERE id=?";
	$stmt2 = $db->prepare($sql);
	$stmt2->bind_param("i", $id);
	$stmt2->execute();
	$result2 = $stmt2->get_result();
	$row = $result2->fetch_assoc();


	$query = "DELETE FROM vols WHERE id=?";
	$stmt = $db->prepare($query);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	header('location:admin/home.php');
	$_SESSION['response'] = "Successfully Deleted";
	$_SESSION['res_type'] = "danger";
}
if (isset($_GET['details'])) {
	$id = $_GET['details'];
	$query = "SELECT * From vols WHERE id =?";
	$stmt = $db->prepare($query);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();

	$vid = $row['id'];
	$vdepart = $row['depart'];
	$vdestination = $row['destination'];
	$vdate_depart = $row['date_depart'];
	$vnum_place = $row['num_place'];
	$vprix = $row['prix'];
}
