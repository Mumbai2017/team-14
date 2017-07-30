<?php
/**
 * Created by PhpStorm.
 * User: franky
 * Date: 7/30/2017
 * Time: 9:53 AM
 */

$from = $_GET["From"];
$digits = $_GET["digits"];
$sql = "SELECT user_password FROM  `user` where user_phone like '$from' and user_id like '$digits' ";
if($result = $con->query($sql)){
    if($result->num_rows >0){
        $row = $result->fetch_assoc();
        echo "Your password is ".$row["user_password"];
    }
    else{
        echo "Sorry Not a Valid Account Member";
    }
}
?>