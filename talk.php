<?php
    include "connect.php";
    $user = $_COOKIE["user"];
    selectmessages();
    function selectmessages(){
        global $conn,$user;
        $sql = "SELECT * FROM talk WHERE receiver='$user'";
        $result = $conn->query($sql);
        showmessages($result);
    }
    function showmessages($result){
        echo "<table class='table table-bordered table-striped table-hover'>
        <thead class='thead-dark'>
                <tr>
                <th>Sender</th>
                <th>Message</th>
                </tr>
            </thead>";
        while($row = $result->fetch_assoc()){
                echo "<tr><td>".$row['sender']."</td><td>".$row['message']."</td></tr>";
        }
        echo "</table>";
    }
?>