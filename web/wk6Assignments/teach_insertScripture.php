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
                <textarea class="form-control" name="scripture"></textarea>
            </div>
            
            <p>Select a topic below that corresponds with the scripure</p>
            <?php foreach($name_rows as $name_row){
                $topic = $name_row['name'];
                echo "<div class='form-check'>";
                echo "<label class='form-check-label'>";
                echo "<input type='checkbox' class='form-check-input' name='cont1' value='<?php echo $topic ?>'>echo $topic";
                echo "</label>";
                echo "</div>";
            }
            ?>

            <input type="submit" value="Add Scripture">
        </form>
        
    </body>
</html>