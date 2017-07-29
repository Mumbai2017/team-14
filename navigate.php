<?php
    require_once("session.php");

    switch(strtolower($_SESSION["role"])){
            "admin":
            header("location: admin-dashboard.php");
            break;
            "sme":
            header("location: sme-dashboard.php");
            break;
            default:
            header("location: login.html");
     }
?>