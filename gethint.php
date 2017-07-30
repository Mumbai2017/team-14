<?php
// Array with names
// get the q parameter from URL

require '../connection.php';


$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    $sql = "SELECT user_firstname  FROM user";
$result = $conn->query($sql);
$i=0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    foreach($row[$i] as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
            i++;
        }
    }
    }
} else {
    echo "0 results";
}
    
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
?>

