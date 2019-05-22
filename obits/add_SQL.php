<?php

require_once 'includes/database.php';

/*
 * add_SQL.php
 * Inputs user typed data. 
 * 
 * The following functions are protective features
 * mysqli_real_escape_string prevents JavaScript commands from being inserted into the database
 * trim eliminates unnecessary whitespace from the beginning and end of the form (space remover)
 * stripslashes removes slashes. This is probably the least necessary feature.
 * htmlspecialchars reads all keyboard icons as icons rather than HTML (i.e. it ignores tags like <p> and inserts it as is rather than modify them when input
 */

$last = mysqli_real_escape_string($db, trim(stripslashes(filter_input(INPUT_POST, 'Last', FILTER_SANITIZE_STRING))));
$first = mysqli_real_escape_string($db, trim(stripslashes(filter_input(INPUT_POST, 'First', FILTER_SANITIZE_STRING))));
$middle = mysqli_real_escape_string($db, trim(stripslashes(filter_input(INPUT_POST, 'Middle', FILTER_SANITIZE_STRING))));
$maiden = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'Maiden', FILTER_SANITIZE_STRING)))));
$deathDate = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'DeathDate', FILTER_SANITIZE_STRING)))));
$birthDate = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'BirthDate', FILTER_SANITIZE_STRING)))));
$spouse = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'Spouse', FILTER_SANITIZE_STRING)))));
$survivedBy = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'SurvivedBy', FILTER_SANITIZE_STRING)))));
$other = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'Other', FILTER_SANITIZE_STRING)))));
$obitSource = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'ObitSource', FILTER_SANITIZE_STRING)))));
$cemetery = mysqli_real_escape_string($db, (trim(stripslashes(filter_input(INPUT_POST, 'Cemetery', FILTER_SANITIZE_STRING)))));

//insertion statements for the database. The question ? marks specify parameters.
$query = "INSERT INTO records (Last, First, Middle, Maiden, DeathDate,
        BirthDate, Spouse, SurvivedBy, Other, Cemetery, ObitSource) VALUES (?, ?, ?, ?, ?,
        ?, ?, ?, ?, ?, ?)";

//initiate prepared statement to (hopefully) prevent SQL injection.
if ($statement = $db->prepare($query)) {


//restrict paramaters to string datatypes only for each column insertion.
    $statement->bind_param("ssssddsssss", $last, $first, $middle, $maiden, $deathDate, $birthDate, $spouse, $survivedBy, $other, $cemetery, $obitSource);
} else {

    //check if an error exists in a column for the database
    $error = $db->errno . ' ' . $db->error;
    echo $error;
}

//execute the prepared SQL statement. Render data to show number of rows affected (should return 0 if failure or none).
$execute = $statement->execute();
if ($execute) {
//close connection to free up resources.
    $statement->close();
    header("Location: add_successful.php");
} else {
//close connection to free up resources.
    $error_message = $db->error;
    $statement->close();
    header("Location: error.php");
}
