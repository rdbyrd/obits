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
        <strong>Error!</strong> Something went wrong with the update.
    </div>
    <br/>
    <div class="container">
        <a class='btn btn-outline-success' href='add.php'>Add Records</a><br/><br/>
        <!--<a class='btn btn-outline-info' href='index_all_records.php'>Edit Records</a><br/><br/>-->
    </div>
    <br>
</div>
