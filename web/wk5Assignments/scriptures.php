<?php
include 'connection.php';
//get_db() function created in connection.php
$db = get_db();

session_start();

$display = "<h1>Scripture Resources</h1>";

$statement = $db->prepare('SELECT id, book, chapter, verse, content FROM scriptures');
$statement->execute();

while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
  $display .= "<p><strong>Book: $row[book] Chapter: $row[chapter] Verse: $row[verse]</strong>";
  $display .= " - '$row[content]'</p>";
}

if (isset($_POST['search'])) {
  $searchBook = $_POST['search'];
  $strSql = 'SELECT id, book, chapter, verse, content FROM ta.scriptures WHERE book = :searchBook';
  $statement = $db->prepare($strSql);
  $statement->bindValue(':searchBook', $searchBook, PDO::PARAM_STR);
  $statement->execute();

  $displaySearch = "<h1>Scripture Search</h1>";
  /*
  while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $displaySearch .= "<a href='detail.php'><p><strong>Book: $row[book] Chapter: $row[chapter] Verse: $row[verse]</strong>";
    $displaySearch .= "'</p></a>";
    $_SESSION['scriptureId'] = $row['id'];
  }*/
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?
    echo $display;
  ?>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="search"></label>
    <input type="text" name="search">
    <input type="submit" name="submit" value="Submit">
  </form>
  <?
  if (isset($displaySearch)) {
    echo $displaySearch;
  }
  
  ?>
</body>

</html>