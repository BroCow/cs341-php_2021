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
  <title>Document</title>
</head>

<body>
  <h1>Scripture Resources</h1>

  <?php
    $statement = $db->prepare("SELECT book, chapter, verse, content FROM scripture");
    $statement->execute();

    // Go through each result
    while ($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      // The variable "row" now holds the complete record for that
      // row, and we can access the different values based on their
      // name
      $book = $row['book'];
      $chapter = $row['chapter'];
      $verse = $row['verse'];
      $content = $row['content'];

      echo "<p><strong>$book $chapter:$verse</strong> - \"$content\"<p>";
    }
  ?>


  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="search"></label>
    <input type="text" name="search">
    <input type="submit" name="submit" value="Submit">
  </form>
  
</body>

</html>