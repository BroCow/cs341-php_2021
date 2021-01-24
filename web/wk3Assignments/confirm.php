<!--------- CONFIRMATION PAGE NOTES ---------------

After completing the purchase from the checkout page, the user is shown a confirmation page. 
It should display all the items they have just purchased as well as the address to which it will be shipped.

Make sure to check for malicious injection, especially from free-entry fields like the address.
-->
<?php
    session_start();
?>
<?php
$firstName = $lastName = $address = $city = $state = $zip = $email = $phone = "";
$firstNameErr = $lastNameErr = $addressErr = $cityErr = $stateErr = $zipErr = $emailErr = $phoneErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST['firstName'])){
        $firstNameErr = "Name is required";
    } else {
        $firstName = test_input($_POST["firstName"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {
            $firstNameErr = "Only letters and white space allowed";
          }
    }

    if (empty($_POST["lastName"])) {
        $nameErr = "Last name is required";
    } else {
        $lastName = test_input($_POST["lastName"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$lastName)) {
            $lastNameErr = "Only letters and white space allowed";
          }
    }

    if (empty($_POST["address"])) {
        $nameErr = "Address is required";
    } else {
        $address = test_input($_POST["address"]);
    }

    if (empty($_POST["city"])) {
        $nameErr = "City is required";
    } else {
        $city = test_input($_POST["city"]);
    }

    if (empty($_POST["state"])) {
        $nameErr = "State is required";
    } else {
        $state = test_input($_POST["state"]);
    }

    if (empty($_POST["zip"])) {
        $nameErr = "Zip code is required";
    } else {
        $zip = test_input($_POST["zip"]);
    }

    if (empty($_POST["email"])) {
        $nameErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    $phone = test_input($_POST["phone"]);

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="author" content="Christopher Cowan">
        <meta name="description" content="This page serves as the Confirmation page for CSE341 Shopping Cart Assignment.">
        <title>CSE 341 Shopping Cart | Confirmation</title>
        <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="normalize.css" media="screen">
        <link rel="stylesheet" href="shopCart.css" media="screen">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <body>
        <header>
            This will be the header
        </header>

        <nav>
            This will be navigation
        </nav>

        <main>
            <h2>Thanks for your order, <?php echo $_POST['firstName']; ?>!</h2>

            <h4>Below are your items that are on their way</h4>
    
            <div class="container">
                <h4>Order Summary</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Purchased Items</th>
                            <th>Item Price</th>
                            <th>Quantity</th>
                            <th>Item Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($_SESSION['itemSelectedArray'] as $value) {
                            echo "<tr>";
                                echo "<td>" . $value . "</td>";
                                echo "<td>20</td>";
                                echo "<td>1</td>";
                                echo "<td>20</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            /*foreach ($_SESSION['itemSelectedArray'] as $value) {
                echo ""
                echo "<p id='iBorder'>" . $value . "</p>";
            }*/
            ?>
         
            
            
            <h4>Items will be sent to the following address, and we will contact you using the email and phone number listed</h4>
            <h4>Customer Information</h4>
            <p>
                <?php echo $_POST['firstName'] . " " . $_POST['lastName'] ?>
                <br>
                <?php echo $_POST['email'] ?>
                <br>
                <?php echo $_POST['phone'] ?>
            </p>
            <p>
                <?php echo $_POST['address'] ?>
                <br>
                <?php echo $_POST['city'] . ", " . $_POST['state'] . "  " . $_POST['zip'] ?>
            </p>
                
            <?php
                // remove all session variables
                session_unset();

                // destroy the session
                session_destroy();
            ?>

            <form action="browseItems.php">
                <button class="btn btn-secondary btn-sm" type="submit">Return to Home Page</button>
            </form>

                 

            
        </main>
    </body>
</html>