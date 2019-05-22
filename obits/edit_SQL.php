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
$id = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_NUMBER_INT);

//resubmit old data alongside the new during an update. Wiping input from forms that had already been there will lose that information
$last = mysqli_real_escape_string($db, trim(stripslashes(filter_input(INPUT_POST, 'Last', FILTER_SANITIZE_STRING))));
$first = mysqli_real_escape_string($db, trim(stripslashes(filter_input(INPUT_POST, 'First', FILTER_SANITIZE_STRING))));
$middle = mysqli_real_escape_string($db, trim(stripslashes(filter_input(INPUT_POST, 'Middle', FILTER_SANITIZE_STRING))));
$maiden = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'Maiden', FILTER_SANITIZE_STRING)))));
$deathDate = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'DeathDate', FILTER_SANITIZE_STRING)))));
$birthDate = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'BirthDate', FILTER_SANITIZE_STRING)))));
$spouse = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'Spouse', FILTER_SANITIZE_STRING)))));
$survivedBy = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'SurvivedBy', FILTER_SANITIZE_STRING)))));
$other = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'Other', FILTER_SANITIZE_STRING)))));
$cemetery = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'Cemetery', FILTER_SANITIZE_STRING)))));
$obitSource = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'ObitSource', FILTER_SANITIZE_STRING)))));

//this is the SQL command used to update data submitted in the edit form.
$sql = "UPDATE records SET Last ='$last',
        First='$first', 
        Middle='$middle', 
        Maiden='$maiden', 
        DeathDate='$deathDate',
        BirthDate='$birthDate', 
        Spouse='$spouse', 
        SurvivedBy='$survivedBy',
        Other='$other',
        ObitSource='$obitSource',
        Cemetery='$cemetery'
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

header("Location: display_file.php?id=$id");