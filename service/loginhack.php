<?php 
    include('connproc.php');

    if(isset($_POST['username'] && $_POST['password'])){
        $results = mysqli_query($conn,'SELECT user_email,user_password FROM ceque.user');
    }else{
        $resp = {'code':'0','msg':'invalid'};
        echo json_encode($resp);
    }
?>