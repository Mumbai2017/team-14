
 <?php
 require_once '../connection.php';
 if(isset($_POST["feedback"])&&isset($_POST["video_id"])&&isset($_POST["sme_id"])){
     //Required Inputs
     $feedback = $con->real_escape_string($_POST["feedback"]);
     $video_id = $con->real_escape_string($_POST["video_id"]);
     $sme_id = $con->real_escape_string($_POST["sme_id"]);
     //storing data to the db
     $sql ="INSERT INTO `feedback_video`(`sme_id`, `video_id`, `feedback`) VALUES ($sme_id,$video_id,'$feedback')";
     if($con->query($sql)){
         $output["code"] = 1;
         $output["msg"] = "FeedBack Inserted";
         echo json_encode($output);
     }
     else{
         $output["code"] = 2;
         $output["msg"] = "FeedBack Not Inserted";
         echo json_encode($output);
     }



 }
 else{
     $output["code"] = 2;
     $output["msg"] = "Invalid Data";
     echo json_encode($output);

 }
 ?>


