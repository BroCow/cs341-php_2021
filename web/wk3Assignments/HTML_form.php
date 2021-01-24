<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="author" content="Christopher Cowan">
        <meta name="description" content="This page serves as the HTML form page for CSE341 Wk3 Team Assignment.">
        <title>CSE 341 Form | Team Activity</title>
        <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="normalize.css" media="screen">
        <link rel="stylesheet" href="form.css" media="screen">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <body>
        <header>
        </header>

        <nav>
        </nav>

        <main>
            <div class="container">
                <form action="PHP_form.php" method="POST" title="Student Information Form" name="studentInfoForm">
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <?php if(isset($_SESSION['firstName'])): ?>
                        <input type="text" class="form-control" placeholder="Enter first name" id="firstName" name="firstName" value="<?php echo $_SESSION['firstName']?>">
                        <?php else: ?>
                        <input type="text" class="form-control" placeholder="Enter first name" id="firstName" name="firstName">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <?php if(isset($_SESSION['lastName'])): ?>
                        <input type="text" class="form-control" placeholder="Enter last name" id="lastName" name="lastName" value="<?php echo $_SESSION['lastName']?>">
                        <?php else: ?>
                        <input type="text" class="form-control" placeholder="Enter last name" id="lastName" name="lastName">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <?php if(isset($_SESSION['email'])): ?>
                        <input type="text" class="form-control" placeholder="your_email@address.com" id="email" name="email" value="<?php echo $_SESSION['email']?>">
                        <?php else: ?>
                        <input type="text" class="form-control" placeholder="your_email@address.com" id="email" name="email">
                        <?php endif; ?>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="cs" name="major" value="Computer Science">Computer Science
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="wdd" name="major" value="Web Design and Development">Web Design and Development
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="cit" name="major" value="Computer Information Technology">Computer Information Technology
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="ce" name="major" value="Computer Engineering">Computer Engineering
                        </label>
                    </div>
 
                    <br>
                    <!-- PHP array/loop to display majors (STRETCH 1) ---->
                    <br>
                    <p>Stretch 1 - Below the majors are displayed using an array/loop</p>
                    <?php
                        $major = array("Computer Science (CS)", "Web Design and Development (WDD)", "Computer Information Technology (CIT)", "Computer Engineering (CE)");

                        foreach ($major as $value) {
                            echo "<div class='form-check'>";
                            echo "<label class='form-check-label'>";
                            echo "<input type='radio' class='form-check-input' id='cs' name='major' value=$value>" . $value;
                            echo "</label>";
                            echo "</div>";
                        }
                    ?>
                    <div class="form-group">
                        <label for="comment">Comments:</label>
                        <?php if(isset($_SESSION['comments'])): ?>
                        <textarea class="form-control" rows="7" id="comments" name="comments" value="<? echo $_SESSION['comments']?>"></textarea>
                        <?php else: ?>
                        <textarea class="form-control" rows="7" id="comments" name="comments"></textarea>
                        <?php endif; ?>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="cont1" value="na">North America
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="cont2" value="sa">South America
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="cont3" value="eu">Europe
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="cont4" value="as">Asia
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="cont5" value="au">Australia
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="cont6" value="af">Africa
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="cont7" value="an">Antarctica
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </main>

        <footer>
        </footer>

        <script src=""></script>
    </body>

</html>