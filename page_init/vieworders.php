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
        include "../connect.php";
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
    <h1 class='display-4'>Orders</h1>
    </div>

    <div class="container d-flex justify-content-center col-md-4 col-lg-4 text-center">
    
    <?php
        showusers(1);
        if($_POST["view"]){
            viewsel();
        }
        function showusers($val){
            global $conn;
            $sql = "SELECT DISTINCT user_id FROM business_orders";
            $result = $conn->query($sql);
            if($result->num_rows == 0){
                echo "<p class='lead'>There are no orders placed yet</p>";
                exit();
            }
            echo "
                <div class='form-group text-center col-md-6 col-lg-6 mb-2'>
                <form method='POST' action='vieworders.php'>
            ";
            if($val == 1){
                echo "<label for='sel'>Select user to view order</label>";
                echo "<select id='sel' class='form-control mb-2' name='sel'>";
            }else{
                echo "<label for='sel'>Delete orders</label>";
                echo "<select id='sel' class='form-control mb-2' name='del'>";
            }
            while($row = $result->fetch_assoc()){
                echo "<option value='".$row['user_id']."'>".$row['user_id']."</option>";
            }
            echo "</select>";
            if($val == 1){
                echo "<input type='submit' value='View order' name='view' class='form-control mb-2'>";
            }else{
                echo "<input type='submit' value='Delete order' name='del-sel' class='form-control mb-2'>";
            }
            echo "</form>
            </div>";
        }
        function viewsel(){
            global $conn;
            $seluser = $_POST["sel"];
            $sql = "SELECT * FROM business_orders WHERE user_id='$seluser'";
            $result = $conn->query($sql);
            showorder($result);
        }
        function showorder($result){
            echo "<table class='table table-bordered table-striped table-hover col-md-4 col-lg-4 mb-2'><thead class='thead-dark'>
                <tr>
                <th>Product</th>
                <th>Price</th>
                </thead>
            ";
            while($row = $result->fetch_assoc()){
                $total = $total + $row['product_price'];
                echo "<tr>
                    <td>".$row['product_name']."</td>
                    <td>".$row['product_price']."</td>
                ";
            }
            echo "<tr>
                <td>Total</td><td>".$total."</td>
            </tr></table>
            ";
        }
    ?>
    </div>

    <div class="container text-center col-md-6 col-lg-6">
        <h1 class="display-4">Remove completed orders</h1>
        <div class="container text-center d-flex justify-content-center">
            <?php
                showusers(0);
                if($_POST["del-sel"]){
                    delorder();
                }
                function delorder(){
                    global $conn;
                    $del = $_POST["del"];
                    $sql = "DELETE FROM business_orders WHERE user_id='$del'";
                    $conn->query($sql);
                }
            ?>
        </div>
    </div>


    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>