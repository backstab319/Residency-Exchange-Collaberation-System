<?php
    $dbservername = "localhost";
    $dbusername = "u463135857_yxuq";
    $dbpassword = "u463135857_yxuq";
    $dbdbname = "u463135857_yxuq";
    $conn = new mysqli($dbservername,$dbusername,$dbpassword,$dbdbname);
    if($conn->connect_error){
        echo "Connection error!" . $conn->connect_error;
    }
?>