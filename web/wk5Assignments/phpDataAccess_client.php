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
            $statement = $db->prepare("SELECT client_firstname, client_lastname, client_email, client_phone FROM client");
            $statement->execute();

            if(isset($_POST['client_firstname'])){
                $search_firstname = $_POST['client_firstname'];
                $clientNameArray = array();
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

                //echo $row['client_firstname'] . "<br>";
                //$result_FirstName = $row['client_firstname'];
                //echo $row['client_lastname'] . "<br>";
                //$result_lastName = $row['client_lastname'];
                //echo $row['client_email'] . "<br>";
                //$result_email = $row['client_email'];
                //echo $row['client_phone'] . "<br>";
                //$result_phone = $row['client_phone'];
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
        </nav>

        <main>
            <h1>Client Management</h1>

            <h2>Client Search</h2>

            <!-- Put buttons here to choose between single client or client list -->

            <!-- Put form here to enter client name to appear if "single client" selected -->

            <!-- Put form here to choose between single client or client list -->

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Client Search" name="clientSearch">
                <div class="form-group">
                    <label for="client_firstname">First Name:</label>
                    <?php if(isset($_SESSION['client_firstname'])): ?>
                    <input type="text" class="form-control" placeholder="Jane" id="client_firstname" name="client_firstname" value="<?php echo $_SESSION['client_firstname']?>">
                    <?php else: ?>
                    <input type="text" class="form-control" placeholder="Jane" id="client_firstname" name="client_firstname">
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
                  
                echo    "</tbody>";
                echo "</table>";
            ?>
            </div>
            
            
            
            
            <?php 
            /*
                echo $result_FirstName . "<br>"; 
                echo $result_lastName . "<br>";
                echo $result_email . "<br>";
                echo $result_phone . "<br>";
                */
            ?>




        </main>
    

    </body>

</html>