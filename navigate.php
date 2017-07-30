<?php
    require_once("session.php");

    switch(strtolower($_SESSION["role"])){
            case "admin":
            header("location: admin-dashboard.php");

            break;
            case "sme":
            header("location: sme-dashboard.php");
            break;
            default:
            header("location: login.html");
     }
?>