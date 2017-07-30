<?php
/**
 * Created by PhpStorm.
 * User: franky
 * Date: 7/30/2017
 * Time: 1:22 AM
 */

require_once '../connection.php';
if(isset($_POST["lp_id"])&&isset($_POST["video_link"])&&isset($_POST["video_title"])&&isset($_POST["teacher_id"])){
    //Required Inputs
    $lpid = $con->real_escape_string($_POST["lp_id"]);
    $link = $con->real_escape_string($_POST["video_link"]);
    $title = $con->real_escape_string($_POST["sme_id"]);
    $teacherid = $con->real_escape_string($_POST["sme_id"]);
    //storing data to the db
    $sql ="INSERT INTO `video`( `lp_id`, `video_link`, `video_title`, `teacher_id`) VALUES ($lpid,'$link','$title','$teacherid')";
    if($con->query($sql)){
        $output["code"] = 1;
        $output["msg"] = "Video Inserted";
        echo json_encode($output);
    }
    else{
        $output["code"] = 2;
        $output["msg"] = "Video Not Inserted";
        echo json_encode($output);
    }



}
else{
    $output["code"] = 2;
    $output["msg"] = "Invalid Data";
    echo json_encode($output);

}
?>