<!DOCTYPE html>

<html>
    <head>
    </head>

    <body>
        <main>
            <form action="Teamphp_form.php" method="post">
                <label>Name:</label>
                <input name="name" type="text">

                <label>Email:</label>
                <input name="email" type="email">

                <label>Major:</label>
                <input name="major" type="radio" value="Computer Science"><label>Computer Science</label>
                <input name="major" type="radio" value="Web Design and Development"><label>Web Design and Development</label>
                <input name="major" type="radio" value="Computer Information Technology"><label> Information Technology</label>
                <input name="major" type="radio" value="Computer Engineering"><label>Computer Engineering</label>

                <p>Stretch 1 - Below the majors are displayed using an array/loop</p>
                    <?php
                        $major = array("Computer Science (CS)", "Web Design and Development (WDD)", "Computer Information Technology (CIT)", "Computer Engineering (CE)");

                        foreach ($major as $value) {
                            echo "<label>";
                            echo "<input type='radio' class='form-check-input' id='cs' name='major' value=$value>" . $value;
                            echo "</label>";
                        }
                    ?>

                <label>Comments:</label>
                <textarea name="comments" rows="3" cols="40"></textarea>

                <label>Continents:</label>
                <input name="cont1" type="checkbox" value="North America"><label>North America</label>
                <input name="cont2" type="checkbox" value="South America"><label>South America</label>
                <input name="cont3" type="checkbox" value="Europe"><label>Europe</label>
                <input name="cont4" type="checkbox" value="Asia"><label>Asia</label>
                <input name="cont5" type="checkbox" value="Australia"><label>Australia</label>
                <input name="cont6" type="checkbox" value="Africa"><label>Africa</label>
                <input name="cont7" type="checkbox" value="Antarctica"><label>Antarctica</label>
                

                <input name="submit" type="submit" value="Submit">
            </form>
        </main>
    </body>
</html>