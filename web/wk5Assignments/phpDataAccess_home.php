<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="author" content="Christopher Cowan">
        <meta name="description" content="This page serves as the PHP Data Access home page for CSE341 Project 1 Assignment.">
        <title>CSE 341 PHP Data Access | Home</title>
        <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="normalize.css" media="screen">
        <link rel="stylesheet" href="project1.css" media="screen">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <body>
        <header>
        </header>

        <!-- A grey horizontal navbar that becomes vertical on small screens -->
        
            <nav class="navbar navbar-expand-sm bg-light">
                <!-- Links -->
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="phpDataAccess_home.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="phpDataAccess_client.php">Client</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="phpDataAccess_order.php">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="phpDataAccess_item.php">Item</a>
                </li>
                </ul>
                <h1 class="gemHunter">Gem Hunter Designs</h1>
            </nav>
            

        <main>
            
            <div class="container p-3 my-3 bg-dark">
                <div class="row">
                    <form method="post" action="phpDataAccess_client.php">
                        <div class="col-lg-3">
                        <img src="" alt="">
                        <button type="submit" id="clientButton" class="homeButton">Client</button>
                        </div>
                    </form>

                    <form method="post" action="phpDataAccess_order.php">
                        <div class="col-lg-3">
                        <img src="" alt="">
                        <button type="submit" id="orderButton" class="homeButton">Order</button>
                        </div>
                    </form>

                    <form method="post" action="phpDataAccess_item.php">
                        <div class="col-lg-3">
                        <img src="" alt="">
                        <button type="submit" id="itemButton" class="homeButton">Item</button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    

    </body>

</html>