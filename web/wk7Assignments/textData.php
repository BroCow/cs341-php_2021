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
            //if(isset($_POST['order_type']) || isset($_POST['month'])){
                $statement = $db->prepare("SELECT order_type, order_date, public.orderitem.client_id, client_firstname, client_lastname FROM public.order INNER JOIN public.orderitem ON public.order.orderitem_id = public.orderitem.orderitem_id INNER JOIN public.client ON public.orderitem.client_id = public.client.client_id WHERE public.orderitem.client_id = public.client.client_id");
                $statement->execute();

 
                $orderArray = array();

                if(isset($_POST['order_type'])){
                    $search_orderType = $_POST['order_type'];
                }

                
                if(null !==($_POST['year'] && $_POST['month'] && $_POST['day'])){
                    $search_orderDate = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
                }
                //echo $search_orderDate;

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
                    array_push($orderArray, $row['order_type']);
                    array_push($orderArray, $row['client_firstname']);
                    array_push($orderArray, $row['client_lastname']);
                    array_push($orderArray, $row['order_date']);
                    }
                if($search_orderDate == $row['order_date']) {
                    array_push($orderArray, $row['order_type']);
                    array_push($orderArray, $row['client_firstname']);
                    array_push($orderArray, $row['client_lastname']);
                    array_push($orderArray, $row['order_date']);
                    } 
                } 
            //}


            

            /********* Select Client Data to create client drop-down */
            if(isset($_POST['Addorder_firstname']) || isset($_POST['Addorder_lastname'])){
                $statement = $db->prepare("SELECT client_id, client_firstname, client_lastname, client_email, client_phone FROM client");
                $statement->execute();

                $orderNameArray = array();
                
                if(isset($_POST['Addorder_firstname'])){
                    $order_firstname = htmlspecialchars($_POST['Addorder_firstname']);
                }
                
                if(isset($_POST['Addorder_lastname'])){
                    $order_lastname = htmlspecialchars($_POST['Addorder_lastname']);
                }
                
                // Go through each result
                while ($row = $statement->fetch(PDO::FETCH_ASSOC))
                {
                // The variable "row" now holds the complete record for that
                // row, and we can access the different values based on their
                // name
                $orderClientId = $row['client_id'];
                $orderFirstname = $row['client_firstname'];
                $orderLastname = $row['client_lastname'];
                $orderEmail = $row['client_email'];
                $orderPhone = $row['client_phone'];
                //echo "<p><strong>$orderFirstname $orderLastname $orderEmail $orderPhone</strong><p>";
                
                    if($order_firstname == $row['client_firstname'] || $order_lastname == $row['client_lastname']) {
                        $_SESSION['Addorder_clientId'] = $row['client_id'];
                        $_SESSION['Addorder_firstname'] = $row['client_firstname'];
                        $_SESSION['Addorder_lastname'] = $row['client_lastname'];

                        array_push($orderNameArray, $row['client_id']);
                        array_push($orderNameArray, $row['client_firstname']);
                        array_push($orderNameArray, $row['client_lastname']);
                        array_push($orderNameArray, $row['client_email']);
                        array_push($orderNameArray, $row['client_phone']);
                    } 
            

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

            <div id="test" class="container">
                <div class="row">
                    <div class="col">
                            <button onclick="toggleOrderSearch()" id="OrderSearch" class="homeButton">Search</button>
                    </div>

                    <div class="col">
                            <button onclick="toggleOrderAddName()" id="OrderAddName" class="homeButton">Add</button>
                    </div>

                    <div class="col">
                            <button onclick="toggleDelete()" id="orderDelete" class="homeButton">Delete</button>
                    </div>
                </div>
            </div>
            <br>
            <br>

            

            <!----------- SEARCH Order code -------------->
            <div id='orderSearchForm' style='display:none;'>
                <h2>Order Search</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Order Search" name="orderSearch">

                    <label for="order_type">Search by payment type:</label>
                    <br>
                    <select id="order_type" name="order_type">
                        <option value="">Select</option>
                        <option value="Online">Online</option>
                        <option value="Credit">Credit</option>
                        <option value="Cash">Cash</option>
                    </select>
                    <br>
                    <p>Search by order date:</p>
                    <label for="month">Month</label>
                    <select id="month" name="month">
                        <option value=""></option>
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
                    <label for="day">Day</label>
                    <select id="day" name="day">
                        <option value=""></option>
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
                    <label for="year">Year</label>
                    <select id="year" name="year">
                        <option value=""></option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>

            <?php 
                if(count($orderArray) > 0){
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

                $orderArrayCount = count($orderArray);

                for ($x = 0; $x <= $orderArrayCount; $x++) {
                    echo "<tr>";
                    echo "<td>$orderArray[$x]</td>"; 
                    $x++;
                    echo "<td>$orderArray[$x]</td>"; 
                    $x++;
                    echo "<td>$orderArray[$x]</td>"; 
                    $x++;
                    echo "<td>$orderArray[$x]</td>"; 
                    echo "</tr>"; 
                }
                  
                echo    "</tbody>";
                echo "</table>";
            ?>

            <!------------ ADD Order Code -------------------------------->
            <div id="orderAddName" style="display:none;">
                <h3>Enter name of client for new order</h3>
                <form id="form_orderAddName" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Order Add Name" name="orderAddName">
            
                    <div class="form-group">
                        <label for="Addorder_firstname">First Name:</label>
                        <?php if(isset($_SESSION['Addorder_firstname'])): ?>
                        <input type="text" class="form-control" id="Addorder_firstname" name="Addorder_firstname" value="<?php echo $_SESSION['Addorder_firstname']?>" required>
                        <?php else: ?>
                        <input type="text" class="form-control" id="Addorder_firstname" name="Addorder_firstname" required>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="Addorder_lastname">Last Name:</label>
                        <?php if(isset($_SESSION['Addorder_lastname'])): ?>
                        <input type="text" class="form-control" id="Addorder_lastname" name="Addorder_lastname" value="<?php echo $_SESSION['Addorder_lastname']?>" required>
                        <?php else: ?>
                        <input type="text" class="form-control" id="Addorder_lastname" name="Addorder_lastname" required>
                        <?php endif; ?>
                    </div>
                    <!-- Submitting this form triggers client info to show so it can be confirmed -->
                    <button type="submit" class="btn-lg btn-primary">Proceed With Order</button>

                </form>
            </div>

            <!---------- ADD Order - Confirm Client code -------------->
            <form id="form_orderAddConfirmClient" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Confirm Client" name="orderAddConfirmClient">
                <?php 
                    if(isset($_POST['Addorder_firstname']) || isset($_POST['Addorder_lastname'])){
                        echo "<h3>After verifying client information, check the box and then select <q>Confirm Client</q></h3>";
                        
                        $orderNameArrayCount = count($orderNameArray);

                        for ($x = 0; $x <= $orderNameArrayCount; $x++) {
                            echo "<div class='form-check'>";
                            echo    "<label class='form-check-label'>";
                            echo        "<input type='checkbox' class='form-check-input' name='clientSelect' value=$orderNameArray[$x]><strong>Select this client:</strong>"; //first value of $orderNameArray = client_id
                            echo    "</label>";
                            $x++;
                            echo    "<p>$orderNameArray[$x] "; //2nd value is first name
                            $x++;
                            echo    $orderNameArray[$x] . "<br>"; //3rd value is last name
                            $x++;
                            echo    $orderNameArray[$x] . "<br>"; // 4th value is email
                            $x++;
                            echo    $orderNameArray[$x]; // 5th value is phone
                            $x++;
                            echo "</div>"; 
            
                        }
                        echo "<button type='submit' class='btn-lg btn-primary'>Confirm Client</button>";
                    }
                ?>
            </form>

            <!-------- ADD Order - Details code ----------------->
            <?php
                if(isset($_POST['clientSelect'])) {
                    $confirmedClientId = $_SESSION['Addorder_clientId'];
                    $confirmedFirstname = $_SESSION['Addorder_firstname'];
                    $confirmedLastname = $_SESSION['Addorder_lastname'];

                    $query = "INSERT INTO public.orderitem (client_id) VALUES (:confirmedClientId)";
                
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':confirmedClientId', $confirmedClientId, PDO::PARAM_INT);
                    $stmt->execute();

                    $last_orderitem_id = $db->lastInsertId();
                    $_SESSION['last_orderitem_id'] = $last_orderitem_id;
                    //echo "last orderitemID " . $_SESSION['last_orderitem_id'];


                    echo "<div id='orderAddForm'>";
                } else {
                    echo "<div id='orderAddForm' style='display:none;'>";
                }

                if(isset($_POST['Addorder_type'])){ 
                
                    $AddOrderType = htmlspecialchars($_POST['Addorder_type']);
                    $AddOrderMonth = htmlspecialchars($_POST['add_month']);
                    $AddOrderDay = htmlspecialchars($_POST['add_day']);
                    $AddOrderYear = htmlspecialchars($_POST['add_year']);
                    $AddOrder_OrderItemId = $_SESSION['last_orderitem_id'];
    
                    $AddOrderDate = $AddOrderYear . "-" . $AddOrderMonth . "-" . $AddOrderDay;
                    //echo $AddOrderDate;
                    
                    $query = "INSERT INTO public.order (order_date, order_type, orderitem_id) VALUES (:AddOrderDate, :AddOrderType, :AddOrder_OrderItemId)";
                    
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':AddOrderDate', $AddOrderDate, PDO::PARAM_STR);
                    $stmt->bindValue(':AddOrderType', $AddOrderType, PDO::PARAM_STR);
                    $stmt->bindValue(':AddOrder_OrderItemId', $AddOrder_OrderItemId, PDO::PARAM_INT);
                    $stmt->execute();
    
                    $last_order_id = $db->lastInsertId();
                    $_SESSION['last_order_id'] = $last_order_id;
                    //echo "last orderId " . $_SESSION['last_order_id'];

                    echo "<h3>Order added for " . $_SESSION['Addorder_firstname'] . " " . $_SESSION['Addorder_lastname'];
                }
            ?>
                <h2>Add Order for <?php echo $_SESSION['Addorder_firstname'] . " " . $_SESSION['Addorder_lastname'] ?></h2>
                <form id="form_orderAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Order Add" name="orderAdd">
                    
                    <div class="form-group">
                        <p>Select Order Date:</p>
                        <label for="add_month">Month</label>
                        <select id="add_month" name="add_month">
                            <option value=""></option>
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
                        <label for="add_day">Day</label>
                        <select id="add_day" name="add_day">
                            <option value=""></option>
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
                        <label for="add_year">Year</label>
                        <select id="add_year" name="add_year">
                            <option value=""></option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                        <br>
                    </div>
                
                    <div class="form-group">
                        <label for="Addorder_type">Select order type to add:</label>
                        <br>
                        <select id="Addorder_type" name="Addorder_type" required>
                            <option value="">Select</option>
                            <option value="Online">Online</option>
                            <option value="Cash">Cash</option>
                            <option value="Credit">Credit</option>
                        </select>
                    </div>

                    <button type='submit' class='btn-lg btn-primary'>Place Order</button>
                </form>
            </div>

            <!------------ DELETE Order Code -------------------------------->
            <?php
            if(isset($_POST['Deleteorder_firstname']) || isset($_POST['Deleteorder_lastname'])){
                
                if(isset($_POST['Deleteorder_firstname'])){
                    $deleteOrder_firstname = htmlspecialchars($_POST['Deleteorder_firstname']);
                }
                
                if(isset($_POST['Deleteorder_lastname'])){
                    $deleteOrder_lastname = htmlspecialchars($_POST['Deleteorder_lastname']);
                }

                $statement = $db->prepare("SELECT order_type, order_date, public.orderitem.client_id, client_firstname, client_lastname FROM public.order INNER JOIN public.orderitem ON public.order.orderitem_id = public.orderitem.orderitem_id INNER JOIN public.client ON public.orderitem.client_id = public.client.client_id WHERE public.orderitem.client_id = public.client.client_id");
                $statement->execute();

 
                $deleteOrderArray = array();

                // Go through each result
                while ($row = $statement->fetch(PDO::FETCH_ASSOC))
                {
                // The variable "row" now holds the complete record for that
                // row, and we can access the different values based on their
                // name
                $Delete_clientId = $row['public.orderitem.client_id'];

                $DeleteOrder_type = $row['order_type'];
                $DeleteOrder_date = $row['order_date'];
                $Delete_firstname = $row['client_firstname'];
                $Delete_lastname = $row['client_lastname'];

                

                //echo "<p><strong>$firstname $lastname $email $phone</strong><p>";

                if($deleteOrder_firstname == $row['client_firstname'] || $deleteOrder_lastname == $row['client_lastname']) {
                    array_push($deleteOrderArray, $row['public.orderitem.client_id']);
                    array_push($deleteOrderArray, $row['order_type']);
                    array_push($deleteOrderArray, $row['client_firstname']);
                    array_push($deleteOrderArray, $row['client_lastname']);
                    array_push($deleteOrderArray, $row['order_date']);

                    $confirmedDelOrderFN = $_SESSION['Deleteorder_firstname'];
                    $confirmedDelOrderLN = $_SESSION['Deleteorder_lastname'];
                    }
                
                } 

                
            }
            ?>

            <div id="deleteOrder" style="display:none;">
                <h3>Enter name of client to delete order</h3>
                <form id="form_orderDelete" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Order Delete" name="orderDelete">
            
                    <div class="form-group">
                        <label for="Deleteorder_firstname">First Name:</label>
                        <?php if(isset($_SESSION['Deleteorder_firstname'])): ?>
                        <input type="text" class="form-control" id="Deleteorder_firstname" name="Deleteorder_firstname" value="<?php echo $_SESSION['Deleteorder_firstname']?>" required>
                        <?php else: ?>
                        <input type="text" class="form-control" id="Deleteorder_firstname" name="Deleteorder_firstname" required>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="Deleteorder_lastname">Last Name:</label>
                        <?php if(isset($_SESSION['Deleteorder_lastname'])): ?>
                        <input type="text" class="form-control" id="Deleteorder_lastname" name="Deleteorder_lastname" value="<?php echo $_SESSION['Deleteorder_lastname']?>" required>
                        <?php else: ?>
                        <input type="text" class="form-control" id="Deleteorder_lastname" name="Deleteorder_lastname" required>
                        <?php endif; ?>
                    </div>
                    <!-- Submitting this form triggers order info to show so it can be confirmed -->
                    <button type="submit" class="btn-lg btn-primary">Proceed With Delete Order</button>

                </form>
            </div>

            <!---------- DELETE Order - Confirm Order code -------------->
            <form id="form_orderDeleteConfirm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Confirm Delete" name="orderDeleteConfirm">
                <?php 
                    if(isset($_POST['deleteOrderSelect'])) {
                        $_SESSION['deleteOrderSelect'] = $_POST['deleteOrderSelect'];
                        echo "It is set";
                    } 

                    if(isset($_POST['Deleteorder_firstname']) || isset($_POST['Deleteorder_lastname'])){
                        echo "<h3>After verifying order information, check the box and then select <q>Confirm Delete</q></h3>";
                        
                        $deleteOrderArrayCount = count($deleteOrderArray);

                        if(count($deleteOrderArray) > 0){
                            echo "<h3>Order results for " . $confirmedDelOrderFN . " " . $confirmedDelOrderLN . "</h3>";
                            echo "<table class='table table-bordered'>";
                            echo "<thead>";
                            echo    "<tr>";
                            echo        "<th>Order Select</th>";
                            echo        "<th>Order Type</th>";
                            echo        "<th>First Name</th>";
                            echo        "<th>Last Name</th>";
                            echo        "<th>Order Date</th>";
                            echo    "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                        }
        
                        for ($x = 0; $x <= $deleteOrderArrayCount; $x++) {
                            /*
                            echo "<div class='form-check'>";
                            echo    "<label class='form-check-label'>";
                            echo        "<input type='checkbox' class='form-check-input' name='deleteOrderSelect' . $x value=$orderDeleteArray[$x]><strong>Select this order:</strong>"; //first value of $orderDeleteArray = orderitem_client_id
                            echo    "</label>";
                            echo "</div>";
                            */
                            
                            echo "<tr>";
                            echo "<td>" . "     " . "<input type='checkbox' class='form-check-input' name='deleteOrderSelect' value='testValue'><strong>Select this order:</strong></td>";
                            $x++;
                            echo "<td>$deleteOrderArray[$x]</td>"; 
                            $x++;
                            echo "<td>$deleteOrderArray[$x]</td>"; 
                            $x++;
                            echo "<td>$deleteOrderArray[$x]</td>"; 
                            $x++;
                            echo "<td>$deleteOrderArray[$x]</td>"; 
                            echo "</tr>"; 
                        }
                          
                        echo    "</tbody>";
                        echo "</table>";

                        echo "<button type='submit' class='btn-lg btn-primary'>Delete Order</button>";

                        
                        
                    }
                ?>
            </form>

            <!-------- DELETE Order - Details code ----------------->
            <?php
            
            
                
                
                if(isset($_SESSION['deleteOrderSelect'])) {
                    echo "It is set Part 2";
                    /*
                    $confirmedDeleteClientId = $_SESSION['Addorder_clientId'];
                    $confirmedFirstname = $_SESSION['Addorder_firstname'];
                    $confirmedLastname = $_SESSION['Addorder_lastname'];

                    $query = "INSERT INTO public.orderitem (client_id) VALUES (:confirmedClientId)";
                
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':confirmedClientId', $confirmedClientId, PDO::PARAM_INT);
                    $stmt->execute();

                    $last_orderitem_id = $db->lastInsertId();
                    $_SESSION['last_orderitem_id'] = $last_orderitem_id;
                    //echo "last orderitemID " . $_SESSION['last_orderitem_id'];


                    echo "<div id='orderAddForm'>";
                } else {
                    echo "<div id='orderAddForm' style='display:none;'>";
                }*/
                } else {
                    echo "It is not set Part 2";
                }
            
            ?>

        </main>
        <script src="project1.js"></script>
    </body>

</html>