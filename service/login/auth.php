<?php
 require_once '../connection.php';
 if(isset($_POST["username"])&&isset($_POST["password"])) {
     $name = $con->real_escape_string($_POST["username"]);
     $password = $con->real_escape_string($_POST["password"]);
     $sql = "select * from user where `user_email` like  '$name' and `user_password` like '$password' ";
    if($result =  $con->query($sql)){
        if($result->num_rows > 0){
            $ouput["code"] = 1;
            $output["msg"] = "Authenticated";
            $data = $result->fetch_assoc();
            $sql = "SELECT * FROM  `roles` AS r,  `user_roles` AS ur WHERE ur.`user_role` = r.`role_id` and ur.user_id = ".$data["user_id"];
            $result = $con->query($sql);
            $userrole = $result->fetch_assoc();
            //Sessions
            session_start();
            $_SESSION["userid"] = $data["user_id"];
            $_SESSION["role"]= $userrole["role"];
            $_SESSION["name"] = $data["user_lastname"]." ".$data["user_firstname"];
            $_SESSION["email"] = $data["user_email"];
            $_SESSION["phone"] = $data["user_phone"];

            echo json_encode($output);
        }
        else{
            $ouput["code"] = 2;
            $output["msg"] = "NOt Authenticated";
            echo json_encode($output);
        }
    }
     $ouput["code"] = 2;
     $output["msg"] = "Try Later";
     echo json_encode($output);

 }
 else{
     $ouput["code"] = 2;
     $output["msg"] = "Invalid Data";
     echo json_encode($output);
 }
?>
