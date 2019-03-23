<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>
        <?php
            include "vars.php";
            echo $bus_name." Cpanel";
        ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <?php
        include "../../connect.php";
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
        <h1 class="display-4">Cpanel</div>
    </div>

    <?php
        $user = $_COOKIE["user"];
        $sql = "SELECT bus_name, owner_name FROM recs_employees_details WHERE emp_name='$user'";
        $result = $conn->query($sql);
        if($result->num_rows == 0){
            include "../../page_init/emp.php";
        }
    ?>

    <div class="container text-center mb-2">
        <h1 class="display-4">Main Page Configurations</h1>
    </div>

    <div class="container text-center form-group col-md-4 col-lg-4 mb-2">
        <h1 class="display-5">Business Page Heading</h1>
        <div class="form-group">
            <form method="POST" action="<?php $cpanel;?>">
            <input class="form-control mb-2" type="text" name="heading-val" placeholder="Page Heading">
            <input type="submit" value="Change" class="btn btn-outline-dark" name="heading">
            </form>
        </div>
    </div>

    <div class="container text-center form-group col-md-4 col-lg-4 mb-2">
        <h1 class="display-5">Business Page Description</h1>
        <div class="form-group">
            <form method="POST" action="<?php $cpanel;?>">
            <input class="form-control mb-2" type="text" name="description-val" placeholder="Page Description">
            <input type="submit" value="Change" class="btn btn-outline-dark" name="description">
            </form>
        </div>
    </div>

    <div class="container text-center form-group col-md-4 col-lg-4 mb-2">
        <h1 class="display-5">Add products and services</h1>
        <div class="form-group">
            <form method="POST" action="<?php $cpanel;?>">
            <input class="form-control mb-2" type="text" name="prod_name" placeholder="Product or Service">
            <input class="form-control mb-2" type="text" name="prod_des" placeholder="Product or Service Description">
            <input class="form-control mb-2" type="number" name="prod_pr" placeholder="Product or Service Price">
            <input class="form-control mb-2" type="text" name="prod_link" placeholder="Product link">
            <input type="submit" value="Add Product" class="btn btn-outline-dark mb-2" name="addprod">
            </form>
        </div>
    </div>

    <?php
        $final = "http://thebackstabproject.hostingerapp.com/".$cpanel;
        $finalpagelink = "http://thebackstabproject.hostingerapp.com/".$pagelink;
        if($_POST["add"]){
            addemployee();
        }
        if($_POST["delete"]){
            deleteemployee();
        }
        if($_POST["edit"]){
            editdata();
        }
        if($_POST["heading"]){
            heading();
        }
        if($_POST["description"]){
            description();
        }
        if($_POST["addprod"]){
            addproduct();
        }
        function addproduct(){
            global $bus_name, $owner_name, $conn;
            $prodname = $_POST["prod_name"];
            $proddes = $_POST["prod_des"];
            $prodpr = $_POST["prod_pr"];
            $prodlink = $_POST["prod_link"];
            $sql = "INSERT INTO business_product VALUES ('$bus_name','$owner_name','$prodname','$proddes','$prodpr','$prodlink')";
            $conn->query($sql);
            header('Location: ' . $final);
        }
        function description(){
            global $conn,$bus_name,$owner_name,$final;
            $description = $_POST["description-val"];
            $sql = "INSERT INTO business_page (bus_name, owner_name, description) VALUES ('$bus_name','$owner_name','$description')";
            $conn->query($sql);
            header('Location: '.$final);
        }
        function heading(){
            global $conn,$bus_name,$owner_name,$final;
            $heading = $_POST["heading-val"];
            $sql = "INSERT INTO business_page (bus_name, owner_name, heading) VALUES ('$bus_name','$owner_name','$heading')";
            $conn->query($sql);
            header('Location: '.$final);
        }
        function addemployee(){
            global $bus_name,$owner_name,$conn,$final;
            $emp_name = $_POST["emp"];
            $emp_phone = $_POST["emp-phone"];
            $sql = "INSERT INTO recs_employees_details (bus_name, owner_name, emp_name, emp_phone) VALUES ('$bus_name','$owner_name','$emp_name','$emp_phone')";
            $conn->query($sql);
            header('Location: '.$final);
        }
        function deleteemployee(){
            global $bus_name,$owner_name,$conn,$final;
            $deleteemp = $_POST["selectemp"];
            $sql = "DELETE FROM recs_employees_details WHERE bus_name='$bus_name' AND owner_name='$owner_name' AND emp_name='$deleteemp'";
            $conn->query($sql);
            header('Location: '.$final);
        }
        function editdata(){
            global $bus_name,$owner_name,$conn,$final;
            $col = $_POST["change"];
            $data = $_POST["data"];
            $update = $_POST["replace"];
            $sql = "UPDATE recs_employees_details SET $col='$update' WHERE $col='$data' AND bus_name ='$bus_name' AND owner_name ='$owner_name'";
            $conn->query($sql);
            header('Location: '.$final);
        }
    ?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>