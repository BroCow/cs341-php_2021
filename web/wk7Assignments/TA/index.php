<?php
// Create or access a Session
session_start();

//Get the database and model brought into scope
require_once 'library/connection.php';
require_once 'models/accounts.php';
require_once 'library/functions.php';


// Check if new or return user
// if(isset($_COOKIE['firstname'])) {
//   $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
// }

// This is the main controller for this website

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
  if($action == NULL) {
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
  }

switch($action) {
  case 'sign-up-form':
    include 'sign-up.php';
    break;

  case 'sign-up':

      $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
      $passwordCheck = filter_input(INPUT_POST, 'passwordCheck', FILTER_SANITIZE_STRING);
      if ($password != $passwordCheck) {
        $message = "<p style='color: red;'>Passwords do not match</p>";
        $astrix = "<span style='color: red;'>*</span>";
        include 'sign-up.php';
        die();
      }
      $checkPassword = checkPassword($password);
  
      // check for existing email
      $existingUser = checkExistingUser($username);
  
      // Handle when an existing email matches
      if ($existingUser) {
        // ***placeholder*** create pop-up "notification modal"
        $message = '<p class="notification">That username is taken. Do you want to login instead, or choose another username?</p>';
        // ***placeholder*** for modal for user's choice
        include 'sign-up.php';
        exit;
      }
  
      // check if there is data in the variable
      if (empty($username) || empty($checkPassword)) {
        $message = '<p class="notification">Please provide information for all required form fields.</p>';
        include 'sign-up.php';
        exit;
      } 
  
      // Hash the checked password
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  
      // Send the data to the model
      $regOutcome = regUser($username, $hashedPassword);
      
      // check and report the result
      if ($regOutcome === 1) {
        $_SESSION['username'] =  $username;
        $_SESSION['message'] = '<p>Please use your email and password to login.</p>';
        header('Location: /W7/ta/sign-in.php');
        die();
      } else {
        $message = '<p>Sorry the sign-up failed. Please try again.</p>';
        include 'sign-up.php';
        exit;
      }
  
  break;

  case 'sign-in':
    // Security - Sanitize incoming data
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
 
    
    $userData = getByUser($username);

    // If no row was received from the db
    if (!$userData) {
      $message = '<p class="notification">Either the username or password does not match. Please enter the correct information</p>';
      include 'sign-in.php';
      die();
    }
    
    // Test if passwords match
    $hashCheck = password_verify($password, $userData['password']);
    
    // If no match
    if (!$hashCheck) {
      $message = '<p >Either the username or password does not match. Please enter the correct information</p>';
      include 'sign-in.php';
      exit;
    }

    // If successful match
    $_SESSION['loggedin'] = TRUE;
    
    // Remove the password out of the array and store the rest into the session
    array_pop($userData);
    $_SESSION['userData'] = $userData;
    include 'welcome.php';
    exit;

  default:
    include 'sign-in.php';
}
