<?php
/**
 * Created by PhpStorm.
 * User: franky
 * Date: 7/30/2017
 * Time: 1:22 AM
 */

require_once '../connection.php';
$target_dir = "../../videos/";
$target_file = $target_dir . basename($_FILES["video"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if(isset($_POST["lp_id"])&&isset($_POST["video_title"])&&isset($_POST["teacher_id"])){
    //Required Inputs
    $lpid = $con->real_escape_string($_POST["lp_id"]);
   //$link = $con->real_escape_string($_POST["video_link"]);
    $title = $con->real_escape_string($_POST["sme_id"]);
    $teacherid = $con->real_escape_string($_POST["sme_id"]);
    $date = new DateTime();
    $date->format('U = Y-m-d H:i:s');
    $imageName = $date->format('U = Y-m-d H:i:s')."$title" . pathinfo($_FILES['video']['name'],PATHINFO_EXTENSION);
    if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file."/".$imageName)) {
        //storing data to the db
        $sql ="INSERT INTO `video`( `lp_id`, `video_link`, `video_title`, `teacher_id`) VALUES ($lpid,'$target','$title','$teacherid')";
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
    } else {
        echo "Sorry, there was an error uploading your file.";
    }




}
else{
    $output["code"] = 2;
    $output["msg"] = "Invalid Data";
    echo json_encode($output);

}
?>
