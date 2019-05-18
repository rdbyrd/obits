<?php
require_once 'includes/header.php';

//add.php
//user interface for adding file information

if (($_SESSION['role']) == null) {
    header("Location: login.php");
}
?>

<div class="container">
    <br/>
    <h2>Add Record</h2>
    <br/>
    <form action="add_SQL.php" method="post">

        <div class="form-row">
            <div class="form-group col-md-3">
                Last Name
                <input type="text" name="Last" class="form-control" placeholder="Last Name" autofocus required>
            </div>
            <div class="form-group col-md-3">
                First Name
                <input type="text" name="First" class="form-control" placeholder="First Name">
            </div>
<!--        </div>

        <div class="form-row">-->
            <div class="form-group col-md-3">
                Middle Name
                <input type="text" name="Middle" class="form-control" placeholder="Middle Name">
            </div>
            <div class="form-group col-md-3">
                Maiden Name
                <input type="text" name="Maiden" class="form-control" placeholder="Maiden Name">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                Death Date
                <input type="date" name="DeathDate" class="form-control" placeholder="Death Date">
            </div>
            <div class="form-group col-md-6">
                Birth Date
                <input type="date" name="BirthDate" class="form-control" placeholder="BirthDate">
            </div>
        </div>

        <div class="form-group">
            Spouse
            <input type="text" name="Spouse" class="form-control" placeholder="Spouse">
        </div>
        <div class="form-group">
            Survived By
            <input type="text" name="SurvivedBy" class="form-control" placeholder="Survived By">
        </div>
        <div class="form-group">
            Other
            <textarea type="text" name="Other" class="form-control" rows="2" placeholder="Other"></textarea>
        </div>
        <div class="form-group">
            Obituary Source
            <textarea type="text" name="ObitSource" class="form-control" rows="2" placeholder="Obituary Source"></textarea>
        </div>
        <div class="form-group">
            Source Date
            <input type="text" name="SourceDate" class="form-control" placeholder="Source Date">
        </div>
        <div class="form-group">
            Cemetery
            <input type="text" name="Cemetery" class="form-control" placeholder="Cemetery">
        </div>

        <button type="submit" class="btn btn-success btn-lg btn-block">Create</button> 
        <br/>
    </form>
</div>

<?php
require_once 'includes/footer.php';
