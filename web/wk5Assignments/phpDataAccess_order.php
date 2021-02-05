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


    <body>
        <?php
                $statement = $db->prepare("SELECT order_type, order_date, public.orderitem.client_id, client_firstname, client_lastname FROM public.order INNER JOIN public.orderitem ON public.order.orderitem_id = public.orderitem.orderitem_id INNER JOIN public.client ON public.orderitem.client_id = public.client.client_id WHERE public.orderitem.client_id = public.client.client_id");
                $statement->execute();

                if(isset($_POST['order_type'])){
                    $search_orderType = $_POST['order_type'];
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

                if($search_orderType == $row['order_type']) {
                    //echo $row['client_firstname'] . "<br>";
                    $result_orderType = $row['order_type'];
                    $result_orderDate = $row['order_date'];
                    $result_firstName = $row['client_firstname'];
                    //echo $row['client_lastname'] . "<br>";
                    $result_lastName = $row['client_lastname'];
                    }
                }
        
                
            ?>


        <main>
            <h1>Order Management</h1>

            <h2>Order Search</h2>

            <!-- Put buttons here to choose between single client or client list -->

            <!-- Put form here to enter client name to appear if "single client" selected -->

            <!-- Put form here to choose between single client or client list -->

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
            
            <?php 
                echo $result_firstName . "<br>";
                echo $result_lastName . "<br>";
                echo $result_orderType . "<br>"; 
                echo $result_orderDate . "<br>";
                
            ?>





        </main>
    

    </body>

</html>