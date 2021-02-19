<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign-up</title>
</head>
<body>
  <h1>Sign-Up</h1>
  <?php if(isset($message)) { echo $message; } ?>
  <form id="signupForm"  action="/W7/ta/index.php" method="post">
    <label for="username">Username<span class="required">(required)</span>
      <input name="username" id="username" type="text" <?php if (isset($username)) {
                                                          echo "value='$username'";
                                                        } ?> required>
    </label>
    <label class="" for="password"><br>Password<br>
      <span class="required">Password requirements:
        <ul>
          <li>Must contain at least one;
            <ul class="">
              <li>upper case letter (A-Z)</li>
              <li>lower case letter (a-z)</li>
              <li>special character (! # $ % - _ = +)</li>
              <li>number (0-9)</li>
            </ul>
          <li>Minimum Length = 8 characters</li>
          <li>No blank spaces</li>
        </ul>
      </span>
      <?php if(isset($astrix)) { echo $astrix; } ?><input name="password" id="password" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?!.*[\s])(?=.*[A-Z])(?=.*[a-z]).*$" required>
    </label>
    <label class="" for="passwordCheck">Re-enter Password
      
     <?php if(isset($astrix)) { echo $astrix; } ?><input name="passwordCheck" id="passwordCheck" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?!.*[\s])(?=.*[A-Z])(?=.*[a-z]).*$" required>
    </label>
    
    <input type="submit" name="submit" class="regbtn" value="Sign-UP">
    <input type="hidden" name="action" value="sign-up">
  </form>
  <script>
    pwd1 = document.querySelector("#password");
    pwd2 = document.querySelector("#passwordCheck");

    pwd2.addEventListener('input', function (evt) {
      if (pwd1.value != pwd2.value) {
        pwd2.style.backgroundColor = "red";
      }
      else {
        pwd2.style.backgroundColor = "white";
      }
});
    $("#signupForm").submit(function (event) {
  event.preventDefault();
  console.log("before post");
  
  
});
  </script>
</body>
</html>