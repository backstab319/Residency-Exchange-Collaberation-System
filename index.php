<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>RECS Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="navbar-section">
        <navbar class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand">RECS</a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#toggle" type="button"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="toggle">
                    <div class="navbar-menu ml-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#about">About RECS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#devlopment">Devlopment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#status">Status</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>




    <div class="container home text-center col-md-5">
        <h1 class="display-4">Login</h1>
        <div class="form-group">
            <form method="POST" action="index.php">
                <div class="row">
                    <div class="col mb-2">
                        <input class="form-control" type="text" name="username" placeholder="Username">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <input class="form-control" type="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <input type="submit" value="Login" name="submit" class="btn btn-outline-dark btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>




    <div class="container jumbotron text-center" id="about">
        <h1 class="display-4">What is RECS?</h1>
        <p class="lead text-justify text-center">
            RECS stands for Residency Exchange Collaberation System. In today’s fast moving online world any entity that
            doesn’t exist online becomes lesser and lesser utilised by people and slowly fades away. In today’s world
            the residencies and local markets have the same issues. When it comes to things like knowing what services
            and products and prices are offered by various providers in the local market there currently exists no
            system. Same goes the other way around where the market does not know the demand of their fellow residents.
            People would also prefer a mode of communication between them and the local exchange and also the ability to
            raise concern and suggestion among each other.
        </p>
    </div>




    <div class="container jumbotron text-center" id="devlopment">
        <h1 class="display-4">Development of RECS</h1>
        <p class="lead text-justify text-center">
            This project is actively developed by Siddhartha Dev Gupta. Under the Guidance of project guide Mrs.Pavithra
            MN.
        </p>
    </div>




    <div class="container jumbotron text-center" id="status">
        <h1 class="display-4">Project Status</h1>
        <p class="lead text-justify text-center">The project is in beta stage. The code can be found on my <a
                class="btn btn-outline-dark"
                href="https://github.com/backstab319/Residency-Exchange-Collaberation-System">github page.</a></p>
    </div>



    <?php
        include "connect.php";
        if($_POST["submit"]){
            operation();
        }
        $username = $_POST["username"];
        $password = $_POST["password"];
        function operation(){
            global $username,$password,$conn;
            echo $username,$password;
        }

    ?>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>