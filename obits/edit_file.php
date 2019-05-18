<?php
/*
 * Ryan Byrd
 * 9/19/2018
 * This file retrieves data, posts it into a form, and allows the user to update records.
 */

require_once 'includes/header.php';
require_once 'includes/database.php';

if (($_SESSION['role']) == null) {
    header("Location: login.php");
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//define the select statement
$sql = "SELECT * FROM records WHERE id=$id";

//execute the query
$query = $db->query($sql);
if (!$query) {
    $errno = $db->connect_errno;
    $errmsg = $db->connect_error;
    die("Connection to database failed: ($errno) $errmsg.");
} else {
    $data = $query->fetch_assoc();
}
?>

<br/>
<!--<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h4>Edit Record</h4>
    </div>
</div>-->

<div class="container">
    <form action="edit_SQL.php" method="post">

        <div class="form-row">
            <div class="form-group col-md-3">
                Last Name
                <input type="text" name="Last" class="form-control" placeholder="Last Name" value="<?php echo $data['Last'] ?>" autofocus required>
            </div>
            <div class="form-group col-md-3">
                First Name
                <input type="text" name="First" class="form-control" placeholder="First Name" value="<?php echo $data['First'] ?>">
            </div>
<!--        </div>  

        <div class="form-row">-->
            <div class="form-group col-md-3">
            Middle Name
                <input type="text" name="Middle" class="form-control" placeholder="Middle Name" value="<?php echo $data['Middle'] ?>">
            </div>
            <div class="form-group col-md-3">
            Maiden Name
                <input type="text" name="Maiden" class="form-control" placeholder="Maiden Name" value="<?php echo $data['Maiden'] ?>">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
                Death Date
                <input type="date" name="DeathDate" class="form-control" placeholder="Death Date" value="<?php echo $data['DeathDate'] ?>">
            </div>
            <div class="form-group col-md-6">
                Birth Date
                <input type="date" name="BirthDate" class="form-control" placeholder="BirthDate" value="<?php echo $data['BirthDate'] ?>">
            </div>
        </div>
        <div class="form-group">
            Spouse
            <input type="text" name="Spouse" class="form-control" placeholder="Spouse" value="<?php echo $data['Spouse'] ?>">
        </div>
        <div class="form-group">
            Survived By
            <input type="text" name="SurvivedBy" class="form-control" placeholder="SurvivedBy" value="<?php echo $data['SurvivedBy'] ?>">
        </div>
        <div class="form-group">
            Other
            <textarea type="text" name="Other" class="form-control" placeholder="Other"> <?php echo $data['Other'] ?></textarea>
        </div>
        <div class="form-group">
            Obituary Source
            <textarea type="text" name="ObitSource" class="form-control" rows="3" placeholder="Obituary Source"><?php echo $data['ObitSource'] ?></textarea>
        </div>
        <div class="form-group">
            Source Date
            <input type="text" name="SourceDate" class="form-control" placeholder="Source Date" value="<?php echo $data['SourceDate'] ?>">
        </div>
        <div class="form-group">
            Cemetery
            <input type="text" name="Cemetery" class="form-control" placeholder="Cemetery" value="<?php echo $data['Cemetery'] ?>">
        </div>



        <!--hidden field to pass the primary key integer of the file for updates-->
        <input type="hidden" name="ID" value="<?php echo $id; ?>"/>
        <button type="submit" class="btn btn-success btn-lg btn-block">Update</button> <br/>
        <a class='btn btn-info btn-lg btn-block' data-target="#myModal" data-toggle="modal" href=display_file.php?id=<?= $id ?> >Cancel</a>

        <!--modal pop-up window to prevent users from accidentally canceling-->

        <div id="myModal" class="modal fade" data-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Cancel updates to prevent accidental changes.</p>
                        <p class="text-secondary"><small>If you selected cancel by mistake, press the X in the top-right corner of this window to continue making edits before you update.</small></p>
                    </div>
                    <div class="modal-footer">
                        <a class='btn btn-info' href=display_file.php?id="<?= $id; ?>" >Leave</a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<?php
require_once 'includes/footer.php';
