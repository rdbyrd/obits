<?php
require_once 'includes/header.php';

if (($_SESSION['role']) == null) {
    header("Location: login.php");
}
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Local History Obituaries</h1>
        <h2>Error Page</h2>
    </div>    
</div>

<div class='container'>
    <div class="alert alert-danger">
        <strong>Cannot accept these credentials!</strong> Please try again.
    </div>
    <br/>
    <div class="container">
        <a class='btn btn-outline-success' href='edit_account.php?id=<?= $_SESSION["id"]?>'>Retry</a>
        <a class='btn btn-outline-info' href="home.php">Cancel</a><br/><br/>
    </div>
    <br>
</div>
