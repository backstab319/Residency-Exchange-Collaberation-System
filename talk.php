<?php
    function message($meshead,$mesbod,$mesfoot){
        $user = $_COOKIE["user"];
        $message = $meshead.$mesbod.$mesfoot;
        setcookie("mes".$user,$message,time()+180000,"/");
    }
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
        $meshead = "<table class='table table-bordered table-striped table-hover'>
        <thead class='thead-dark'>
                <tr>
                <th>Sender</th>
                <th>Message</th>
                </tr>
            </thead>";
        while($row = $result->fetch_assoc()){
                $mesbod= $mesbod . "<tr><td>".$row['sender']."</td><td>".$row['message']."</td></tr>";
        }
        $mesfoot = "</table>";
        message($meshead,$mesbod,$mesfoot);
        $user = $_COOKIE["user"];
        echo $_COOKIE["mes".$user];
    }
?>