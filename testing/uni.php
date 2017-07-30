<meta charset="utf8">
<?php

    $conn = mysqli_connect('localhost','root','','test');

    mysqli_set_charset($conn,"utf8");
    $results = mysqli_fetch_assoc(mysqli_query($conn,'SELECT * FROM lel'));

    // echo iconv('UTF-8','ISO-8859-1',$results['kanna']);
    echo $results['kanna'];

?>