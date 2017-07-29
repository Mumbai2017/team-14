<?php
 const SERVERNAME = "10.49.166.0";
 const USERNAME="";
 const PASSWORD="";
 const  DATABASE="";

 $con = new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
$con->autocommit(false);
 if($con->error){
     die("Connection Error");
 }