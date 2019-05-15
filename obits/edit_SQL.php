<?php

/*
 * Ryan Byrd
 * 9/21/2018
 * edit_SQL
 * This page manages the edits submitted in the edit_file.php page. The user has no need to view this file. 
 */

//include database
require_once 'includes/database.php';

//send the hidden post id field to the database so that edited information form edit_file.php can be processed.
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

//reconfirm all file manipulation, saving it to the database as though every form insertion were a new input. Makes new inputs work. 
$filename = mysqli_real_escape_string($db, trim(stripslashes(filter_input(INPUT_POST, 'filename', FILTER_SANITIZE_STRING))));
$category = mysqli_real_escape_string($db, trim(stripslashes(filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING))));
$subcategory = mysqli_real_escape_string($db, trim(stripslashes(filter_input(INPUT_POST, 'subcategory', FILTER_SANITIZE_STRING))));
$file_location = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'file_location', FILTER_SANITIZE_STRING)))));
$state = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING)))));
$county = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'county', FILTER_SANITIZE_STRING)))));
$township = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'township', FILTER_SANITIZE_STRING)))));
$city = mysqli_real_escape_string($db, (stripslashes(filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING))));
$related = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'related', FILTER_SANITIZE_STRING)))));
$alias = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'alias', FILTER_SANITIZE_STRING)))));
$keywords = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)))));

//this is the SQL command used to update data submitted in the edit form.
$sql = "UPDATE files SET filename ='$filename',
        category = '$category', 
        subcategory='$subcategory', 
        file_location='$file_location', 
        state='$state', county='$county', 
        township='$township', 
        city='$city', 
        alias='$alias', related='$related',
        keywords='$keywords'
        WHERE id='$id'";

//execute the insert query
$query = @$db->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $db->errno;
    $error = $db->error;
    $error = "Insertion failed with: ($errno) $error.";
    $db->close();
    header("Location: error.php?m=$error");
    die();
}

$db->close();

header("Location: index_all_records.php");
