<?php
require 'connection.php';
//get_db() function created in connection.php
$db = get_db();

session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="author" content="Christopher Cowan">
        <meta name="description" content="This page serves as the PHP Data Access client page for CSE341 Project 1 Assignment.">
        <title>CSE 341 PHP Data Access | Client</title>
        <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="normalize.css" media="screen">
        <link rel="stylesheet" href="project1.css" media="screen">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
        if(isset($_POST['clientSearch'])){
            $statement = $db->prepare("SELECT client_firstname, client_lastname, client_email, client_phone FROM client");
            $statement->execute();
        }
            

            $clientNameArray = array();
            
            if(isset($_POST['client_firstname'])){
                $search_firstname = $_POST['client_firstname'];
            }
            
            if(isset($_POST['client_lastname'])){
                $search_lastname = $_POST['client_lastname'];
            }
            
            // Go through each result
            while ($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
            // The variable "row" now holds the complete record for that
            // row, and we can access the different values based on their
            // name
            $firstname = $row['client_firstname'];
            $lastname = $row['client_lastname'];
            $email = $row['client_email'];
            $phone = $row['client_phone'];
            //echo "<p><strong>$firstname $lastname $email $phone</strong><p>";
            
                if($search_firstname == $row['client_firstname']) {
                    array_push($clientNameArray, $row['client_firstname']);
                    array_push($clientNameArray, $row['client_lastname']);
                    array_push($clientNameArray, $row['client_email']);
                    array_push($clientNameArray, $row['client_phone']);
                } 
                if($search_lastname == $row['client_lastname']) {
                    array_push($clientNameArray, $row['client_firstname']);
                    array_push($clientNameArray, $row['client_lastname']);
                    array_push($clientNameArray, $row['client_email']);
                    array_push($clientNameArray, $row['client_phone']);
                } 

            }
        ?>

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
            <h1>Client Management</h1>

            <div id="test" class="container">
                    <div class="row">
                        <div class="col">
                            <form for="clientSearch" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <input type="hidden" id="clientSearch" name="clientSearch" value="clientSearch">
                                <button type="submit" id="clientSearch" class="homeButton">Search</button>
                            </form>
                        </div>

                        <div class="col">
                            <form for="clientAdd" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <input type="hidden" id="clientAdd" name="clientAdd" value="clientAdd">
                                <button type="submit" id="clientAdd" class="homeButton">Add</button>
                            </form>
                        </div>

                        <div class="col">
                            <form for="clientDelete" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <input type="hidden" id="clientDelete" name="clientDelete" value="clientDelete">
                                <button type="submit" id="clientDelete" class="homeButton">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>


            <?php
                if(isset($_POST['clientSearch'])){
                    echo "<h2>Client Search</h2>";
                }
                
            ?>
            

            <!-- Put buttons here to choose between single client or client list -->

            <!-- Put form here to enter client name to appear if "single client" selected -->

            <!-- Put form here to choose between single client or client list -->

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Client Search" name="clientSearch">
                <div class="form-group">
                    <label for="client_firstname">First Name:</label>
                    <?php if(isset($_SESSION['client_firstname'])): ?>
                    <input type="text" class="form-control" id="client_firstname" name="client_firstname" value="<?php echo $_SESSION['client_firstname']?>">
                    <?php else: ?>
                    <input type="text" class="form-control" id="client_firstname" name="client_firstname">
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="client_lastname">Last Name:</label>
                    <?php if(isset($_SESSION['client_lastname'])): ?>
                    <input type="text" class="form-control" id="client_lastname" name="client_lastname" value="<?php echo $_SESSION['client_lastname']?>">
                    <?php else: ?>
                    <input type="text" class="form-control" id="client_lastname" name="client_lastname">
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <br>
            
            <br>

            <div class="table">
                
            <?php 
                if(count($clientNameArray) > 0){
                    echo "<h3>Search results for " . $search_firstname . "</h3>";
                    echo "<table class='table table-bordered'>";
                    echo "<thead>";
                    echo    "<tr>";
                    echo        "<th>First Name</th>";
                    echo        "<th>Last Name</th>";
                    echo        "<th>Email</th>";
                    echo        "<th>Phone</th>";
                    echo    "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                }

                $clientArrayCount = count($clientNameArray);

                for ($x = 0; $x <= $clientArrayCount; $x++) {
                    echo "<tr>";
                    echo "<td>$clientNameArray[$x]</td>"; 
                    $x++;
                    echo "<td>$clientNameArray[$x]</td>"; 
                    $x++;
                    echo "<td>$clientNameArray[$x]</td>"; 
                    $x++;
                    echo "<td>$clientNameArray[$x]</td>"; 
                    echo "</tr>"; 
                }
                
                if(count($clientNameArray) > 0){
                    echo    "</tbody>";
                    echo "</table>";
                }
            ?>
            </div>
            
        </main>
    

    </body>

</html>