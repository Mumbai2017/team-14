<?php
 require_once '../connection.php';
 if(isset($_POST["username"])&&isset($_POST["password"])){
     //REquired Inputs
     $name = $con->real_escape_string($$_POST["username"]);
     $password = $con->real_escape_string($$_POST["username"]);
     $sql = "select * from user where `user_email` like ? and `user_password` like ?";

     $stmt = $con->prepare($sql);
     if($stmt){
         if($stmt->bind_param("ss",$name,$pasword)){
             if($stmt->execute()){
                if($stmt->num_rows >0){
                    $output["code"] = 1;
                    $outpu["ms  g"]="Authenticated";
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

