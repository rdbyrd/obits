<?php
require_once 'includes/header.php';

//add.php
//user interface for adding file information

if (($_SESSION['role']) == null) {
    header("Location: login.php");
}
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Local History Obituaries</h1>
        <h2>Add Obituary Documentation</h2>
    </div>
</div>

<div class="container">

    <form action="add_SQL.php" method="post">
        <h3>Obituary Information</h3>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="Last">Last Name</label>
                <input type="text" name="Last" class="form-control" placeholder="Last name" autofocus required>
            </div>
            <div class="form-group col-md-4">
                <label for="First">First Name</label>
                <input type="text" name="First" class="form-control" placeholder="First Name" required>
            </div>
            <div class="form-group col-md-4">
                <label for="Middle">Middle Name</label>
                <input type="text" name="Middle" class="form-control" placeholder="Middle Name">
            </div>
            <div class="form-group col-md-4">
                <label for="Maiden">Maiden Name</label>
                <input type="text" name="Maiden" class="form-control" placeholder="Maiden Name">
            </div>
            <div class="form-group col-md-4">
                <label for="DeathDate">Death Date</label>
                <input type="date" name="DeathDate" class="form-control" required>
            </div>

        <!--</div>-->
        <!--<div class="form-row">-->
<!--            <div class="form-group col-md-4">
                <label for="PartialDeathDate">Partial Death Date</label>
                <input type="text" name="PartialDeathDate" class="form-control">
            </div>-->

            <div class="form-group col-md-4">
                <label for="BirthDate">Birth Date</label>
                <input type="date" name="BirthDate" class="form-control">
            </div>
<!--            <div class="form-group col-md-4">
                <label for="PartialBirthDate">Partial Birth Date</label>
                <input type="text" name="PartialBirthDate" class="form-control">
            </div>-->
            <div class="form-group col-md-4">
                <label for="Spouse">Spouse</label>
                <input type="text" name="Spouse" class="form-control" placeholder="Spouse">
            </div>
        <!--</div>-->

            <div class="form-group col-md-4">
                <label for="SurvivedBy">Survived By</label>
                <input type="text" name="SurvivedBy" class="form-control" placeholder="Survived By">
            </div>
            <div class="form-group col-md-4">
                <label for="Other">Other</label>
                <input type="text" name="Other" class="form-control" placeholder="Other">
            </div>
            <div class="form-group col-md-4">
                <label for="ObitSource">Obituary Source</label>
                <input type="text" name="Obituary Source" class="form-control" placeholder="Obituary Source">
            </div>
            <div class="form-group col-md-4">
                <label for="SourceDate">Source Date</label>
                <input type="text" name="SourceDate" class="form-control" placeholder="Source Date">
            </div>
            <div class="form-group col-md-4">
                <label for="Cemetary">Cemetary</label>
                <input type="text" name="Cemetary" class="form-control" placeholder="Cemetary">
            </div>
        </div>

        <button type="submit" class="btn btn-success btn-lg btn-block">Create</button> 
        <br/>
    </form>
</div>

<?php
require_once 'includes/footer.php';
