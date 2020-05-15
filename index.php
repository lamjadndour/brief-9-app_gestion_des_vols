<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <img src="images/logo.png" alt="">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="#">About</a>
      <a class="nav-item nav-link" href="#">Pricing</a>
      <a class="nav-item nav-link" href="#">Contat us</a>
    </div>
  </div>
</nav>


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
<h5>Bootstrap heading Bootstrap heading</h5>
</center>
<table class="table">
  <thead class="thead-dark">
    <tr>
      
      <th scope="col">Depart</th>
      <th scope="col">Destianation</th>
      <th scope="col">date de depart</th>
      <th scope="col">Time</th>
      <th scope="col">Price</th>
      <th scope="col">nombre de Place</th>
      <th scope="col">Reservation</th>
    </tr>
  </thead>
                
    <?php 
            $db = mysqli_connect("localhost","root","","db_gestionVols");
            if (isset($_POST['submit'])){
                $depart = $_POST['depart'];
                $destination = $_POST['destination'];
                $query = mysqli_query($db, "SELECT * FROM Vols WHERE depart = '$depart' AND destination = '$destination' AND place_disponible > 0 "); 
      
                if (mysqli_num_rows($query) > 0 ) {
                while ($row = mysqli_fetch_array($query)){
                    $id = $row['idVol'];
                    $depart = $row['depart'];
                    $destination = $row['destination'];
                    $date = $row['date_depart'];
                    $time = $row['time'];
                    $prix = $row['prix'];
                    $nbrPlace = $row['place_disponible'];
    
     ?>
                <tbody>
                    <tr class="table-active">
                      
                      <td><?php echo $depart; ?></td>
                      <td><?php echo $destination;?></td>
                      <td><?php echo $date; ?></td>
                      <td><?php echo $time; ?></td>
                      <td><?php echo $prix;?>DH</td>
                      <td><?php echo $nbrPlace; ?></td>
                      <td><button type="button" class="btn btn-warning">
                      <a href="reservation.php?id=<?php echo $id; ?>">Reserver</a></button></td>  
                    </tr>
                  </tbody>
   <?php } }
     else { echo "<script> alert('Aucun resulta')</script>"; }
   }
   ?> 
   
     </table>

</body>
</html>