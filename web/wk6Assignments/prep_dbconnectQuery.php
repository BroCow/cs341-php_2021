<?php
require('dbConnect.php');
$db = get_db();

//$stmt = $db->prepare('SELECT * FROM table WHERE id=:id AND name=:name');
//$stmt->bindValue(':id', $id, PDO::PARAM_INT);
//$stmt->bindValue(':name', $name, PDO::PARAM_STR);
//$stmt->execute();
//$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = 'SELECT id, code, name FROM course';
$stmt = $db->prepare($query);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Courses</title>
    </head>
    <body>
        <h1>Courses</h1>

        <ul>
            <li><p></p></li>
            <li><p></p></li>
        </ul>

        <?php
        foreach ($courses as $course) {
            $id = $course['id'];
            $code = $course['code'];
            $name = $course['name'];
            echo "<li><p>$code - $name</p></li>";
        }
        ?>
    </body>
</html>