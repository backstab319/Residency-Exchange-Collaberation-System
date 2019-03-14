<?php
    $dbservername = "localhost";
    $dbusername = "u463135857_yxuq";
    $dbpassword = "u463135857_yxuq";
    $conn = new mysqli($dbservername,$dbusername,$dbpassword);
    if($conn->connect_error){
        echo "Connection error!" . $conn->connect_error;
    }
?>