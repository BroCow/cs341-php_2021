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
        <meta name="description" content="This page serves as the PHP Data Access order page for CSE341 Project 1 Assignment.">
        <title>CSE 341 PHP Data Access | Order</title>
        <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="/web/wk3Assignments/normalize.css" media="screen">
        <link rel="stylesheet" href="project1.css" media="screen">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <!--
    SELECT order_type, public.orderitem.client_id, client_firstname, client_lastname 
    FROM public.order 
    INNER JOIN public.orderitem 
    ON public.order.orderitem_id = public.orderitem.orderitem_id
    INNER JOIN public.client ON public.orderitem.client_id = public.client.client_id
    WHERE order_type = 'Online';
    -->


    <!-- If/else statements for each possible order type selection with different statement prepared for each?-->
    <body>
        <?php
                $statement = $db->prepare("SELECT order_type, order_date, public.orderitem.client_id, client_firstname, client_lastname FROM public.order INNER JOIN public.orderitem ON public.order.orderitem_id = public.orderitem.orderitem_id INNER JOIN public.client ON public.orderitem.client_id = public.client.client_id WHERE public.orderitem.client_id = public.client.client_id");
                $statement->execute();

                if(isset($_POST['order_type'])){
                    $search_orderType = $_POST['order_type'];
                    $orderTypeArray = array();
                }
                

                // Go through each result
                while ($row = $statement->fetch(PDO::FETCH_ASSOC))
                {
                // The variable "row" now holds the complete record for that
                // row, and we can access the different values based on their
                // name
                $order_type = $row['order_type'];
                $order_date = $row['order_date'];
                $firstname = $row['client_firstname'];
                $lastname = $row['client_lastname'];

                echo "<p><strong>$firstname $lastname $email $phone</strong><p>";

                // Need to create an array and push results to it instead of variable
                if($search_orderType == $row['order_type']) {
                    array_push($orderTypeArray, $row['order_type']);
                    array_push($orderTypeArray, $row['client_firstname']);
                    array_push($orderTypeArray, $row['client_lastname']);
                    array_push($orderTypeArray, $row['order_date']);
                    
                    //echo $row['client_firstname'] . "<br>";
                    //$result_orderType = $row['order_type'];
                    //$result_orderDate = $row['order_date'];
                    //$result_firstName = $row['client_firstname'];
                    //echo $row['client_lastname'] . "<br>";
                    //$result_lastName = $row['client_lastname'];
                    }
                }
        
                
            ?>


        <main>
            <h1>Order Management</h1>

            <h2>Order Search</h2>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Order Search" name="orderSearch">
                <div class="form-group">
                    <label for="order_type">Order Type:</label>
                    <?php if(isset($_SESSION['order_type'])): ?>
                    <input type="text" class="form-control" id="order_type" name="order_type" value="<?php echo $_SESSION['order_type']?>">
                    <?php else: ?>
                    <input type="text" class="form-control" id="order_type" name="order_type">
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
            <!-- Make this a table for each one -->
            <?php 
                if(count($orderTypeArray) > 0){
                    echo "<h3>" . $search_orderType . " Orders</h3>";
                    echo "<table class='table table-bordered'>";
                    echo "<thead>";
                    echo    "<tr>";
                    echo        "<th>Order Type</th>";
                    echo        "<th>First Name</th>";
                    echo        "<th>Last Name</th>";
                    echo        "<th>Order Date</th>";
                    echo    "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    
                }

                

                foreach ($orderTypeArray as $value){
                    echo "<tr>";
                    for ($x = 0; $x <= 3; $x++) {
                        echo "<td>" . $value . "</td>";
                      }
                    //echo "<td>" . $value . "</td>";
                    echo "</tr>";
                }
                echo    "</tbody>";
                echo "</table>";
            ?>

            <?php
            
            ?>





        </main>
    

    </body>

</html>