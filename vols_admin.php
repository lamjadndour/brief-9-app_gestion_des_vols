<?php
include "source/header.php";
include "model/usermodel.php";
include "model/vol_model.php";
include "source/DB_connection.php";


$id = $_GET['id'];
$query = mysqli_query($db, "SELECT * from vols where idVol='$id'");

if ($row = mysqli_fetch_array($query)) {
}
if (isset($_POST['modifier'])) {
	$id1               = $_POST['id1'];
	$depart            = $_POST['depart'];
	$destination       = $_POST['destination'];
	$date_depart       = $_POST['date'];
	$time              = $_POST['time'];
	$prix              = $_POST['prix'];
	$place_disponible  = $_POST['place'];
	$status            = $_POST['status'];



	$vols = new Vol();
	$vols->vol_update($id1, $depart, $destination, $date_depart, $time, $prix, $place_disponible, $status);

	if ($vols == true) {
		header("location: adminprofil.php");
	}
}
?>

<link rel="stylesheet" href="css/update.css">
</nav>
<div class="boxContent">
	<div class="firstRow">

		<form action="" method="post">
			<h2 style="text-align:center; margin-bottom: 30px">Edit Admin</h2>
			<input type="hidden" name="id1" value="<?php echo $row['idVol']; ?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Depart</label>
				<input type="text" class="form-control" name="depart" value="<?php echo $row['depart']; ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Destinatio</label>
				<input type="text" class="form-control " name="destination" value="<?php echo $row['destination']; ?>">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">Date depart</label>
				<input type="date" class="form-control" name="date" value="<?php echo $row['date_depart']; ?>">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">Time</label>
				<input type="text" class="form-control" name="time" value="<?php echo $row['time']; ?>">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">Prix</label>
				<input type="text" class="form-control" name="prix" value="<?php echo $row['prix']; ?>">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">Place desponible</label>
				<input type="number" class="form-control" name="place" value="<?php echo $row['place_disponible']; ?>" min="1" max="50">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">Status</label>
				<select name="status" class="form-control" id="inputGroupSelect01">

					<option value="Activer">Activer</option>
					<option value="Desactiver">Desactiver</option>

				</select>
			</div>

			<div class="form-group">

			</div>

			<button type="submit" class="btn btn-success" name="modifier">Submit</button>
			<button type="submit" class="btn btn-red"><a href="admin.php">cannel</a></button>
		</form>



		</body>

		</html>