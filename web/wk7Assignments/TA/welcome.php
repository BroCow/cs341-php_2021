<?php
 if (!$_SESSION['loggedin']) {
  header('Location: /W7/ta/index.php');
  exit;
}  
if (isset($_SESSION['message'])) {$message = $_SESSION['message'];}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Welcome<?php echo $_SESSION['userData']['username'] ?></h1>
  <a href="#">
</body>
</html>