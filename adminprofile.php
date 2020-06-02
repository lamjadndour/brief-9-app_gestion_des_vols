<?php

include "model/usermodel.php";
include "model/vol_model.php";
include "source/navigation.php";

?>

<div class="boxContent">
    <div class="firstRow">

        <?php
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
            echo  "<div class='alert alert-success'>" . $message . "</div>";
        }
        ?>

        <h3 class="text-center text-success" id="message"></h3>

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Management <b>Admin</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Admin</span></a>
                        <!-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						 -->
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php while ($fetch = mysqli_fetch_array($query)) {

                ?>
                    <tbody>

                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                    <label for="checkbox1"></label>
                                </span>
                            </td>
                            <td><?php echo $fetch['username']; ?></td>
                            <td><?php echo $fetch['mail']; ?></td>
                            <td><?php echo $fetch['pass_word']; ?></td>
                            <td><?php echo $fetch['statu']; ?></td>

                            <td>

                                <a href="update.php?id=<?php echo $fetch['iduser']; ?>" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a href="delete.php?id=<?php echo $fetch['iduser']; ?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>

                    <?php } ?>
                    </tbody>
            </table>

        </div>
        <!-- Add Modal HTML -->
        <div id="addEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="user" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="mail" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label>password</label>
                                <input type="password" class="form-control" name="pass" placeholder="Enter password" required>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" name="status" value="Admin">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success" name="add" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include "footer.html";  ?>