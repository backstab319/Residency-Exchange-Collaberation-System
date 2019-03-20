<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>
        <?php
            include "../../connect.php";
            include "vars.php";
            echo $bus_name;
        ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">
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
    <div class="container jumbotron text-center"><h1 class="display-4"><?php echo heading();?></h1>
    <p class="lead"><?php echo description();?></p>
    </div>

    <div class="container text-center d-flex flex-wrap">
        <p class="lead"><?php echo business_menu();?></p>
    </div>


    <?php
        function business_menu(){
            global $conn, $bus_name, $owner_name;
            $sql = "SELECT * FROM business_product WHERE bus_name='$bus_name' AND owner_name='$owner_name'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                business_menu_display($result);
            }else{
                return "This Business has not yet provided a menu of their products and services";
            }
        }
        function business_menu_display($menu){
            while($row = $menu->fetch_assoc()){
                echo "
                <div class='card col-lg-3 col-xl-3 mr-2 mb-2'>
                    <img class='card-img-top' src='".$row['product_link']."' height='200'>
                    <div class='card-body'>
                        <h5 class='card-title'>".$row['product_name'].' Price: '.$row['product_price']. 'rs'."</h5>
                        <p class='card-text'>".$row['product_description']."</p>
                        <button class='btn btn-outline-dark'>Buy</button>
                    </div>
                </div>
                ";
            }
        }
        function heading(){
            global $conn,$bus_name,$owner_name;
            $sql = "SELECT heading FROM business_page WHERE bus_name='$bus_name' AND owner_name='$owner_name' AND heading !=''";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                return $row["heading"];
            }else{
                return "Page Title";
            }
        }
        function description(){
            global $conn,$bus_name,$owner_name;
            $sql = "SELECT description FROM business_page WHERE bus_name='$bus_name' AND owner_name='$owner_name' AND description !=''";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                return $row["description"];
            }else{
                return "This is a page description";
            }
        }
    ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>