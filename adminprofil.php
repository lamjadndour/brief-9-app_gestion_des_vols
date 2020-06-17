<?php

include "source/DB_connection.php";
include "source/header.php";
include "model/usermodel.php";


if (@$idUser = $_SESSION['user']['iduser']) {
    $user_m = new User;
    $user = $user_m->user_show($idUser);
    $user_rows = mysqli_num_rows($user);


    if ($user_rows > 0) {
        while ($user_data =  mysqli_fetch_array($user)) {
            $userName = $user_data['username'];
            $userEmail = $user_data['Email'];
            $userid = $user_data['iduser'];
            if ($user_data['grade'] == 1) {
                $userStatus = "Admin";
            } else $userStatus = "Client";
            echo '<div class="boxContent"> <div class="firstRow"> <div class="card-body card-body-plus">
                <div class="e-profile">
                    <div class="tab-content pt-3">
                        <div class="tab-pane active">
                            <form class="form" >
                                <div class="row">
                                    <div class="col">
                                    <div class="row">
                                            <div class="col">
                                                <div class="form-group"> <label>Status</label>  <input class="form-control" type="text" value="' . $userStatus . '" disabled></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group"> <label>Username</label>  <input class="form-control" type="text" name="username" value="' . $userName . '" disabled></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group"> <label>Email</label> <input class="form-control" type="text" name="email" value="' . $userEmail . '"disabled></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div></div></div>';
        }
    }
}
