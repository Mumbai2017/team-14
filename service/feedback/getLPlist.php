<<<<<<< HEAD
<?php
/**
 * Created by PhpStorm.
 * User: franky
 * Date: 7/30/2017
 * Time: 1:28 AM
 */
require_once '../connection.php';
if(isset($_POST["teacherid"])){
    //REquired Inputs
    $teacherid = $con->real_escape_string($_POST["teacherid"]);
    $sql = "SELECT * FROM  `learning_program` where teacher_id = $teacherid";
    $result = $con->query($sql);
    if($result->num_rows > 0 ){
        $output["total"] = $result->num_rows;
        $output["list"] = array();
        $output["code"] = 1;
        while($row = $result->fetch_assoc()){
            $temp["id"] = $row["lp_id"];
            $temp["name"] = $row["lp_name"];
            $temp["subject"] = $row["lp_subject"];
            $temp["grade"] = $row["lp_grade"];
            $temp["language"] = $row["lp_language"];
            $temp["desc"] = $row["lp_desc"];
            array_push($output["list"],$temp);
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


=======
<?php
/**
 * Created by PhpStorm.
 * User: franky
 * Date: 7/30/2017
 * Time: 1:28 AM
 */
require_once '../connection.php';
if(isset($_POST["teacherid"])){
    //REquired Inputs
    $teacherid = $con->real_escape_string($_POST["teacherid"]);
    $sql = "SELECT * FROM  `learning_program` where teacher_id = $teacherid";
    $result = $con->query($sql);
    if($result->num_rows > 0 ){
        $output["total"] = $result->num_rows;
        $output["list"] = array();
        $output["code"] = 1;
        while($row = $result->fetch_assoc()){
            $temp["id"] = $row["lp_id"];
            $temp["name"] = $row["lp_name"];
            $temp["subject"] = $row["lp_subject"];
            $temp["grade"] = $row["lp_grade"];
            $temp["language"] = $row["lp_language"];
            $temp["desc"] = $row["lp_desc"];
            array_push($output["list"],$temp);
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


>>>>>>> 2809961b748cbdf59ac662c37566618167150670
