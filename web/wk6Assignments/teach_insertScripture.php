<?php
    require('dbConnect.php');
    $db = get_db();

    $stmt = $db->prepare('SELECT s.id, t.id, book, chapter, verse, content, name FROM scriptures s
    INNER JOIN topic t ON s.id = t.id;');
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <div class="form-group">
                <label for="book">Book:</label>
                <input class="form-control" type="text" name="book">
            </div>
            <div class="form-group">
                <label for="chapter">Chapter:</label>
                <input class="form-control" type="text" name="chapter">
            </div>
            <div class="form-group">
                <label for="verse">Verse:</label>
                <input class="form-control" type="text" name="verse">
            </div>
            <div class="form-group">
                <label for="content">Scripture:</label>
                <textarea class="form-control" name="content"></textarea>
            </div>
            
            <p>Select a topic below that corresponds with the scripure</p>
            <?php foreach($rows as $row){
                $scripture_id = $row['id'];
                $topic_id = $row['id'];
                $book = $row['book'];
                $chapter = $row['chapter'];
                $verse = $row['verse'];
                $content = $row['content'];
                $name = $row['name'];

                echo "<div class='form-check'>";
                echo "<label class='form-check-label' for='topic'>";
                echo "<input type='checkbox' class='form-check-input' name='topic' value='<?php echo $topic ?>'>$topic";
                echo "</label>";
                echo "</div>";
            }
            ?>
            <input type="hidden" name="scripture_id" value="<?php ; ?>">
            <input type="submit" value="Add Scripture">
        </form>
        
    </body>
</html>