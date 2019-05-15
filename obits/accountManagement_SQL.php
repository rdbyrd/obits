<?php

/*
 * accountManagement_SQL.sql 
 * used for backing up and deleting accounts from the database
 */

//include database
require_once 'includes/database.php';

//send the hidden post id field to the database so that edited information form edit_file.php can be processed.
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

//reconfirm all file changes, saving it to the database as though every form insertion were a new input. Makes new inputs work. 
$username = mysqli_real_escape_string($db, trim((filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING))));
$password = mysqli_real_escape_string($db, trim((filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING))));
$role = mysqli_real_escape_string($db, trim((filter_input(INPUT_POST, 'role', FILTER_SANITIZE_NUMBER_INT))));

//hash the password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

//this is the SQL command used to update data submitted in the edit form.
$sql = "UPDATE users SET username ='$username',
        password = '$password_hash',
        role='$role' 
        WHERE id='$id'";

//execute the insert query
$query = @$db->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $db->errno;
    $error = $db->error;
    $error = "Insertion failed with: ($errno) $error.";
    $db->close();
    
    header("Location: accountUpdateFailed.php");
    die();
}

$db->close();

header("Location: account_list.php");
