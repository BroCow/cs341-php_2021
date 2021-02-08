<?php

$course_id = htmlspecialchars($_POST['course_id']);
$note_content = htmlspecialchars($_POST['note_content']);

echo "$course_id\n";
echo $note_content;


?>



<!DOCTYPE html>
<html>
    <head>
        <title>Course Notes</title>
    </head>
    <body>
        <h1>Course Notes for <?php echo $course_code ?></h1>

        <?php
        foreach ($note_rows as $note_row){
            $content = $note_row['content'];
            echo "<p>$content</p>";
        }
        ?>
        
        <form method="post" action="insert_note.php">
            <textarea name="note_content"></textarea>
            <input type="submit" value="Create Note">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
        </form>
        
    </body>
</html>