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

    <div class="container text-center jumbotron">
        <h1 class="display-4">Account Settings</h1>
        <div class="container text-center col-md-4 col-lg-4">
        <div class="form-group">
            <form method="POST" action="accountinfo.php">
                <input type="number" name="phone" placeholder="Phone number" class="form-control mb-2">
                <input type="text" name="address" placeholder="Address" class="form-control mb-2">
                <input type="submit" value="Apply" name="apply" class="form-control mb-2">
            </form>
        </div>
        </div>
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
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>