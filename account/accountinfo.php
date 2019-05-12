<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Account Information</title>
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
        $user = $_COOKIE["user"];
        include "../connect.php";
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
    
    <div class="manage d-col-flex justify-content-center">
    <div class="container text-center">
        <h1 class="display-4 text-p">Account Information</h1>
        <div class="container text-center col-md-4 col-lg-4">
        <div class="form-group">
            <form method="POST" action="accountinfo.php">
                <input type="number" name="phone" placeholder="Phone number" class="form-control mb-2">
                <input type="text" name="address" placeholder="Address" class="form-control mb-2">
                <input type="submit" value="Apply" name="apply" class="form-control btn btn-outline-primary mb-2">
            </form>
        </div>
        </div>
    </div>

    <div class="container col-md-4 col-lg-4 text-center">
        <h1 class="display-4">Change Password</h1>
        <form action="accountinfo.php" method="POST" class="text-center">
            <div class="form-group">
                <input type="password" name="cpass" placeholder="Current Password" class="form-control mb-2">
                <input type="password" name="npass" placeholder="New Password" class="form-control mb-2">
                <input type="password" name="rnpass" placeholder="Reenter New Password" class="form-control mb-2">
                <input type="submit" value="Change Password" class="btn btn-outline-primary" name="change">
            </div>
            <?php
                if($_POST["change"]){
                    change_pass();
                }
                function change_pass(){
                    global $conn;
                    $cpass = $_POST["cpass"];
                    $npass = $_POST["npass"];
                    $rnpass = $_POST["rnpass"];
                    if(($cpass and $npass and $rnpass) != NULL){
                        $user = $_COOKIE["user"];
                        $sql = "SELECT * FROM login_details WHERE user_id='$user'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $lpass = $row["pass"];
                        if($lpass == $cpass){
                            if($npass == $rnpass){
                                echo "<p class='lead text-center text-danger'>Password changed!</p>";
                                $sql = "UPDATE login_details SET pass='$npass' WHERE user_id='$user'";
                                $conn->query($sql);
                            }else{
                                echo "<p class='lead text-center text-danger'>New passwords do not match!</p>";
                            }
                        }else{
                            echo "<p class='lead text-center text-danger'>Wrong Current Password</p>";
                        }
                    }else{
                        echo "<p class='lead text-center text-danger'>Please check all the fields</p>";
                    }
                }
            ?>
        </form>
    </div>

    <?php
        if($_POST["apply"]){
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            checkinfo();
        }
        function checkinfo(){
            global $conn, $user, $phone, $address;
            $sql = "SELECT * FROM user_account WHERE name='$user'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                applyinfo(0);
            }else{
                applyinfo(1);
            }
        }
        function applyinfo($value){
            global $conn, $user, $phone, $address;
            if($value == 0){
                $sql = "UPDATE user_account SET phone_number=$phone,address='$address' WHERE name='$user'";
            }else{
                $sql = "INSERT INTO user_account VALUES('$user',$phone,'$address')";
            }
            $conn->query($sql);
        }
    ?>
    </div>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>