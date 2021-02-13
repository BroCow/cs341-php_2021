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
        <meta name="description" content="This page serves as the PHP Data Access item page for CSE341 Project 1 Assignment.">
        <title>CSE 341 PHP Data Access | Item</title>
        <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="normalize.css" media="screen">
        <link rel="stylesheet" href="project1.css" media="screen">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
            $statement = $db->prepare("SELECT item_type, item_name, item_desc, item_price FROM public.item item_id");
            $statement->execute();

            if(isset($_POST['item_type'])){
                $search_itemType = $_POST['item_type'];
                $itemTypeArray = array();
            }
            

            // Go through each result
            while ($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
            // The variable "row" now holds the complete record for that
            // row, and we can access the different values based on their
            // name
            $item_type = $row['item_type'];
            $item_name = $row['item_name'];
            $item_desc = $row['item_desc'];
            $item_price = $row['item_price'];

            //echo "<p><strong>$firstname $lastname $email $phone</strong><p>";

            // Need to create an array and push results to it instead of variable
            if($search_itemType == $row['item_type']) {
                array_push($itemTypeArray, $row['item_type']);
                array_push($itemTypeArray, $row['item_name']);
                array_push($itemTypeArray, $row['item_desc']);
                array_push($itemTypeArray, $row['item_price']);
                
                //echo $row['client_firstname'] . "<br>";
                //$result_orderType = $row['order_type'];
                //$result_orderDate = $row['order_date'];
                //$result_firstName = $row['client_firstname'];
                //echo $row['client_lastname'] . "<br>";
                //$result_lastName = $row['client_lastname'];
                }
            }  

            if(isset($_POST['Additem_type'])){ 
                
                $AddItemType = htmlspecialchars($_POST['Additem_type']);
                $AddItemDesc = htmlspecialchars($_POST['Additem_desc']);
                $AddItemPrice = htmlspecialchars($_POST['Additem_price']);
                $AddItemName = htmlspecialchars($_POST['Additem_name']);
                
                $query = "INSERT INTO item (item_type, item_desc, item_price, item_name) VALUES (:AddItemType, :AddItemDesc, :AddItemPrice, :AddItemName)";
                
                $stmt = $db->prepare($query);
                $stmt->bindValue(':AddItemType', $AddItemType, PDO::PARAM_STR);
                $stmt->bindValue(':AddItemDesc', $AddItemDesc, PDO::PARAM_STR);
                $stmt->bindValue(':AddItemPrice', $AddItemPrice, PDO::PARAM_INT);
                $stmt->bindValue(':AddItemName', $AddItemName, PDO::PARAM_STR);
                $stmt->execute();

                $AddMessage = "New Item Added";
            }

            if(isset($_POST['Delitem_name'])){ 

                if(isset($_POST['Delitem_name'])){
                    $delete_name = $_POST['Delitem_name'];
                }

                $query = "DELETE FROM item WHERE item_name = '".$delete_name."'";
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
            <h1>Item Management</h1>

            <div id="test" class="container">
                <div class="row">
                    <div class="col">
                            <button onclick="toggleItemSearch()" id="itemSearch" class="homeButton">Search</button>
                    </div>

                    <div class="col">
                            <button onclick="toggleItemAdd()" id="itemAdd" class="homeButton">Add</button>
                    </div>

                    <div class="col">
                            <button onclick="toggleItemDelete()" id="itemDelete" class="homeButton">Delete</button>
                    </div>
                </div>
            </div>

            <div id="itemSearchForm" style="display:none;">
                <br>
                <br>
                <h2>Item Search</h2>

                <!-- Put buttons here to choose between single client or client list -->

                <!-- Put form here to enter client name to appear if "single client" selected -->

                <!-- Put form here to choose between single client or client list -->

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Item Search" name="itemSearch">
                    <label for="item_type">Search by item type:</label>
                    <br>
                    <select id="item_type" name="item_type">
                        <option value="">Select</option>
                        <option value="Necklace">Necklace</option>
                        <option value="Earrings">Earrings</option>
                        <option value="Bracelet">Bracelet</option>
                    </select>
                    <br>
                    <br>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>

            <div id="itemAddForm" style="display:none;">
                <br>
                <br>
                <h2>Add Item</h2>
                
                <form id="form_itemAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Item Add" name="itemAdd">
                    <div class="form-group">
                        <label for="Additem_type">Select item type to add:</label>
                        <br>
                        <select id="Additem_type" name="Additem_type" required>
                            <option value="">Select</option>
                            <option value="Necklace">Necklace</option>
                            <option value="Earrings">Earrings</option>
                            <option value="Bracelet">Bracelet</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Additem_desc">Enter item description:</label>
                        <?php if(isset($_SESSION['Additem_desc'])): ?>
                        <input type="textarea" class="form-control" id="Additem_desc" name="Additem_desc" value="<?php echo $_SESSION['Additem_desc']?>" required>
                        <?php else: ?>
                        <input type="textarea" class="form-control" id="Additem_desc" name="Additem_desc" required>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="Additem_price">Enter item price:</label>
                        <?php if(isset($_SESSION['Additem_price'])): ?>
                        <input type="number" class="form-control" id="Additem_price" name="Additem_price" value="<?php echo $_SESSION['Additem_price']?>" required>
                        <?php else: ?>
                        <input type="number" class="form-control" id="Additem_price" name="Additem_price" required>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="Additem_name">Enter item name:</label>
                        <?php if(isset($_SESSION['Additem_name'])): ?>
                        <input type="text" class="form-control" id="Additem_name" name="Additem_name" value="<?php echo $_SESSION['Additem_name']?>">
                        <?php else: ?>
                        <input type="text" class="form-control" id="Additem_name" name="Additem_name" required>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn-lg btn-primary">Add Item</button>

                </form>
            </div>
            <br>
            <br>
            <div id="itemDeleteForm" style="display:none;">
                <br>
                <br>
                <h2>Delete Item</h2>
                
                <form id="form_itemDelete" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Item Delete" name="itemDelete">
                    <div class="form-group">
                        <label for="Delitem_name">Enter Item Name:</label>
                        <?php if(isset($_SESSION['Delitem_name'])): ?>
                        <input type="text" class="form-control" id="Delitem_name" name="Delitem_name" value="<?php echo $_SESSION['Delitem_name']?>">
                        <?php else: ?>
                        <input type="text" class="form-control" id="Delitem_name" name="Delitem_name">
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn-lg btn-primary">Delete Item</button>
                </form>
            </div>
                
                <!-- Make this a table for each one -->
                <br>
                <br>
            <?php 
                if(count($itemTypeArray) > 0){
                    echo "<h3>" . $search_itemType . " Items</h3>";
                    echo "<table class='table table-bordered'>";
                    echo "<thead>";
                    echo    "<tr>";
                    echo        "<th>Item Type</th>";
                    echo        "<th>Item Name</th>";
                    echo        "<th>Item Description</th>";
                    echo        "<th>Item Price</th>";
                    echo    "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                }

                $itemArrayCount = count($itemTypeArray);

                for ($x = 0; $x <= $itemArrayCount; $x++) {
                    echo "<tr>";
                    echo "<td>$itemTypeArray[$x]</td>"; 
                    $x++;
                    echo "<td>$itemTypeArray[$x]</td>"; 
                    $x++;
                    echo "<td>$itemTypeArray[$x]</td>"; 
                    $x++;
                    echo "<td>$itemTypeArray[$x]</td>"; 
                    echo "</tr>"; 
                }
                  
                echo    "</tbody>";
                echo "</table>";
            ?>





        </main>
    
        <script src="project1.js"></script>
    </body>

</html>