<?php
 require_once 'connection.php';
 if(isset($_POST["username"])&&isset($_POST["password"])){
     $name = $con->real_escape_string($$_POST["username"]);
     $password = $con->real_escape_string($$_POST["username"]);

     $stmt = "";
 }else{
     $output["code"] = 2;
     $output["msg"] = "Invalid Data";
     echo json_encode($output);
 }
?>