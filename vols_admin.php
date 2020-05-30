<?php
include('logFunctions.php');

if (!isAdmin()) {
	echo "You must be admin first";
	header('refresh:3; url=login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sky flight</title>
	<!-- <link rel="stylesheet" type="text/css" href="../style.css"> -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <?php 
        include ('navigation.php') 
    ?>


	<div class="container-fluid">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success">
				<h3>
					<?php
					echo $_SESSION['success'];
					unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<div class="raw justify-content-center">
			<div class="col-md-12">
				<h3 class="text-center text-dark mat-2">Gestion de Vols</h3>
				<hr>
				<?php if (isset($_SESSION['response'])) { ?>
					<div class="alert alert-<?= $_SESSION['res_type'] ?> alert-dismissible text-center">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<b> <?= $_SESSION['response']; ?></b>
					</div>
				<?php }
				unset($_SESSION['response']); ?>
			</div>
		</div>
		<div class="raw">
			<div class="col-md-12">
				<h3 class="text-center text-info">Add Vols</h3>
				<form action="../functions.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?= $id; ?>">
					<div class="form-group">
						<input type="text" name="depart" value="<?= $depart; ?>" class="form-control" placeholder="Enter Depart" required>
					</div>
					<div class="form-group">
						<input type="text" name="destination" value="<?= $destination; ?>" class="form-control" placeholder="Enter Destination" required>
					</div>
					<div class="form-group">
						<input type="date" name="date_depart" value="<?= $date_depart; ?>" class="form-control" placeholder="Enter Date Depart" required>
					</div>
					<div class="form-group">
						<input type="nmber" name="num_place" value="<?= $num_place; ?>" class="form-control" placeholder="Enter Number de place" required>
					</div>
					<div class="form-group">
						<input type="number" name="prix" value="<?= $prix; ?>" class="form-control" placeholder="Enter Prix" required>
					</div>
					<div class="form-group">
						<?php if ($update == true) { ?>
							<input type="submit" name="update" class="btn btn-success btn-block" value="update Record">
						<?php } else { ?>
							<input type="submit" name="add" class="btn btn-primary btn-block" value="Add Record">
						<?php } ?>
					</div>
				</form>
			</div>
			<div class="col-md-12">
				<?php
				$query = "SELECT * FROM vols";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$result = $stmt->get_result();
				?>
				<div class="blink" style="margin-top: 20px;"></div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>depart</th>
							<th>destination</th>
							<th>date_depart</th>
							<th>num_place</th>
							<th>prix</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row = $result->fetch_assoc()) { ?>
							<tr>
								<td><?= $row['id']; ?></td>
								<td><?= $row['depart']; ?></td>
								<td><?= $row['destination']; ?></td>
								<td><?= $row['date_depart']; ?></td>
								<td><?= $row['num_place']; ?></td>
								<td><?= $row['prix']; ?></td>
								<td>
									<a href="details.php?details=<?= $row['id']; ?>" class="badge badge-primary p-2">Details</a>
									<a href="../functions.php?delete=<?= $row['id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Do you want to cancel this ?')">Cancel</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>

	<div class="blink" style="margin-top: 200px;"></div>




	<div class="card text-center">
		<div class="card-header">
			Fonctionnalités
		</div>
		<div class="card-body">
			<h5 class="card-title">© 2020 Sky flight </h5>
			<p class="card-text">Tous droits réservés </p>
			<a href="home.php" class="btn btn-primary">Retour à l'accueil</a>
		</div>
		<div class="card-footer text-muted">
			Il y a deux jours
		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>




</body>

</html>