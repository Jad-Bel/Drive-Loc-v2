<?php 
    session_start();
    if (!isset($_SESSION['email'])) {
        header("location: ../authentification/login.php");
        exit;
    }
?>