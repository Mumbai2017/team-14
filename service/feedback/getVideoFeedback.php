<?php
/**
 * Created by PhpStorm.
 * User: franky
 * Date: 7/30/2017
 * Time: 3:00 AM
 */
require_once '../connection.php';
if(isset($_POST["video_id"])){
    //REquired Inputs
    $videoid = $con->real_escape_string($_POST["video_id"]);
    $sql = "SELECT * FROM  `feedback_video` AS fv, user AS u WHERE fv.sme_id = u.user_id AND fv.`video_id` = $videoid ";
    $result = $con->query($sql);
    if($result->num_rows > 0 ){
        $output["total"] = $result->num_rows;
        $output["feedback"] = array();
        $output["code"] = 1;
        while($row = $result->fetch_assoc()){
            $temp["id"] = $row["fb_id"];
            $temp["name "] = $row["user_firstname"]." ".$row["user_lastname"];
            $temp["feedback"] = $row["feedback"];
            $temp["time"] = $row["ts"];
            $temp["phone"] = $row["user_phone"];
            $temp["location"] = $row["user_phone"];
            array_push($output["feedback"],$temp);
        }
        echo json_encode($output);
    }
    else{
        $output["total"] = $result->num_rows;
        $output["feedback"] = array();
        $output["code"] = 2;
        echo json_encode($output);
    }
}
else{
    $output["code"] = 2;
    $output["msg"] = "Invalid Data";
    echo json_encode($output);
}
?>
