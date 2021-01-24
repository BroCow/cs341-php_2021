<!--------- CHECKOUT PAGE NOTES ---------------

The checkout page should ask the user for the different components of their address. 
(No credit card or other purchase information is collected, only an address.)

It should have the option to complete the purchase or return to the cart.
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
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
          }
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
        <meta name="description" content="This page serves as the Checkout page for CSE341 Shopping Cart Assignment.">
        <title>CSE 341 Shopping Cart | Checkout</title>
        <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="normalize.css" media="screen">
        <link rel="stylesheet" href="shopCart.css" media="screen">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <header>
        <h1>Checkout</h1>
        <!-- Create PHP Header to be used on all views -->
    </header>

    <nav>
        <h2>This will be navigation</h2>
        <!-- Create PHP Nav to be used on all views -->
    </nav>

    <body>
        
        <main>
            <!-- Form for user to enter customer info -->
            <div class="row">
                <div class="col">
                    <div class="container">
                        <form title="Customer Information" id="custInfo" name="custInfo" action="confirm.php" method="post">
                            <h3>Customer Information</h3>
                            
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input class="form-control" name="firstName" type="text" placeholder="Enter first name" required>
                                <span class="error"><?php echo $firstNameErr;?></span>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input class="form-control" id="lastName" name="lastName" type="text" placeholder="Enter last name" required>
                                <span class="error"><?php echo $lastNameErr;?></span>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control" id="address" name="address" type="text" placeholder="Enter street address" required>
                                <span class="error"><?php echo $addressErr;?></span>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input class="form-control" id="city" name="city" type="text" placeholder="Enter city name" required>
                                <span class="error"><?php echo $cityErr;?></span>
                            </div>
                            <div class="form-group">
                                <label for="state">State</label>
                                <select class="form-control" id="selectState" name="state" required>
                                    <option></option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="zip">Zip Code</label>
                                <input class="form-control" id="zip" name="zip" type="number" placeholder="5-digit zip code" required>
                                <span class="error"><?php echo $zipErr;?></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="email" placeholder="your.email@address.com" required>
                                <span class="error"><?php echo $emailErr;?></span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="form-control" id="phone" name="phone" type="tel" placeholder="###-###-####" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                            </div>
                            <button class="btn btn-success" id="placeOrderButton" type="submit" value="placeOrder">Place your order</button>
                            <p>By placing your order, you agree to our privacy notice and conditions of use</p>
                        </form>
                    </div>
                </div>
 
            </div>
            <form action="viewCart.php">
                <button class="btn btn-secondary btn-sm" type="submit">Return to Cart</button>
            </form>
        </main>

        <footer>
        </footer>

        <script src="js_checkout.js"></script>
    </body>
</html>