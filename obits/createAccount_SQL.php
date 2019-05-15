<?php

/*
 * createAccount_SQL.php
 * backend SQL side to ensure that new accounts can be created 
 */

require_once 'includes/database.php';

//retrieve password, then remove white space, filter, and sanitize
$password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

//function to hash the password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

//receive input typed by the user
$username = mysqli_real_escape_string($db, trim(stripslashes(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING))));
$role = mysqli_real_escape_string($db, trim(stripslashes(filter_input(INPUT_POST, 'role', FILTER_SANITIZE_NUMBER_INT))));

//insertion statements for the database.
$query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password_hash', '$role')";

if (mysqli_query($db, $query)) {

    //redirect to the account list if everything worked
    header("Location: account_list.php");
    
} else {

    //redirect the user if they create a duplicate account
    header("Location: account_create_1.php");
    
}

mysqli_close($db);


