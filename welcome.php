<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Welcome!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include "connect.php";
        if(!isset($_COOKIE["user"])){
        echo "
        <div class='container jumbotron text-center mt-2'>
        Please login back in again to continue browsing RECS!
        </div>";
        exit();
    }
    $user = $_COOKIE["user"];
    ?>
    <div class="navbar-section home">
        <navbar class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand">RECS</a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#toggle" type="button"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="toggle">
                    <div class="navbar-menu ml-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="page_init/myorder.php">My orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reg-business.php">Register business</a>
                        </li>
                        <?php
                        check_business();
                        function check_business(){
                            global $conn,$user;
                            $sql = "SELECT * FROM view_business WHERE owner_name='$user'";
                            $result = $conn->query($sql);
                            $sql = "SELECT * FROM recs_employees_details WHERE emp_name='$user'";
                            $result1 = $conn->query($sql);
                            if($result->num_rows > 0){
                                echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='/manage-business.php'>Manage Business</a>
                                </li>
                                ";
                            }elseif ($result1->num_rows > 0) {
                                echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='/manage-business.php'>Manage Business</a>
                                </li>
                                ";
                            }
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="account/accountinfo.php">Account info</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>


    <div class="container jumbotron text-center mt-2">
        <h1 class="display-4">Welcome to RECS!</h1>
        <?php
            checkinfo();
            function checkinfo(){
                global $user, $conn;
                $sql = "SELECT * FROM user_account WHERE name='$user'";
                $result = $conn->query($sql);
                if($result->num_rows == 0){
                    echo "<p class='lead bg-alert'>Please Update your account information</p>";
                }
            }
        ?>
    </div>

    <div class="container text-center col-lg-6 col-xl-6 my-4">
        <h1 class="display-4">Messages</h1>
                <div id="message"></div>
                <script>
        function chat(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(xhttp.readyState == 4 && xhttp.status == 200){
                    document.getElementById('message').innerHTML = xhttp.responseText;
                }
            }
            xhttp.open('GET','talk.php', true);
            xhttp.send();
        }
        setInterval(function(){chat()}, 1000)
    </script>
    </div>

    <div class="container text-center col-lg-6 col-xl-6 my-4">
        <h1 class="display-4">Send Message</h1>
        <form action="welcome.php" method="POST">
            <div class="form-group mb-2">
                <div class="row">
                    <textarea name="message" cols="30" rows="5" class="form-control mb-2"></textarea>
                </div>
                <div class="row d-flex justify-content-center">
                    <input type="text" name="receiver" class="form-control mb-2 col-lg-4 col-xl-4" placeholder="Receiver">
                </div>
                <div class="row d-flex justify-content-center">
                    <input type="submit" value="Send" name="send" class="form-control mb-2 btn btn-outline-primary col-lg-4 col-xl-4">
                </div>
            </div>
        </form>
        <?php
            if(isset($_POST["send"])){
                sendmessage();
            }
            function sendmessage(){
                global $user,$conn;
                $receiver = $_POST["receiver"];
                $message = $_POST["message"];
                if(($receiver and $message) != NULL){
                    $sql = "INSERT INTO talk VALUES('$user','$receiver','$message')";
                    $conn->query($sql);
                }else{
                    echo "<p class='lead text-center'>Please check the message or the receivers name</p>";
                }
            }
        ?>
    </div>

    <div class="container text-center col-lg-6 col-xl-6 my-4">
        <h1 class="display-4">Delete Messages</h1>
        <form action="welcome.php" method="POST">
            <div class="form-group">
                <div class="row d-flex justify-content-center">
                    <input type="submit" value="Delete" name="delete" class="form-control btn btn-outline-primary col-lg-4 col-xl-4">
                </div>
            </div>
        </form>
        <?php
            if(isset($_POST["delete"])){
                deletemessage();
            }
            function deletemessage(){
                global $user, $conn;
                $sql = "DELETE FROM talk WHERE receiver='$user'";
                $conn->query($sql);
            }
        ?>
    </div>

    <div class="container jumbotron text-center my-4">
        <h1 class="display-4">Services available.</h1>
        <?php
            $bus_name;
            $owner_name;
            $owner_number;
            $bus_address;
            $bus_type;
            $result;
            function data_init(){
                global $bus_name, $owner_name, $owner_number, $bus_address, $bus_type, $conn, $result;
                $sql = "SELECT * FROM business_reg";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    data_display();
                }
                else{
                    echo "There are no businesses to display here.";
                }
            }
            
            function data_display(){
                global $result;
                while($row = $result->fetch_assoc()){
                    echo "<div class='container'>
                        <h3 class='display-7'>". $row['business_type'] . ': ' . $row['bus_name'] .  "<a class='btn btn-outline-primary btn-link' href='" . $row['page_link'] . "'>Visit</a></h3>
                    </div>";
                }
            }
            data_init();
        ?>
    </div>

    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>