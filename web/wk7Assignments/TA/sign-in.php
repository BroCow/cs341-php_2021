<?php
  session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign-in Page</title>
</head>

<body>
  <h1>Please Sign-In</h1>
  <?php if(isset($message)) { echo $message; } ?>
  <form action="/W7/ta/index.php" method="post">
    <label for="username">Username<span class="required">(required)</span>
      <input name="username" id="username" type="text" <?php if (isset($username)) {
                                                          echo "value='$username'";
                                                        } ?> required>
    </label>
    <label class="" for="password">Password
      <input name="password" id="password" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?!.*[\s])(?=.*[A-Z])(?=.*[a-z]).*$" required>
    </label>
    <input type="submit" name="submit" class="regbtn" value="Sign-In">
    <input type="hidden" name="action" value="sign-in">
  </form>
  <p>If you need to sign-up <a href="/W7/ta/index.php?action=sign-up-form">Click-Here</a></p>
</body>

</html>