<?php

/*
 * accountDelete_SQL.php
 * deletes accounts from the database 
 */

require_once 'includes/database.php';
require_once 'includes/header.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

// sql to delete a record
$sql = "DELETE FROM users WHERE id='$id'";

// Return if-else statements to show the user they have removed data from the database.
if ($db->query($sql) === TRUE) {
    ?>

    <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Local History Obituaries</h1>
        <h2>Account deleted. Return <a href="home.php">Home</a> or go to the <a href="account_list.php">Account List</a>.</h2>
    </div>
</div>
    <?php
} else {
    echo "Error deleting account: " . $db->error;
}

$db->close();

?>

