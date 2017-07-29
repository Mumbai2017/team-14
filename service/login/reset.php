<?php
/**
 * Created by PhpStorm.
 * User: franky
 * Date: 7/29/2017
 * Time: 4:58 PM
 */
 require_once '../connection.php';
 if(isset($_POST["username"])&&isset($_POST["newpassword"]) &&isset($_POST["oldpassword"])) {
     //REquired Inputs
     $username = $con->real_escape_string($_POST["username"]);
     $oldpassword = $con->real_escape_string($_POST["oldpassword"]);
     $newpassword = $con->real_escape_string($_POST["newpassword"]);

     $sql = "select * from user where `user_email` like  '$username' and `user_password` like '$oldpassword' ";
     if($result =  $con->query($sql)){
         if($result->num_rows > 0){
             $sql = "UPDATE `user` SET `user_password` = '$newpassword' WHERE `user_email` = '$username'";
             if($con->query($sql)){
                 $output["code"] = 1;
                 $output["msg"] = "Credentials updated";
                 echo json_encode($output);
             }else{

                 $output["code"] = 2;
                 $output["msg"] = "Try Later";
                 echo json_encode($output);
             }
         }
         else{
             $output["code"] = 2;
             $output["msg"] = "Wrong Credentials";
             echo json_encode($output);
         }
     }
 }

?>
