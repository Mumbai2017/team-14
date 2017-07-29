
 <?php
 require_once '../connection.php';
 //
 if(isset($_POST["comment"])&&isset($_POST["feedback"])){
     //Required Inputs
     $feedback = $con->real_escape_string($$_POST["feedback"]);
     $video_id = $con->real_escape_string($$_POST["video_id"]);
     $sme_id = $con->real_escape_string($$_POST["sme_id"]);
     //storing to the db
     $sql="INSERT INTO feedback_video(fb_id,sme_id,video_id,feedback,ts) values ("$random_no"','".$sme_id."','".$video_id."','".$message.",NOW())";
              
     $stmt = $con->prepare($sql);
     if($stmt){
        
             if($stmt->execute()){
                
                    $output["code"] = 1;
                    $outpu["msg"]="feedback submitted";
                }
             }
         
     
 }
 else{
     $output["code"] = 2;
     $output["msg"] = "Invalid Data";
     echo json_encode($output);
 }


 
?>


