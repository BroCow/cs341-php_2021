<?php
/* ***************************************************************
 * ***************************************************************
 * The following functions check variable values 
 * 
 * *************************************************************/



/* Input: clients proposed password string
 * Work: Compares the entry against a pattern of at least:
 *    One capital letter (A-Z)
 *    One lowercase letter (a-z)
 *    One special character
 *    One number (0-9) and
 *  A minimum of 8 characters with 
 *  no blank spaces
 * Returns: "1" if it matches, "0" for no match  
 */
function checkPassword($clientPassword) {
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
  return preg_match($pattern, $clientPassword);
}


