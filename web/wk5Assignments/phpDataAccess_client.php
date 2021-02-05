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
        <meta name="description" content="This page serves as the PHP Data Access client page for CSE341 Project 1 Assignment.">
        <title>CSE 341 PHP Data Access | Client</title>
        <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="/web/wk3Assignments/normalize.css" media="screen">
        <link rel="stylesheet" href="project1.css" media="screen">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
            $statement = $db->prepare("SELECT client_firstname, client_lastname, client_email, client_phone FROM client");
            $statement->execute();

            if(isset($_POST['search'])){
            $bookSearch = $_POST['search'];
            }

            // Go through each result
            while ($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
            // The variable "row" now holds the complete record for that
            // row, and we can access the different values based on their
            // name
            $firstname = $row['client_firstname'];
            $lastname = $row['client_lastname'];
            $email = $row['client_email'];
            $phone = $row['client_phone'];

            if($bookSearch == $row['book']) {
                echo $row['book'] . "<br>";
                echo $row['content'] . "<br>";
                }
            }
    
            echo "<p><strong>$firstname $lastname $email $phone</strong><p>";
        ?>


        <main>
            <h1>Client Management</h1>

            <h2>Client Search</h2>

            <!-- Put buttons here to choose between single client or client list -->

            <!-- Put form here to enter client name to appear if "single client" selected -->

            <!-- Put form here to choose between single client or client list -->

            <div class="form-group">
                <label for="email">Email:</label>
                <?php if(isset($_SESSION['email'])): ?>
                <input type="text" class="form-control" placeholder="your_email@address.com" id="email" name="email" value="<?php echo $_SESSION['email']?>">
                <?php else: ?>
                <input type="text" class="form-control" placeholder="your_email@address.com" id="email" name="email">
                <?php endif; ?>
            </div>





        </main>
    

    </body>

</html>