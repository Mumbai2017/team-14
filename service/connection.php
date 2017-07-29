<?php
 const SERVERNAME = "";
 const USERNAME="";
 const PASSWORD="";
 const  DATABASE="";

 $con = new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);

 if($con->error){
     die("Connection Error");
 }