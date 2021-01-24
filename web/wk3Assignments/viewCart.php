<!--------- VIEW CART PAGE NOTES ---------------

Your browse page should contain a link to view the cart. 
On the view cart page, the user can see all the items that are in their cart. 
Provide a way to remove individual items from the cart.

The view cart page should have a link to return to the browse page for more shopping 
and a link to continue to the checkout page.
-->
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="author" content="Christopher Cowan">
        <meta name="description" content="This page serves as the View Cart page for CSE341 Shopping Cart Assignment.">
        <title>CSE 341 Shopping Cart | View Cart</title>
        <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="normalize.css" media="screen">
        <link rel="stylesheet" href="shopCart.css" media="screen">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <header>
        <h1>View Cart</h1>
    </header>
 
    <nav>
        <h2>This is the navigation</h2>
    </nav>
 
    <body>
        <?php
            if(isset($_POST['unsetNecklace'])) {
                unset($_SESSION['Necklace']);  
                if (($key = array_search('Necklace', $_SESSION['itemSelectedArray'])) !== false) {
                    unset($_SESSION['itemSelectedArray'][$key]);
                }     
                $_SESSION['itemsInCart'] = count($_SESSION['itemSelectedArray']); 
            }
            if(isset($_POST['unsetEarrings'])) {
                unset($_SESSION['Earrings']);  
                if (($key = array_search('Earrings', $_SESSION['itemSelectedArray'])) !== false) {
                    unset($_SESSION['itemSelectedArray'][$key]);
                }   
                $_SESSION['itemsInCart'] = count($_SESSION['itemSelectedArray']);   
            }
            if(isset($_POST['unsetBracelet'])) {
                unset($_SESSION['Bracelet']);  
                if (($key = array_search('Bracelet', $_SESSION['itemSelectedArray'])) !== false) {
                    unset($_SESSION['itemSelectedArray'][$key]);
                }     
                $_SESSION['itemsInCart'] = count($_SESSION['itemSelectedArray']); 
            }
            if(isset($_POST['unsetPendant'])) {
                unset($_SESSION['Pendant']);  
                if (($key = array_search('Pendant', $_SESSION['itemSelectedArray'])) !== false) {
                    unset($_SESSION['itemSelectedArray'][$key]);
                }   
                $_SESSION['itemsInCart'] = count($_SESSION['itemSelectedArray']);   
            }

            $_SESSION['cartCountUpdate'] = $_SESSION['itemsInCart'];
        ?>
         
            



        <main>
            <h3>Your Cart Items are Below</h3>
            <?php echo $_SESSION['itemsInCart']; ?>
            <div class="row">
                <div class="col-sm-4">
                    <!--<div class="container">-->
                        <table class="table">
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
                    <!--</div>-->
                </div>

                <div class="col-sm-2">
                    <!--<div class="container">-->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Remove Item?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($_SESSION['Necklace'])): ?>
                                    <tr>            
                                        <td>                                       
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <input name="unsetNecklace" type="hidden" value="unsetNecklace">
                                                <button type="submit" class="btn btn-danger btn-sm">Remove Item</button>
                                            </form>
                                        </td>                   
                                    </tr>           
                                <?php endif ?>
                                <?php if(isset($_SESSION['Earrings'])): ?>
                                    <tr>            
                                        <td>                                       
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <input name="unsetEarrings" type="hidden" value="unsetEarrings">
                                                <button type="submit" class="btn btn-danger btn-sm">Remove Item</button>
                                            </form>
                                        </td>                   
                                    </tr>           
                                <?php endif ?>     
                                <?php if(isset($_SESSION['Bracelet'])): ?>
                                    <tr>            
                                        <td>                                       
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <input name="unsetBracelet" type="hidden" value="unsetBracelet">
                                                <button type="submit" class="btn btn-danger btn-sm">Remove Item</button>
                                            </form>
                                        </td>                   
                                    </tr>           
                                <?php endif ?>     
                                <?php if(isset($_SESSION['Pendant'])): ?>
                                    <tr>            
                                        <td>                                       
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <input name="unsetPendant" type="hidden" value="unsetPendant">
                                                <button type="submit" class="btn btn-danger btn-sm">Remove Item</button>
                                            </form>
                                        </td>                   
                                    </tr>           
                                <?php endif ?>     
                                        
                            </tbody>
                        </table>
                    <!--</div>-->
                </div>
            </div>
            <br>
            <br>
            <br>
            <form action="browseItems.php" method="post">
                <input name="continueShopping" type="hidden">
                <button type="submit" class="btn btn-secondary">Continue Shopping</button>
            </form>
            <br>
            <br>
            <form action="checkout.php">
                <button type="submit" class="btn btn-success">Checkout</button>
            </form>
            
        </main>
    </body>

</html>