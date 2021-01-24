<!DOCTYPE html>

<html>

<head>
</head>

<body>
    <main>
        <label>Name:
            <?php
            $name = $_POST['name'];
            echo $name;
            ?>
        </label>
        <br>
        <label>Email:
            <?php
            $email = $_POST['email'];
            echo "<a href='mailto:" . $email . "'>" . $email . "</a>";
            ?>
        </label>
        <br>
        <label>Major:
            <?php

            $major = $_POST['major'];
            echo $major;
            ?>
        </label>
        <br>
        <label>Comments:
            <?php
            $comments = $_POST['comments'];
            echo $comments;
            ?>
        </label>
        <label>Continents Visited:
            <?php
            if(isset($_POST['cont1'])){
                echo "cont1: " . $_POST["cont1"];
            }
            echo "cont2: " . $_POST["cont2"];
            echo "cont3: " . $_POST["cont3"];
            echo "cont4: " . $_POST["cont4"];
            echo "cont5: " . $_POST["cont5"];
            echo "cont6: " . $_POST["cont6"];
            echo "cont7: " . $_POST["cont7"];
            ?>
        </label>
    </main>
</body>

</html>