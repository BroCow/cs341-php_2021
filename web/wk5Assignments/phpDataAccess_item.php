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
        <link rel="stylesheet" href="/web/wk3Assignments/normalize.css" media="screen">
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
        ?>

        <nav class="navbar navbar-expand-sm bg-light">
            <!-- Links -->
            <ul class="navbar-nav">
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
            <h1>Item Management</h1>

            <h2>Item Search</h2>

            <!-- Put buttons here to choose between single client or client list -->

            <!-- Put form here to enter client name to appear if "single client" selected -->

            <!-- Put form here to choose between single client or client list -->

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Item Search" name="itemSearch">
                <div class="form-group">
                    <label for="item_type">Item Type:</label>
                    <?php if(isset($_SESSION['item_type'])): ?>
                    <input type="text" class="form-control" id="item_type" name="item_type" value="<?php echo $_SESSION['item_type']?>">
                    <?php else: ?>
                    <input type="text" class="form-control" id="item_type" name="item_type">
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
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
    

    </body>

</html>