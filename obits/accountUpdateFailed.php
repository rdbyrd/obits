<?php
/*
 * accountUpdateFailed.php
 * Alert the user if something went wrong with updating an account
 */

require_once('includes/database.php');
require_once('includes/header.php');
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Local History Obituaries</h1>
        <h2>Account Update</h2>
    </div>
</div>

<!--Format the page to have all content contained towards the center and left-aligned.-->
<div class='container'>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> That username already exists.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    Return to the <a href="account_list.php">Account List</a>.
    
</div>
