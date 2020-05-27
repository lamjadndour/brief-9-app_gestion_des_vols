


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <img src="images/logo.png" alt="">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav" style="margin-left: 50%">
      <a class="nav-item nav-link text-center active my-auto" href="#">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link text-center my-auto" href="#">About</a>
      <?php
        if (isset($_SESSION["username"])) {

            if($_SESSION["status"] == 1)
            {
                ?>
                <a class="nav-item nav-link my-auto  text-center" href="administration.php">Administration</a>
                <?php 
            }else{
                ?>
                <a class="nav-item nav-link my-auto  text-center" href="userdashbord.php">Dashbord</a>
                <?php
            }
                ?>
            <a class="nav-item btn btn-dark text-center " style="width : 120px" href="logout.php">Log-out</a>
        <?php 
        }else{
        ?>
            <a class="nav-item btn btn-dark  text-center" style="width:max-content" href="login.php">Login</a>
        <?php 
        }
        ?>
    </div>
  </div>
</nav>