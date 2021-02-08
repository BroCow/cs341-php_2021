<?php
    require('dbConnect.php');
    $db = get_db();

    $stmt = $db->prepare('SELECT name FROM topic;');
    $stmt->execute();

    $name_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Insert Scripture</title>
    </head>
    <body>
        <h1>Insert Scripture and Topic</h1>

        
        
        <form method="post" action="scripture_topic.php">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
            <input type="text" name="book">
            <input type="text" name="chapter">
            <input type="text" name="verse">
            <textarea name="content"></textarea>

            <p>Select a topic below that corresponds with the scripure</p>
            <?php foreach($name_rows as $name_row){
                $topic = $name_row['name'];
                echo "<input type='checkbox' name='topic' value='<?php echo $topic ?>'>";
                echo "<label for='topic'>'<?php echo $topic ?>'</label>";
            }
            ?>

            <input type="submit" value="Add Scripture">
        </form>
        
    </body>
</html>