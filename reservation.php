<?php

session_start();

$db = mysqli_connect("localhost", "root", "", "db_gestionVols");

$idVol = $_GET['id'];
//   $idClient = $_GET['idClient'];
$query1 = mysqli_query($db, "SELECT * from vols where idVol = '$idVol' ");

if ($row = mysqli_fetch_array($query1)) {
}

if (isset($_POST['reserver'])) {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $cin = $_POST['cin'];
  $phone = $_POST['phone'];

  $query2 = mysqli_query($db, "INSERT INTO client values('', '$nom', '$prenom', '$email', '$cin', '$phone')");
  $id_user = $_SESSION['user']['iduser'];
  if ($query2 == true) {
    $last_id = mysqli_insert_id($db);
    $query3 = mysqli_query($db, "INSERT INTO reservation values('', '$id_user','$last_id', '$idVol', now()) ");
  }

  if ($query3 == true) {
    $reserv_id = mysqli_insert_id($db);
  }

  $query4 = mysqli_query($db, " UPDATE vols SET place_disponible = place_disponible - 1 where idVol = '$idVol'  ");


  header("Location: confirmation.php?id=$reserv_id");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/reserver.css">

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>
  <?php include "source/navigation.php"; ?>



  <div class="header">
    <form action="" method="post">
      <h1>New <span>Booking</span> </h1>
      <div class="font-box">
        <div class="font">
          <input type="text" class="search-field skills" name="nom" placeholder="Name customer">
          <input type="text" class="search-field skills" name="prenom" placeholder="first name">
        </div>

        <div class="font">
          <input type="text" class="search-field skills" name="email" placeholder="Email Adresse">
          <input type="text" class="search-field skills" name="cin" placeholder="CIN">
        </div>

        <div class="font">
          <input type="text" class="search-field skills" name="phone" placeholder="Phone nember">
        </div>

        <div class="font">
          <button class="search-btn" type="submit" name="reserver"> Confirmer</button>

        </div>
      </div>
    </form>
  </div>



</body>

</html>