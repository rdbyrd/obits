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
$sql = "SELECT * FROM files WHERE id=$id";

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

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Local History Obituaries</h1>
        <h2>Edit Record</h2>
    </div>
</div>

<div class="container">

    <form action="edit_SQL.php" method="post">
        <h3>Core Information</h3>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="filename">File Name</label>
                <input type="text" name="filename" class="form-control" value="<?php echo $data['filename'] ?>" autofocus required>
            </div>
            <div class="form-group col-md-4">
                <label for="subject">Category</label>
                <input type="text" name="category" class="form-control" value="<?php echo $data['category'] ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="subcategory">Sub-category</label>
                <input type="text" name="subcategory" class="form-control" value="<?php echo $data['subcategory'] ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="file_location">File Drawer Location</label>
                <input type="text" name="file_location" class="form-control" value="<?php echo $data['file_location'] ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="state">State:</label>
                <input type="text" class="form-control" id="state" name="state" value="<?php echo $data['state'] ?>" required>
            </div>
        </div>
        <hr/>
        <br/>
        <h3>Additional Information</h3>
        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="alias">Keywords</label>
                <input type="text" name="keywords" class="form-control" value="<?php echo $data['keywords'] ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="related files">Related Resources</label>
                <input type="text" name="related" class="form-control" value="<?php echo $data['related'] ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="alias">Alias/Other Names</label>
                <input type="text" name="alias" class="form-control" value="<?php echo $data['alias'] ?>">
            </div>

        </div>
        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="county">County:</label>
                <input type="text" class="form-control" id="county" name="county" value="<?php echo $data['county'] ?>">
            </div>

            <div class="form-group col-md-4">
                <label for="township">Township</label>
                <input type="text" name="township" class="form-control" value="<?php echo $data['township'] ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="city">City</label>
                <input type="text" name="city" class="form-control" value="<?php echo $data['city'] ?>">
            </div>
        </div>

        

        <!--hidden field to pass the primary key integer of the file for updates-->
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <button type="submit" class="btn btn-success btn-lg btn-block">Update</button> <br/>
    </form>
</div>

<?php
require_once 'includes/footer.php';
