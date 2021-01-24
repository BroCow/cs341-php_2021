<?php
    session_start();
?>


<?php
    echo $_POST['firstName'] . "<br>";
    echo $_POST['lastName'] . "<br>";
?>
    <a href="mailto:<?php echo $_POST['email']?>">Send email</a>
    <br>

<?php
    echo $_POST['major'] . "<br>";
?>

<br>
 
<?php
    echo $_POST['comments'] . "<br>";
    if(isset($_POST['cont1'])) {
        echo $_POST['cont1'] . "<br>";
    }
    if(isset($_POST['cont2'])) {
        echo $_POST['cont2'] . "<br>";
    }
    if(isset($_POST['cont3'])) {
        echo $_POST['cont3'] . "<br>";
    }
    if(isset($_POST['cont4'])) {
        echo $_POST['cont4'] . "<br>";
    }
    if(isset($_POST['cont5'])) {
        echo $_POST['cont5'] . "<br>";
    }
    if(isset($_POST['cont6'])) {
        echo $_POST['cont6'] . "<br>";
    }
    if(isset($_POST['cont7'])) {
        echo $_POST['cont7'] . "<br>";
    }
    
?>

