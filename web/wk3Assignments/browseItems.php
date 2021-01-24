<!--------- BROWSE ITEMS PAGE NOTES ---------------

On the browse items page, the user sees a list of items they can add to their cart and purchase. 
Again, the kind of items and the formatting of this page is up to you.

You should provide a button or link to add an item to the cart. 
Doing so should store that item in some way to the session, and then keep the user on the browse page.
-->
<?php
    session_start();
?>
<?php
    $_SESSION['itemArray'] = array("Necklace", "Earrings", "Bracelet", "Pendant");
    $itemArrayCount = count($_SESSION['itemArray']);

    $necklace = "<p><img src='necklace1.jpg'></p>";
    $earrings = "<p><img src='necklace3.jpg'></p>";
    $bracelet = "<p><img src='bracelet.png'></p>";
    $pendant = "<p><img src='profile_pic.jpg'></p>";

    $image = array($necklace, $earrings, $bracelet, $pendant);
    $x = 0;

    $itemSelectedArray = array();
    $_SESSION['itemSelectedArray'] = $itemSelectedArray;

    $_SESSION['itemsInCart'] = count($_SESSION['itemSelectedArray']);

    if(isset($_POST[$value])){
        $_SESSION[$value] = $_POST[$value];
    }
?>
<!DOCTYPE html>
<html lang="en">
 
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="author" content="Christopher Cowan">
        <meta name="description" content="This page serves as the Browse Items page for CSE341 Shopping Cart Assignment.">
        <title>CSE 341 Shopping Cart | Browse Items</title>
        <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="/web/wk3Assignments/normalize.css" media="screen">
        <link rel="stylesheet" href="shopCart.css" media="screen">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <header>
        <h1>Shopping Cart Assignment - CSE 341</h1>
    </header>
 
    <nav>
        <h2>This is the navigation</h2>
    </nav>

    <body>
        <main>
            <h3>Select From Items Below</h3>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" title="Item Selection Form" name="itemSelectForm">
                <?php
                    echo "<div class='row'>";
                        foreach ($_SESSION['itemArray'] as $value) {  
                            echo "<div class='col-sm-3'>";
                                echo "<div class='form-check-inline'>";
                                    echo "<label class='form-check-label'>";
                                    echo $image[$x];
                                    if(isset($_SESSION[$value])){
                                        echo "<input type='checkbox' class='form-check-input' id='necklace' name=$value  value=$value checked='checked'>" . $value;
                                    } else {
                                        echo "<input type='checkbox' class='form-check-input' id='necklace' name=$value  value=$value>" . $value;
                                    }
                                    
                                    /*echo "<input type='checkbox' class='form-check-input' id='necklace' name=$value  value=$value>" . $value;*/
                                    echo "</label>";
                                echo "</div>";
                            echo "</div>";
                            $x++;
                            /* If statement pushes selected items to array that is saved as a SESSION variable so it available on other pages */
                            if(isset($_POST[$value])){
                                array_push($_SESSION['itemSelectedArray'], $_POST[$value]);
                                $_SESSION[$value] = $_POST[$value];
                            }
                        }
                    echo "</div>";
                ?>
                <!-- Add to Cart button posts form data to this page -->
                <p>
                <br>
                    <button type="submit" class="btn btn-primary">Add Items to Cart</button>
                </p>
            </form>

            <p>
                <?php
                    $_SESSION['itemsInCart'] = count($_SESSION['itemSelectedArray']);
                    if($_SESSION['itemsInCart']>0){
                        echo "<form action='viewCart.php' method='POST' title='View Cart' name='viewCartForm'>";
                        echo "<button type='submit' class='btn btn-success' href='viewCart.php'>View Cart</button>";
                        echo "<p>" . ($_SESSION['itemsInCart']) . " item(s) in cart";
                        echo "</form>";
                    } else if(isset($_SESSION['cartCountUpdate'])){ 
                        if($_SESSION['cartCountUpdate']>0) {
                            echo "<form action='viewCart.php' method='POST' title='View Cart' name='viewCartForm'>";
                            echo "<button type='submit' class='btn btn-success' href='viewCart.php'>View Cart</button>";
                            echo "<p>" . ($_SESSION['cartCountUpdate']) . " item(s) in cart";
                            echo "</form>";
                        }
                    } else {
                        echo "<p>Cart Empty</p>";
                    }
                    
                        
                    
                ?>
            </p>
        </main>
    </body>
</html>