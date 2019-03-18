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

    <div class="container text-center col-md-4 col-lg-4 mb-2">
        <h1 class="display-5">View Employees</h1>
        <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
        <tr>
        <th>Employee Name</th>
        <th>Employee Phone number</th>
        </tr>
        </thead>
        <?php
            $result;
            checkemployees();
            function checkemployees(){
                global $conn,$bus_name,$owner_name,$result;
                $sql = "SELECT * FROM recs_employees_details WHERE bus_name = '$bus_name' AND owner_name = '$owner_name'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    displayemployees();
                }else{
                    echo "</table>You have not hired any employees yet!";
                }
            }
            function displayemployees(){
                global $result;
                while($row = $result->fetch_assoc()){
                    echo "<tr><td>".$row["emp_name"]."</td><td>".$row["emp_phone"]."</td></tr>";
                }
                echo "</table>";
            }
        ?>
    </div>

    <div class="container text-center form-group col-md-4 col-lg-4 mb-2">
        <h1 class="display-5">Add Employees</h1>
        <div class="form-group">
            <form method="POST" action="<?php $cpanel;?>">
            <input class="form-control mb-2" type="text" name="emp" placeholder="Employee Name">
            <input class="form-control mb-2" type="text" name="emp-phone" placeholder="Employee phone number">
            <input type="submit" value="Add" class="btn btn-outline-dark mb-2" name="add">
            </form>
        </div>
    </div>

    <div class="container text-center form-group col-md-4 col-lg-4 mb-2">
        <h1 class="display-5">Delete Employees</h1>
        <div class="form-group">
            <form method="POST" action="<?php $cpanel;?>">
            <label for="selectemp">Select Employee</label>
                    <select class="form-control mb-2" name="selectemp" id="selectemp">
                        <?php
                            selectemp();
                            function selectemp(){
                                global $conn,$bus_name,$owner_name,$result;
                                $sql = "SELECT emp_name FROM recs_employees_details WHERE bus_name = '$bus_name' AND owner_name = '$owner_name'";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                    selectempdisplay();
                                }else{
                                    dispemperror();
                                }
                            }
                            function selectempdisplay(){
                                global $result;
                                while($row = $result->fetch_assoc()){
                                    echo "<option value='".$row['emp_name']."'>".$row['emp_name']."</option>";
                                }
                            }
                        ?>
                    </select>
                    <?php
                        function dispemperror(){
                            echo "There are no employees to delete.";
                        }
                    ?>
            <input type="submit" value="Delete" class="btn btn-outline-dark mb-2" name="delete">
            </form>
        </div>
    </div>

    <?php
        if($_POST["add"]){
            addemployee();
        }
        if($_POST["delete"]){
            deleteemployee();
        }
        function addemployee(){
            global $bus_name,$owner_name,$conn;
            $emp_name = $_POST["emp"];
            $emp_phone = $_POST["emp-phone"];
            $sql = "INSERT INTO recs_employees_details (bus_name, owner_name, emp_name, emp_phone) VALUES ('$bus_name','$owner_name','$emp_name','$emp_phone')";
            $conn->query($sql);
        }
        function deleteemployee(){
            global $bus_name,$owner_name,$conn;
            $deleteemp = $_POST["selectemp"];
            $sql = "DELETE FROM recs_employees_details WHERE bus_name='$bus_name' AND owner_name='$owner_name' AND emp_name='$deleteemp'";
            $conn->query($sql);
        }
    ?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>