<?php
 const SERVERNAME = "localhost";
 const USERNAME="root";
const PASSWORD="";
 const  DATABASE="ceque";

 $con = new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
 if($con->error){
     die("Connection Error");
 }