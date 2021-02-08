<?php

$course_id = htmlspecialchars($_POST['course_id']);
$content = htmlspecialchars($_POST['note_content']);


require('dbConnect.php');
$db = get_db();

$stmt = $db->prepare('INSERT INTO note(course_id, content) VALUES (:course_id, :content);');
$stmt->bindValue(':course_id', $course_id, PDO::PARAM_INT);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->execute();

/*
echo "$course_id\n";
echo $note_content;
*/

$new_page = "prep_coursenotes.php?course_id=$course_id";

header("Location: $new_page");
die();


?>



<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h1></h1>

        
        
        
        
    </body>
</html>