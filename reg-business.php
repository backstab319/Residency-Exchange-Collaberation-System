<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Business Registeration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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

    <div class="container text-center jumbotron">
        <h1 class="display-4">Register your business</h1>
        <p class="lead">Please use the following provided tools to initialise your business with ease!</p>
    </div>

    <div class="container d-flex justify-content-center text-center">
        <div class="form-group col-md-4 col-lg-4 mb-2">
            <form method="POST" action="reg-business.php">
                <input class="form-control mb-2" type="text" name="business" placeholder="Business name">
                <input class="form-control mb-2" type="number" name="number" placeholder="Number">
                <input class="form-control mb-2" type="text" name="address" placeholder="Business address">
                <div class="form-group">
                    <label for="bus_type">Business type:</label>
                    <select class="form-control" name="bus_type" id="bus_type">
                        <option value="hotel">Hotel</option>
                        <option value="grocery">Grocery</option>
                        <option value="service">Service</option>
                        <option value="mall">Mall</option>
                    </select>
                </div>
                <input type="submit" value="Register!" class="btn btn-outline-dark" name="reg">
            </form>
        </div>
    </div>
    <div class="container text-center">
        <?php
        include "connect.php";
        if($_POST["reg"]){
            $bus_name = $_POST["business"];
            $owner_name = $_COOKIE["user"];
            $owner_number = $_POST["number"];
            $bus_address = $_POST["address"];
            $bus_type = $_POST["bus_type"];
            $link;
            $pagelink;
            $cpanel;
            $varspagelink;
            process_reg();
        }
        function process_reg(){
            global $bus_name,$owner_name,$owner_number,$bus_address,$bus_type,$conn;
            if(($bus_name and $owner_name and $owner_number and $bus_address and $bus_type) == NULL){
                echo "Please recheck the entered values!";
            }else{
                register();
            }
        }
        function register(){
            global $bus_name,$owner_name,$owner_number,$bus_address,$bus_type,$conn,$pagelink;
            makedir();
            makehomepage();
            makecpanel();
            createvar();
            $sql = "INSERT INTO business_reg (bus_name, owner_name, owner_contact, owner_address, business_type, page_link) VALUES('$bus_name','$owner_name',$owner_number,'$bus_address','$bus_type','$pagelink')";
            if($conn->query($sql) === TRUE){
                echo "Business successfully registered!";
            }else{
                echo "Error registering business. Please contact our dev team.";
            }
            view_business();
        }
        function makedir(){
            global $bus_name, $owner_name, $link;
            $link = "business/".$bus_name.$owner_name;
            mkdir($link);
        }
        function makehomepage(){
            global $link, $bus_name, $owner_name,$pagelink,$conn;
            $pagelink = $link."/".$bus_name.$owner_name.".php";
            $mypage = fopen($pagelink, "w") or die("Unable to create homepage. Please contact our dev team.");
            $content="<?php include '../../page_init/business_boilerplate.php';?>";
            fwrite($mypage,$content);
            fclose($mypage);
        }
        function makecpanel(){
            global $link,$bus_name,$owner_name,$cpanel,$conn;
            $cpanel = $link."/".$bus_name.$owner_name."cpanel.php";
            $mypage = fopen($cpanel, "w") or die("Unable to create cpanel. Please contact our dev team.");
            $content="<?php include '../../page_init/business_cpanel_boilerplate.php';?>";
            fwrite($mypage,$content);
            fclose($mypage);
        }
        function view_business(){
            global $conn,$bus_name,$owner_name,$cpanel;
            $sql = "INSERT INTO view_business (bus_name, owner_name, cpanel_link) VALUES ('$bus_name','$owner_name','$cpanel')";
            $conn->query($sql);
        }
        function createvar(){
            global $bus_name,$owner_name,$owner_number,$bus_address,$bus_type,$conn,$varspagelink,$link,$cpanel;
            $varspagelink = $link."/"."vars.php";
            $mypage = fopen($varspagelink, "w") or die("Unable to create vars page. Please contact our dev team.");
            $content="<?php \$bus_name = '$bus_name';\$owner_name = '$owner_name';\$cpanel = '$cpanel';?>";
            fwrite($mypage,$content);
            fclose($mypage);
            $sql = "INSERT INTO business_vars (bus_name, owner_name, vars_link) VALUES ('$bus_name','$owner_name','$varspagelink')";
            $conn->query($sql);
        }
        $conn->close();
    ?>
    </div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>