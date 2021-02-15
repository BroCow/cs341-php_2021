<?php
    require('dbConnect.php');
    $db = get_db();

    $book = htmlspecialchars($_POST['book']);
    $chapter = htmlspecialchars($_POST['chapter']);
    $verse = htmlspecialchars($_POST['verse']);
    $content = htmlspecialchars($_POST['content']);
    $topic = htmlspecialchars($_POST['topic']);

    $stmt = $db->prepare('INSERT INTO scriptures (book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content);');
    $stmt->bindValue(':book', $course_id, PDO::PARAM_INT);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    //$stmt->execute();

    //$scriptureTopic_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h1>Scriptures and Topics</h1>

        <?php
            echo $_POST['book'];
            echo $_POST['chapter'];
            echo $_POST['verse'];
            echo $_POST['content'];
            echo $_POST['topic'];
        ?>

        
        
        
        
    </body>
</html>