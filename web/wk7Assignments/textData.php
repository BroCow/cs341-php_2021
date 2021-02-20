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
            if(isset($_POST['client_firstname']) || isset($_POST['client_lastname']) || isset($_POST['client_email']) || isset($_POST['client_phone'])){
                $statement = $db->prepare("SELECT client_firstname, client_lastname, client_email, client_phone FROM client");
                $statement->execute();

                $clientNameArray = array();
                
                
                if(isset($_POST['client_firstname'])){
                    $search_firstname = htmlspecialchars($_POST['client_firstname']);
                }
                
                if(isset($_POST['client_lastname'])){
                    $search_lastname = htmlspecialchars($_POST['client_lastname']);
                }

                if(isset($_POST['client_email'])){
                    $search_email = htmlspecialchars($_POST['client_email']);
                }

                if(isset($_POST['client_phone'])){
                    $search_phone = htmlspecialchars($_POST['client_phone']);
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
                    echo "<p><strong>$firstname $lastname $email $phone</strong><p>";

                    if($search_firstname == $row['client_firstname'] || $search_lastname == $row['client_lastname'] || $search_email == $row['client_email'] || $search_phone == $row['client_phone']) {
                        array_push($clientNameArray, $row['client_firstname']);
                        array_push($clientNameArray, $row['client_lastname']);
                        array_push($clientNameArray, $row['client_email']);
                        array_push($clientNameArray, $row['client_phone']);
                    } 
                }
            }

            
            if(isset($_POST['Addclient_firstname']) || isset($_POST['Addclient_lastname'])){ 
                
                $AddClientFirstName = htmlspecialchars($_POST['Addclient_firstname']);
                $AddClientLastName = htmlspecialchars($_POST['Addclient_lastname']);
                $AddClientEmail = htmlspecialchars($_POST['Addclient_email']);
                $AddClientPhone = htmlspecialchars($_POST['Addclient_phone']);
                
                $query = "INSERT INTO client (client_firstname, client_lastname, client_email, client_phone) VALUES (:AddClientFirstName, :AddClientLastName, :AddClientEmail, :AddClientPhone)";
                
                $stmt = $db->prepare($query);
                $stmt->bindValue(':AddClientFirstName', $AddClientFirstName, PDO::PARAM_STR);
                $stmt->bindValue(':AddClientLastName', $AddClientLastName, PDO::PARAM_STR);
                $stmt->bindValue(':AddClientEmail', $AddClientEmail, PDO::PARAM_STR);
                $stmt->bindValue(':AddClientPhone', $AddClientPhone, PDO::PARAM_STR);
                $stmt->execute();

                $AddMessage = "New Client Added";
            }


            if(isset($_POST['Delclient_email']) || isset($_POST['Delclient_lastname'])){ 

                if(isset($_POST['Delclient_email'])){
                    $delete_email = $_POST['Delclient_email'];
                }

                $query = "DELETE FROM client WHERE client_email = '".$delete_email."'";
                $stmt = $db->prepare($query);
                $stmt->execute();
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
            <h3>

            <div id="test" class="container">
                <div class="row">
                    <div class="col">
                            <button onclick="toggleClientSearch()" id="clientSearch" class="homeButton">Search<br>Client</button>
                    </div>

                    <div class="col">
                            <button onclick="toggleClientAdd()" id="clientAdd" class="homeButton">Add<br>Client</button>
                    </div>

                    <div class="col">
                            <button onclick="toggleClientDelete()" id="clientDelete" class="homeButton">Delete<br>Client</button>
                    </div>
                </div>
            </div>
            
            <div id="clientSearchForm" style="display:none;">
                <br>
                <br>
                <h2>Client Search</h2>
                <h4>Use any of the search fields below to search for client</h4>
                
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

                    <button type="submit" class="btn-lg btn-primary">Search</button>
                </form>
                <br>

                <h4>Not sure about the client's information?</h4>
                <form id="clientList" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Client List" name="clientList">
                    <input type="hidden" id="client_list" name="client_list" value="client_list">
                    <button type="submit" class="btn-sm btn-info">View Client List</button>
                </form>
            </div>
            <br>
            <?php
                if(isset($_POST['client_list'])){
                    $statement = $db->prepare("SELECT client_firstname, client_lastname, client_email, client_phone FROM client");
                    $statement->execute();

                    $clientListArray = array();

                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    
                        // The variable "row" now holds the complete record for that
                        // row, and we can access the different values based on their
                        // name
                        $firstname = $row['client_firstname'];
                        $lastname = $row['client_lastname'];
                        $email = $row['client_email'];
                        $phone = $row['client_phone'];

                        array_push($clientListArray, $row['client_firstname']);
                        array_push($clientListArray, $row['client_lastname']);
                        array_push($clientListArray, $row['client_email']);
                        array_push($clientListArray, $row['client_phone']);
                    }
                }
            ?>

            <?php 
            if(isset($_POST['client_list'])){
                echo "<div id='viewClientList'>";
            } else {
                echo "<div id='viewClientList' style='display:none;'>";
            }
            ?>
                <h3>Client List</h3>
                <div class="row">
                <?php
                    $clientListArrayCount = count($clientListArray);

                    for ($x = 0; $x <= $clientListArrayCount; $x++) {
                        echo "<div class='col-sm-3'>";
                            echo "<p class='clientList_P'>$clientListArray[$x] "; 
                            $x++;
                            echo "$clientListArray[$x]<br>"; 
                            $x++;
                            echo "$clientListArray[$x]<br>"; 
                            $x++;
                            echo "$clientListArray[$x]</p>"; 
                        echo "</div>";
                    }
                ?>
                </div>
            </div>

            <div id="clientAddForm" style="display:none;">
                <br>
                <br>
                <h2>Add Client</h2>
                
                <form id="form_clientAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Client Add" name="clientAdd">
                    <div class="form-group">
                        <label for="Addclient_firstname">First Name:</label>
                        <?php if(isset($_SESSION['Addclient_firstname'])): ?>
                        <input type="text" class="form-control" id="Addclient_firstname" name="Addclient_firstname" value="<?php echo $_SESSION['Addclient_firstname']?>" required>
                        <?php else: ?>
                        <input type="text" class="form-control" id="Addclient_firstname" name="Addclient_firstname" required>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="Addclient_lastname">Last Name:</label>
                        <?php if(isset($_SESSION['Addclient_lastname'])): ?>
                        <input type="text" class="form-control" id="Addclient_lastname" name="Addclient_lastname" value="<?php echo $_SESSION['Addclient_lastname']?>" required>
                        <?php else: ?>
                        <input type="text" class="form-control" id="Addclient_lastname" name="Addclient_lastname" required>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="Addclient_email">Email:</label>
                        <?php if(isset($_SESSION['Addclient_email'])): ?>
                        <input type="email" class="form-control" id="Addclient_email" name="Addclient_email" value="<?php echo $_SESSION['Addclient_email']?>" required>
                        <?php else: ?>
                        <input type="email" class="form-control" id="Addclient_email" name="Addclient_email" required>
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
                        <label for="Delclient_email">Enter Client Email:</label>
                        <?php if(isset($_SESSION['Delclient_email'])): ?>
                        <input type="text" class="form-control" id="Delclient_email" name="Delclient_email" value="<?php echo $_SESSION['Delclient_email']?>">
                        <?php else: ?>
                        <input type="text" class="form-control" id="Delclient_email" name="Delclient_email">
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