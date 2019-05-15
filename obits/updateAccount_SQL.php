<?php

//session start included to update the username session variable to align with the database
session_start();

//resets the password from the backend
require_once 'includes/database.php';

//pass the user id to update a specific account.
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

//pass data from what the user typed; update the user's name on the website
$username = mysqli_real_escape_string($db, trim(stripslashes
        (filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING))));

//update the username session variable to reflect the new username that was typed
$_SESSION['username'] = $username;

//pass data from what the user typed; update the user's name on the website
$password = mysqli_real_escape_string($db, trim(stripslashes
                        (filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING))));

//has the password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

//run the SQL command to update a user's specific login credentials based on id
$sql = "UPDATE users SET username='$username',
       password='$password_hash'
       WHERE id='$id'";

//do the SQL command
$query = @$db->query($sql);

//Handle database errors; redirect on failure
if (!$query) {
    $errno = $db->errno;
    $error = $db->error;
    $error = "Insertion failed with: ($errno) $error.";
    $db->close();
    header("Location: account_error.php?m=$error");
    die();
}

//close the database to conserve resources
$db->close();

//send the user to a success page that displays their new username and directs them to somewhere else
header("Location: update_success.php");
