<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php
        if(!isset($_COOKIE["user"])){
        echo "<div class='container jumbotron text-center mt-2'>
        <p class='lead'>Please login back in again to continue browsing RECS!</p>
        </div>";
        exit();
        }
    ?>
    <div class="navbar-section home">
        <navbar class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand">RECS</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#toggle"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="toggle">
                    <div class="navbar-menu ml-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="http://thebackstabproject.hostingerapp.com/welcome.php">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>
    
    <div class="container text-center">
    <?php
        include "../connect.php";
        $user = $_COOKIE["user"];
        checkifordered();
        if(isset($_GET["verify"])){
            verifyorder($_GET["bus_name"]);
        }
        $result1;
        function checkifordered(){
            global $user, $conn, $result1;
            $sql1 = "SELECT DISTINCT bus_name FROM business_orders WHERE user_id='$user'";
            $result1 = $conn->query($sql1);
            $sql = "SELECT * FROM business_orders WHERE user_id='$user'";
            $result = $conn->query($sql);
            if($result->num_rows == 0){
                echo order_status(0);
            }else{
                echo "<h1 class='display-4'>Your order is on the way</h1>";
                verify_payment($result1);
            }
        }
        function order_status($result){
            if($result == 0){
                return "<h1 class='display-4'>You have no orders</h1>";
            }
        }
        function verify_payment($result){
            global $user, $conn;
            while($row = $result->fetch_assoc()){
                echo "<div class='container text-center jumbotron col-md-4 col-lg-4'>
                            <h1 class='display-4'>Order verification from ".$row['bus_name']."</h1>
                            <label>Please press the verify button only if you have received your order
                            <a class='btn btn-outline-dark' href='myorder.php?verify=1&bus_name=".$row['bus_name']."'>Received order</a>
                            </label>
                    </div>";
            }
        }
        function verifyorder($bus_name){
            global $conn, $user;
            $sql = "UPDATE order_protection SET product_received=1 WHERE user='$user' AND bus_name='$bus_name'";
            $conn->query($sql);
            echo "<p class='lead'>Thank You!</p>";
        }
    ?>
    </div>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>