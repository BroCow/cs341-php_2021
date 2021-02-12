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
            if(isset($_POST['client_firstname']) || isset($_POST['client_lastname'])){
                $statement = $db->prepare("SELECT client_firstname, client_lastname, client_email, client_phone FROM client");
                $statement->execute();

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
            }


            if(isset($_POST['Addclient_firstname']) || isset($_POST['Addclient_lastname'])){ 
                $_AddClientFirstName = $_POST['Addclient_firstname'];
                $_AddClientLastName = $_POST['Addclient_lastname'];
                $_AddClientEmail = $_POST['Addclient_email'];
                $_AddClientPhone = $_POST['Addclient_phone'];
                /*
                $query = "INSERT INTO client (client_firstname, client_lastname, client_email, client_phone) VALUES (:client_firstname, :client_lastname, :client_email, :client_phone)"; 
                */
                $statement = $db->prepare('INSERT INTO client(client_firstname, client_lastname, client_email, client_phone) VALUES (:client_firstname, :client_lastname, :client_email, :client_phone);');
                $statement->bindValue(':client_firstname', $_AddClientFirstName, PDO::PARAM_TEXT);
                $statement->bindValue(':client_lastname', $_AddClientLastName, PDO::PARAM_TEXT);
                $statement->bindValue(':client_email', $_AddClientEmail, PDO::PARAM_TEXT);
                $statement->bindValue(':client_phone', $_AddClientPhone, PDO::PARAM_TEXT);
                
                $statement->execute();
                
                echo $_AddClientFirstName;
                echo $_AddClientLastName;
                echo $_AddClientEmail;
                echo $_AddClientPhone;
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
                            <button onclick="toggleClientSearch()" id="clientSearch" class="homeButton">Search</button>
                    </div>

                    <div class="col">
                            <button onclick="toggleClientAdd()" id="clientAdd" class="homeButton">Add</button>
                    </div>

                    <div class="col">
                            <button onclick="toggleClientDelete()" id="clientDelete" class="homeButton">Delete</button>
                    </div>
                </div>
            </div>
            
            <div id="clientSearchForm" style="display:none;">
                <br>
                <br>
                <h2>Client Search</h2>
                
                <form id="form_clientSearch" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Client Search" name="clientSearch">
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

                    <div class="form-group">
                        <label for="client_email">Email:</label>
                        <?php if(isset($_SESSION['client_email'])): ?>
                        <input type="email" class="form-control" id="client_email" name="client_email" value="<?php echo $_SESSION['client_email']?>">
                        <?php else: ?>
                        <input type="email" class="form-control" id="client_email" name="client_email">
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="client_phone">Phone:</label>
                        <?php if(isset($_SESSION['client_phone'])): ?>
                        <input type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" class="form-control" id="client_phone" name="client_phone" value="<?php echo $_SESSION['client_phone']?>">
                        <?php else: ?>
                        <input type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" class="form-control" id="client_phone" name="client_phone">
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn-lg btn-primary">Submit</button>
                </form>
            </div>

            <div id="clientAddForm" style="display:none;">
                <br>
                <br>
                <h2>Add Client</h2>
                
                <form id="form_clientAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Client Add" name="clientAdd">
                    <div class="form-group">
                        <label for="Addclient_firstname">First Name:</label>
                        <?php if(isset($_SESSION['Addclient_firstname'])): ?>
                        <input type="text" class="form-control" id="Addclient_firstname" name="Addclient_firstname" value="<?php echo $_SESSION['Addclient_firstname']?>">
                        <?php else: ?>
                        <input type="text" class="form-control" id="Addclient_firstname" name="Addclient_firstname">
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="Addclient_lastname">Last Name:</label>
                        <?php if(isset($_SESSION['Addclient_lastname'])): ?>
                        <input type="text" class="form-control" id="Addclient_lastname" name="Addclient_lastname" value="<?php echo $_SESSION['Addclient_lastname']?>">
                        <?php else: ?>
                        <input type="text" class="form-control" id="Addclient_lastname" name="Addclient_lastname">
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="Addclient_email">Email:</label>
                        <?php if(isset($_SESSION['Addclient_email'])): ?>
                        <input type="email" class="form-control" id="Addclient_email" name="Addclient_email" value="<?php echo $_SESSION['Addclient_email']?>">
                        <?php else: ?>
                        <input type="email" class="form-control" id="Addclient_email" name="Addclient_email">
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="Addclient_phone">Phone:</label>
                        <?php if(isset($_SESSION['Addclient_phone'])): ?>
                        <input type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" class="form-control" id="Addclient_phone" name="Addclient_phone" value="<?php echo $_SESSION['Addclient_phone']?>">
                        <?php else: ?>
                        <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-control" id="Addclient_phone" name="Addclient_phone">
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn-lg btn-primary">Add Client</button>
                </form>
            </div>

            <div id="clientDeleteForm" style="display:none;">
                <br>
                <br>
                <h2>Delete Client</h2>
                
                <form id="form_clientDelete" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Client Delete" name="clientDelete">
                    <div class="form-group">
                        <label for="Delclient_firstname">First Name:</label>
                        <?php if(isset($_SESSION['Delclient_firstname'])): ?>
                        <input type="text" class="form-control" id="Delclient_firstname" name="Delclient_firstname" value="<?php echo $_SESSION['Delclient_firstname']?>">
                        <?php else: ?>
                        <input type="text" class="form-control" id="Delclient_firstname" name="Delclient_firstname">
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="Delclient_lastname">Last Name:</label>
                        <?php if(isset($_SESSION['Delclient_lastname'])): ?>
                        <input type="text" class="form-control" id="Delclient_lastname" name="Delclient_lastname" value="<?php echo $_SESSION['Delclient_lastname']?>">
                        <?php else: ?>
                        <input type="text" class="form-control" id="Delclient_lastname" name="Delclient_lastname">
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn-lg btn-primary">Delete Client</button>
                </form>
            </div>




            <br>
            <br>

            <div class="table">
                
            <?php 
                if(isset($_POST['client_firstname']) || isset($_POST['client_lastname'])){
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
                }
            ?>
            </div>
            
        </main>
    
        <script src="project1.js"></script>
    </body>

</html>