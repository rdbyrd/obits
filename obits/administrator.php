<?php
/*
 * Ryan Byrd
 * 10/10/2018
 * administrator.php
 * A page that displays the user's logged in status as admin. It also allows for
 * greater HTML formatting options away from the hard-coded PHP in future design changes.
 */

require_once 'includes/header.php';
require_once 'includes/database.php';
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Local History Obituaries</h1>
        <h2>Administrator Controls</h2>
    </div>
</div>

<div class="container">
    <a class='btn btn-outline-success' href='add.php'>Add Record</a><br/><br/>
    <a class='btn btn-outline-info' href='index_all_records.php'>Edit Records</a><br/><br/>
</div>

<?php
require_once 'includes/footer.php';
