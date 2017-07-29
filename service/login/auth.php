<?php
 require_once '../connection.php';
 if(isset($_POST["username"])&&isset($_POST["password"])){
     //REquired Inputs
     $name = $con->real_escape_string($_POST["username"]);
     $password = $con->real_escape_string($_POST["password"]);
     $sql = "select * from user where `user_email` like '$name' and `user_password` like '$password'";

     if($result = $con->query($sql)){
         if($result->num_rows >0){
             $output["code"] = 1;
             $output["msg"]="Authenticated";
             echo json_encode($output);
         }
         else{

             $output["code"] = 2;
             $output["msg"]="Not Authenticated";
             echo json_encode($output);
         }
     }


 }else{
     $output["code"] = 2;
     $output["msg"] = "Invalid Data";
     echo json_encode($output);
 }
?>

