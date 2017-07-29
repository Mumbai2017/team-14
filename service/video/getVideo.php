<?php
/**
 * Created by PhpStorm.
 * User: franky
 * Date: 7/29/2017
 * Time: 11:51 PM
 */
require_once '../connection.php';
if(isset($_POST["teacherid"])){
    //REquired Inputs
    $teacher_id = $con->real_escape_string($_POST["teacherid"]);
    $sql = "SELECT * FROM  `video` where teacher_id =  $teacher_id";
    $result = $con->query($sql);
    if($result->num_rows > 0 ){
        $output["total"] = $result->num_rows;
        $output["video"] = array();
        $output["code"] = 1;
        while($row = $result->fetch_assoc()){
            $temp["id"] = $row["lp_id"];
            $temp["link "] = $row["video_link"];
            $temp["title"] = $row["video_title"];
            $temp["time"] = $row["ts"];
            array_push($output["video"],$temp);
        }
        echo json_encode($output);
    }
    else{
        $output["total"] = $result->num_rows;
        $output["video"] = array();
        $output["code"] = 2;
        echo json_encode($output);
    }
}
else{
    $output["code"] = 2;
    $output["msg"] = "Invalid Data";
    echo json_encode($output);
}