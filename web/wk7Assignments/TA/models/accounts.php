<?php

// This function handles site registrations
function regUser($username, $password) {
    // Create a connection object function
  $db = get_db();
  // The SQL statement
  $sql = 'INSERT INTO users (username, password)
       VALUES (:username, :password)';
  // Create the prepared statement
  $stmt = $db->prepare($sql);
  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->bindValue(':password', $password, PDO::PARAM_STR);
  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
};

// Check for an existing email address
function checkExistingUser($username) {
  $db = get_db();
  $sql = 'SELECT username FROM users WHERE username = :username';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->execute();
  $matchUser = $stmt->fetch(PDO::FETCH_NUM);
  $stmt->closeCursor();
  if(empty($matchUser)){
    return 0;
    // echo 'Nothing found';
    // exit;
  } else {
    return 1;
    // echo 'Match found';
    // exit;
  }
}

// Use email to login an existing client
function getByUser($username) {
  $db = get_db();
  $sql = 'SELECT id, username, password
      FROM users
      WHERE username = :username';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->execute();
  $userData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $userData;
}
