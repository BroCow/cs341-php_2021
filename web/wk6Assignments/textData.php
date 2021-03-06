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


            if(isset($_POST['Addorder_type'])){ 
                
                $AddOrderType = htmlspecialchars($_POST['Addorder_type']);
                $AddOrderMonth = htmlspecialchars($_POST['add_month']);
                $AddOrderDay = htmlspecialchars($_POST['add_day']);
                $AddOrderYear = htmlspecialchars($_POST['add_year']);

                $AddOrderDate = $AddOrderYear . "-" . $AddOrderMonth . "-" . $AddOrderDay;
                echo $AddOrderDate;
                
                $query = "INSERT INTO public.order (order_date, order_type) VALUES (:AddOrderDate, :AddOrderType)";
                
                $stmt = $db->prepare($query);
                $stmt->bindValue(':AddOrderDate', $AddOrderDate, PDO::PARAM_STR);
                $stmt->bindValue(':AddOrderType', $AddOrderType, PDO::PARAM_STR);
                $stmt->execute();

                $last_order_id = $db->lastInsertId();
                echo $last_order_id;
            }

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
                            <button onclick="toggleOrderDelete()" id="orderDelete" class="homeButton">Delete</button>
                    </div>
                </div>
            </div>
            <br>
            <br>
            
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
                if(isset($_POST['clientSelect'])) {
                    $confirmedFirstname = $_SESSION['Addorder_firstname'];
                    $confirmedLastname = $_SESSION['Addorder_lastname'];
                    echo "<div id='orderAddForm'>";
                } else {
                    echo "<div id='orderAddForm' style='display:none;'>";
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
                </form>
            </div>

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
            
            
            <br>
            <br>
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
        

        </main>
        <script src="project1.js"></script>
    </body>

</html>