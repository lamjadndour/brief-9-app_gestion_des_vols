<?php

@$id      = $_POST['id'];
include "source/DB_connection.php";
if (isset($_POST['submit'])) {
    include "model/usermodel.php";


    $username    =  $_POST['username'];
    $email       =  $_POST['email'];
    $password_1  =  $_POST['password'];
    $password_2  =  $_POST['conf_password'];
    $update_user = new User;
    $update_user->user_update($id, $username, $email, $password_1, $password_2);
} else {
    session_start();
}

?>

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
    <link rel="stylesheet" href="css/stylebar.css">


</head>

<body>


    <?php

    include "source/navigation.php";
    include "source/DB_connection.php";
    $id = $_GET['id'];
    ?>

    <div class="headera">
        <div class="wrapper d-flex align-items-stretch">
            <nav id="sidebar">
                <div class="custom-menu">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                </div>
                <div class="p-4">
                    <h1><a href="index.html" class="logo">Portfolic <span>You are welcome</span></a></h1>
                    <ul class="list-unstyled components mb-5">
                        <li>
                            <a onclick="showReservation(<?php echo $id ?>)"><span class="fa fa-plane mr-3"></span> all Your reservation</a>
                        </li>
                        <li>
                            <a onclick="showUser(<?php echo $id ?>)"><span class="fa  fa-user mr-3"></span> Your Profile</a>
                        </li>
                        <li>
                            <a onclick="editUser(<?php echo $id ?>)"><span class="fa fa-paper-plane  mr-3"></span> Update your Profile</a>
                        </li>

                    </ul>

                    <div class="mb-5">
                        <h3 class="h6 mb-3">Subscribe for newsletter</h3>
                        <form action="#" class="subscribe-form">
                            <div class="form-group d-flex">
                                <div class="icon"><span class="icon-paper-plane"></span></div>
                                <input type="text" class="form-control" placeholder="Enter Email Address">
                            </div>
                        </form>
                    </div>

                    <div class="footer">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template
                            is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">THe linkback</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>

                </div>
            </nav>

            <!-- Page Content  -->
            <div class="p-4 p-md-5 pt-5" style="width: 90%">
                <h2 class="mb-4" id="content_title">Welcome <?php echo $_SESSION['user']['username'] ?></h2>
                <div class="col mb-3" style="height:90%; width:100%">
                    <div id="content" class="card" style="width:100% ">


                    </div>
                </div>

            </div>
        </div>

    </div>
    <script>
        function showReservation(str) {

            document.getElementById("content").innerHTML = "";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("content").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "controller/userfunctions.php?r=" + str, true);
            xmlhttp.send();
        }
        showReservation(<?php echo $_SESSION['user']['iduser'] ?>);

        function showClient(str) {

            document.getElementById("content").innerHTML = "";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("content").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "controller/userfunctions.php?c=" + str, true);
            xmlhttp.send();
        }

        function showUser(str) {
            document.getElementById("content").innerHTML = "";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("content").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "controller/userfunctions.php?u=" + str, true);
            xmlhttp.send();
        }

        function editUser(str) {
            document.getElementById("content").innerHTML = "";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("content").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "controller/userfunctions.php?edit-user=" + str, true);
            xmlhttp.send();
        }
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>