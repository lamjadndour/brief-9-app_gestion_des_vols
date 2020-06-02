<?php


include "../source/DB_connection.php";
include "../model/usermodel.php";

global $db;



// ::::::: GET RESERVATION OF USER FROM DATABASE ::::::  \\

if (@$idUser = intval($_GET['r'])) {
    $sql = "SELECT * FROM reservation WHERE iduser = '" . $idUser . "'";
    $reservation = mysqli_query($db, $sql);
    $reservation_rows = mysqli_num_rows($reservation);
    if ($reservation_rows > 0) {
        echo '<table class="table">
        <tr>
        <th>Depart</th>
        <th>Destination</th>
        <th>Date reservation</th>
        <th>Status</th>
        </tr>';
        while ($reservation_data =  mysqli_fetch_array($reservation)) {
            $idvol = $reservation_data['idVol'];
            $date = $reservation_data['date_reseravtion'];
            $sqlvol = "SELECT * FROM vols WHERE idVol = '" . $idvol . "'";
            $vol = mysqli_query($db, $sqlvol);
            $vol_rows = mysqli_num_rows($vol);
            if ($vol_rows > 0) {
                while ($vol_data = mysqli_fetch_array($vol)) {
                    echo "<tr>";
                    echo "<td>" . $vol_data['depart'] . "</td>";
                    echo "<td>" . $vol_data['destination'] . "</td>";
                    echo "<td>" . $date . "</td>";
                    echo "<td>" . $vol_data['status'] . "</td>";
                    echo "</tr>";
                }
            }
        }
    }
}

// ::::::: GET USER_DATA OF USER FROM DATABASE ::::::  \\



if (@$idUser = $_GET['u']) {
    $sqluser = "SELECT * FROM users WHERE iduser = ' $idUser '";
    $user = mysqli_query($db, $sqluser);
    $user_rows = mysqli_num_rows($user);
    if ($user_rows > 0) {
        while ($user_data =  mysqli_fetch_array($user)) {
            $userName = $user_data['username'];
            $userEmail = $user_data['Email'];
            $userid = $user_data['iduser'];
            echo '<div class="card-body card-body-plus">
                <div class="e-profile">
                    <div class="tab-content pt-3">
                        <div class="tab-pane active">
                            <form class="form" action="controller/userfunctions.php" method="post" >
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group"> <label>Username</label> <input type="hidden" name="id" value="' . $userid . '" > <input class="form-control" type="text" name="username" value="' . $userName . '"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group"> <label>Email</label> <input class="form-control" type="text" name="email" value="' . $userEmail . '"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-3">
                                        <div class="mb-2"><b>Change Password</b></div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group"> <label>New Password</label> <input name="password" class="form-control" type="password" placeholder="••••••"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group"> <label>Confirm Password </label> <input name="conf_password"class="form-control" type="password" placeholder="••••••"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col d-flex justify-content-end"> <button class="btn btn-primary" type="submit" name = "submit" >Save Changes</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
}

if (isset($_POST['submit'])) {

    $id      = e($_POST['id']);
    $username    =  e($_POST['username']);
    $email       =  e($_POST['email']);
    $password_1  =  e($_POST['password']);
    $password_2  =  e($_POST['conf_password']);
    $update_user = new User;
    $update_user->user_update($id, $username, $email, $password_1, $password_2);
}
// escape string
function e($val)
{
    global $db;
    return mysqli_real_escape_string($db, trim($val));
}
