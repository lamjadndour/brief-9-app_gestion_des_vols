<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Airways Deal</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>


  <?php
  session_start();
  include "source/navigation.php";
  include "source/DB_connection.php";

  ?>


  <div class="header">
    <form action="index.php" method="post">
      <h1>Find your <span>Next tour!</span> </h1>
      <p>Where would you like to go?</p>
      <div class="font-box">

        <select name="depart" class="search-field skills" id="inputGroupSelect01">
          <option selected>From...</option>
          <option value="casablanca">casa blanca</option>
          <option value="fes">Fès</option>
          <option value="safi">Safi</option>
          <option value="dakhla">dakhla</option>
          <option value="Salé">Salé</option>
        </select>

        <select name="destination" class="search-field skills" id="inputGroupSelect01">
          <option selected>To...</option>
          <option value="casablanca">Casa blanca</option>
          <option value="fes">Fès</option>
          <option value="safi">safi</option>
          <option value="dakhla">dakhla</option>
          <option value="Salé">Salé</option>
        </select>

        <button class="search-btn" type="submit" name="submit">Search</button>

      </div>
    </form>
  </div>

  <center>
    <h2>Available flights</h2>
    <h5>The best Deals to get a confortable fly </h5>
  </center>


  <?php
  $db = mysqli_connect("localhost", "root", "", "db_gestionvols");
  if (isset($_POST['submit'])) {
    $depart = $_POST['depart'];
    $destination = $_POST['destination'];
    $query = mysqli_query($db, "SELECT * FROM Vols WHERE depart = '$depart' AND destination = '$destination' AND place_disponible > 0 AND status = 'Activer' ");

    if (mysqli_num_rows($query) > 0) {
      $toWrite = '<div class="row row-cols-4  ">';
      while ($row = mysqli_fetch_array($query)) {
        $id = $row['idVol'];
        $depart = $row['depart'];
        $destination = $row['destination'];
        $date = $row['date_depart'];
        $time = $row['time'];
        $prix = $row['prix'];
        $nbrPlace = $row['place_disponible'];

        $toWrite .= '<div class="card mx-auto my-3" style="width: 5rem; min-width: 250px; max-width: 300px"" >';
        $toWrite .= '<h5 class="card-header text-center"> ' . $depart . '  <i class="fas fa-plane-departure"></i>   --->   <i class="fas fa-plane-arrival"></i> ' . $destination . '</h5>';
        $toWrite .= '<ul class="list-group list-group-flush">';
        $toWrite .= '<li class="list-group-item"> <i class="fas fa-calendar-day"></i> ' . $date . '</li>';
        $toWrite .= '<li class="list-group-item"> <i class="fas fa-clock"></i> ' . $time . '</li>';
        $toWrite .= '<li class="list-group-item"> <i class="fas fa-chair"></i> ' . $nbrPlace . '</li> ';
        $toWrite .= '<li class="list-group-item"> <i class="fas fa-hand-holding-usd"></i> ' . $prix . '</li> </ul>';
        $toWrite .= '<li class="list-group-item text-right"> <a class="btn btn-primary" href="reservation.php?id=' . $id . '">Reserver</a> </li> </ul> </div>';
      }
      $toWrite .= '</div>';
      echo $toWrite;
    } else {
      echo "<script> alert('Aucun resulta')</script>";
    }
  }
  ?>

</body>

</html>