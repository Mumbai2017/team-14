<?php
 const SERVERNAME = "https://3adc3326.ngrok.io";
 const USERNAME="root";
 const PASSWORD="";
 const  DATABASE="ceque";

 $con = new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
$con->autocommit(false);
 if($con->error){
     die("Connection Error");
 }