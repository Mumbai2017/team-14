
 <?php
 require_once '../connection.php';
 if(isset($_POST["comment"])&&isset($_POST["feedback"])){
     //Required Inputs
     $feedback = $con->real_escape_string($$_POST["feedback"]);
     $lp_id = $con->real_escape_string($$_POST["lp_id"]);
     $sme_id = $con->real_escape_string($$_POST["sme_id"]);
     //storing data to the db
     $sql="INSERT INTO feedback_lp(sme_id,lp_id,feedback) values ($sme_id,$lp_id,$feedback)";
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


