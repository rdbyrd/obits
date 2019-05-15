<?php
/*
  Ryan Byrd
  10/6/2018
  confirm_logout.php
  This page informs the user their session has ended.
 */

require_once 'includes/database.php';
require_once 'includes/header.php';
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Local History Obituaries</h1>
        <h2>You have been logged out. <a href="home.php">Return home.</a></h2>
    </div>
</div>


<?php
include 'includes/footer.php';
