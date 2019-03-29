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
    

    <div class="container text-center jumbotron">
        <h1 class="display-4">Cart</h1>
    </div>
    <div class="container text-center col-md-4 col-lg-4">
        <?php
        $user = $_COOKIE["user"];
        include "../connect.php";
        if($_POST["order"]){
            order();
        }
        if($_GET["del"]){
            $delitem = $_GET["del"];
            delitemfun($delitem);
        }
        checkcart();
        function checkcart(){
            global $conn, $user;
            $sql = "SELECT * FROM cart WHERE user_id='$user'";
            $result1 = $conn->query($sql);
            if($result1->num_rows > 0){
                checkinfo();
                displaycart($result1);
            }else{
                orderplaced();
            }
        }
        function orderplaced($val){
            if($val == 1){
                echo "<p class='lead'>Your order has been placed!</p>";
            }else{
                echo "<p class='lead'>Sorry! Your cart is empty!</p>";
            }
        }
        function checkinfo(){
            global $user, $conn;
            $sql = "SELECT * FROM user_account WHERE name='$user'";
            $result = $conn->query($sql);
            if($result->num_rows == 0){
                echo "<p class='lead bg-alert'>Please Update your account information to order stuff.</p>";
                exit();
            }
        }
        function displaycart($result1){
            echo "<table class='table table-bordered table-striped table-hover'><thead class='thead-dark'>
                <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Remove</th>
                </thead>
            ";
            while($row = $result1->fetch_assoc()){
                $total = $total + $row['product_price'];
                echo "<tr>
                    <td>".$row['product_name']."</td>
                    <td>".$row['product_price']."</td>
                    <td><a class='btn btn-outline-dark' href='cart.php?del=".$row['product_name']."'>Delete</a></td>
                ";
            }
            echo "<tr>
                <td>Total</td><td>".$total."</td>
            </tr></table>
                <form method='POST' action='http://thebackstabproject.hostingerapp.com/page_init/cart.php'>
                <input type='submit' value='Order' name='order' class='form-control'>
                </form>
            ";
        }
        function order(){
            global $conn, $user;
            $sql = "SELECT * FROM cart WHERE user_id='$user'";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()){
                $bus_name = $row["bus_name"];
                $owner_name = $row["owner_name"];
                $user_id = $row["user_id"];
                $pname = $row["product_name"];
                $price = $row["product_price"];
                $sql = "INSERT INTO business_orders VALUES('$bus_name','$owner_name','$user_id','$pname',$price)";
                $conn->query($sql);
            }
            $sql = "DELETE FROM cart WHERE user_id='$user'";
            $conn->query($sql);
            orderplaced(1);
        }
        function delitemfun($delitem){
            global $conn, $user;
            $sql = "DELETE FROM cart WHERE product_name='$delitem'";
            $conn->query($sql);
        }
        ?>
    </div>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>