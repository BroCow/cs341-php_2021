


<!DOCTYPE html>
<html>
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

<main>
<?php
try {
  // default Heroku Postgres configuration URL
  // this is a built in function in php to get the value from an enviornment variable
  $dbUrl = getenv('DATABASE_URL');

  //if we are on heroku this will be set otherwise we can check for a local connection
  //heroku takes care of all of this for us
  if (!isset($dbUrl) || empty($dbUrl)) {
      // example localhost configuration URL with 
      // user: "my_username"
      // password: "my_password"
      // database: "my_database"

      // hardcoded for debugging only not for production site
      $dbUrl = "postgres://my_username:my_password@localhost:5432/my_database";
  }

  // Get the various parts of the DB Connection from the URL
  $dbopts = parse_url($dbUrl);

  $dbHost = $dbopts["host"];
  $dbPort = $dbopts["port"];
  $dbUser = $dbopts["user"];
  $dbPassword = $dbopts["pass"];
  $dbName = ltrim($dbopts["path"],'/');

  // Create the PDO connection
  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  // this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
  $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  //Now we can use $db->
  $statement = $db->prepare('SELECT id, book, chapter, verse, content FROM scriptures');
  $statement->execute();

  // Go through each result
  while ($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
      echo $row['id'];
      // Code below added for team activity
      $display = "<strong>Book:  $row[book] Chapter: $row[chapter] Verse: $row[verse]</strong>";
      $display .= " - '$row[content]'";
  }
}
catch (PDOException $ex) {
  // for debugging only not for production site
  echo "Error connecting to DB. Details: $ex";
  die();
}

// return $db;

?>

<h1>Scripture Resources</h1>

<form method="post" action="scriptures.php">
  <label for="book"></label>
  <input type="text" name="book">
  <input type="submit" name="submit" value="Submit">
</form>

<?php echo $display; ?>


</main>


</html>