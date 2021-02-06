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
        <link rel="stylesheet" href="normalize.css" media="screen">
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

                //echo "<p><strong>$firstname $lastname $email $phone</strong><p>";

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

                <p>Order Date:</p>
                <label for="expMonth">Month</label>
                <select id="expMonth" name="expMonth">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <label for="expMonth">Day</label>
                <select id="expMonth" name="expMonth">
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
                <label for="expYear">Year</label>
                <select id="expYear" name="expYear">
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                </select>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
            <!-- Make this a table for each one -->
            <br>
            <br>
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

                $orderArrayCount = count($orderTypeArray);

                for ($x = 0; $x <= $orderArrayCount; $x++) {
                    echo "<tr>";
                    echo "<td>$orderTypeArray[$x]</td>"; 
                    $x++;
                    echo "<td>$orderTypeArray[$x]</td>"; 
                    $x++;
                    echo "<td>$orderTypeArray[$x]</td>"; 
                    $x++;
                    echo "<td>$orderTypeArray[$x]</td>"; 
                    echo "</tr>"; 
                }
                  
                echo    "</tbody>";
                echo "</table>";
            ?>





        </main>
    

    </body>

</html>