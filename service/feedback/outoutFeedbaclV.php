
 <?php
 require_once '../connection.php';
 echo"hello";
 if(isset($_POST["comment"])&&isset($_POST["feedback"]))
 {


    $message=$_POST["feedback"];
    $sme_id=$_POST["sem_id"];
    $video_id=$_POST["lp_id"];

    $myArray = array();
    if ($result = $con->query("select feedback from feedback_lp where lp_id=".$video_id."order by ts ");

    while($row = $result->fetch_array(MYSQL_ASSOC)) {
            $myArray[] = $row;
    }
    echo json_encode($myArray);
}


    //json op
    }
    else
    {$result="insertion Fail";

         echo json_encode($result);
    }

    

 ?>