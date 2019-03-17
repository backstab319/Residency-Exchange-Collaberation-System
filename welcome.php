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
    <div class="navbar-section home">
        <navbar class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand">RECS</a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#toggle" type="button"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="toggle">
                    <div class="navbar-menu ml-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/reg-business.php">Register business</a>
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
            if(!isset($_COOKIE["user"])){
            echo "Please login back in again to continue browsing RECS!";
            exit();
        }
        ?>
    </div>


    <div class="container jumbotron text-center">
        <h1 class="display-4">Services available.</h1>
        <?php
            include "/connect.php";
            $bus_name;
            $owner_name;
            $owner_number;
            $bus_address;
            $bus_type;
            function data_init(){
                global $bus_name,$owner_name,$owner_number,$bus_address,$bus_type,$conn;
                $sql = "SELECT * FROM business_reg";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    echo "There is data in sql";
                }else{
                    echo "There is no data in sql";
                }
                while($row = $result->fetch_assoc()){
                    echo $row["bus_name"] . $row["owner_name"] . $row["owner_contact"] . $row["owner_address"] . $row["business_type"];
                }
            }
        ?>
    </div>

    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>