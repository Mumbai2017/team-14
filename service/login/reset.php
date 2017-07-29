<?php
/**
 * Created by PhpStorm.
 * User: franky
 * Date: 7/29/2017
 * Time: 4:58 PM
 */
 require_once '../connection.php';
 if(isset($_POST["username"])&&isset($_POST["newpassword"]) &&isset($_POST["oldpassword"])){
     //REquired Inputs
     $name = $con->real_escape_string($_POST["username"]);
     $oldpassword = $con->real_escape_string($_POST["oldpassword"]);
     $newpassword = $con->real_escape_string($_POST["newpassword"]);
     if($oldpassword != $newpassword){
         $output["code"] = 2;
         $output["msg"]="Password Does Not Match";
         echo json_encode($output);

     }


     $sql = "select * from user where `user_email` like ? and `user_password` like ?";

     $stmt = $con->prepare($sql);
     if($stmt){
         if($stmt->bind_param("ss",$name,$pasword)){
             if($stmt->execute()){
                 if($stmt->num_rows >0){
                     $output["code"] = 1;
                     $output["msg"]="Authenticated";
                     echo json_encode($output);
                 }
                 else{
                     $output["code"] = 2;
                     $output["msg"]="Invalid Credentials";
                     echo json_encode($output);
                 }

             }
         }


     }

 }else{
     $output["code"] = 2;
     $output["msg"] = "Invalid Data";
     echo json_encode($output);
 }
?>

//
