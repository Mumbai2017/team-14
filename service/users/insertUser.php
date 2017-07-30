<?php
/**
 * Created by PhpStorm.
 * User: franky
 * Date: 7/30/2017
 * Time: 3:32 AM
 */

require_once "../connection.php";

if(isset($_POST["phone"])&&isset($_POST["firstname"])&&isset($_POST["lastname"])&&isset($_POST["city"])&&isset($_POST["email"])){
    //Required Inputs
    $fname = $con->real_escape_string($_POST["firstname"]);
    $lname = $con->real_escape_string($_POST["lastname"]);
    $city = $con->real_escape_string($_POST["city"]);
    $num=md5(rand(5, 15));
    $password = substr($num,0,6);
    $phone = $con->real_escape_string($_POST["phone"]);
    $email = $con->real_escape_string($_POST["email"]);


    $sql = "select * from user where user_email = '$email'";
    if($con->query($sql)->num_rows > 0){
        $output["code"] = 2;
        $output["msg"] = "User Registered";
        echo json_encode($output);
        exit;
    }
    //storing data to the db
    $sql = "INSERT INTO `user`(`user_firstname`, `user_lastname`, `user_email`, `user_phone`, `user_city`, `user_password`) VALUES ('$fname','$lname','$email',$phone,'$city','$password')";

    if($con->query($sql)){
        $output["code"] = 1;
        $output["msg"] = "Inserted";
        $msg = "Hi $fname $lname , Your number $phone is now registerd and your password is $password";
        $post_data = array(
            // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
            // For promotional, this will be ignored by the SMS gateway
            'From'   => "09243422233",
            'To'    => "+91".$phone,
            'Body'  => $msg,
        );

        $exotel_sid = "59774"; // Your Exotel SID
        $exotel_token = "cfd3b6f5731f1117e5a01586c3714efac4eb0741"; // Your exotel token

        $url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Sms/send";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));

        $http_result = curl_exec($ch);
        $error = curl_error($ch);
        $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);

        curl_close($ch);

        echo json_encode($output);
    }
    else{
        $output["code"] = 2;
        $output["msg"] = "User Not Inserted";
        echo json_encode($output);
    }



}
else{
    $output["code"] = 2;
    $output["msg"] = "Invalid Data";
    echo json_encode($output);

}