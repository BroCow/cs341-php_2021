<?php
    require('dbConnect.php');
    $db = get_db();

    //$scripture_id = htmlspecialchars($_POST['scripture_id']);

    //$stmt = $db->prepare('INSERT INTO scripture_topic(course_id, content) VALUES (:course_id, :content);');
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