<?php
 const SERVERNAME = "localhost";
 const USERNAME="root";
const PASSWORD="root";
 const  DATABASE="ceque";

 $con = new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
 if($con->error){
     die("Connection Error");
 }