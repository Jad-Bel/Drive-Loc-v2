<?php 

session_start();
session_destroy();

header("location: ../views/partials/authentification/login.php");