<?php
session_start();
if (isset($_SESSION['user'])) {
    $_SESSION['grade'] = 'user';
    session_destroy();
    header('location:index.php');
}

?>