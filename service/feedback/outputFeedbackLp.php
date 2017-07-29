
 <?php
 require_once '../connection.php';
 if(isset($_POST["comment"])&&isset($_POST["feedback"])){
     //REquired Inputs
     $feedback = $con->real_escape_string($$_POST["feedback"]);
     $lp_id = $con->real_escape_string($$_POST["lp_id"]);
     $sme_id = $con->real_escape_string($$_POST["sme_id"]);
        $sql="INSERT INTO feedback_lp(sme_id,lp_id,feedback,ts) values ($sme_id."','".$lp_id."','".$message.",NOW());
		
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


