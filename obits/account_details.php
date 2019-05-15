<?php
/*
 * account_details.php
 * display the details of an account to be edited by an admin
 */

require_once 'includes/header.php';
require_once 'includes/database.php';

//only give a user permission to visit this page if they are an admin
if (($_SESSION['role']) === 2) {
    header("Location: login.php");
}

//pass the user's unique hidden id to access details of the page
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//define the select statement
$sql = "SELECT * FROM users WHERE id=" . $id;

//execute the query
$query = $db->query($sql);

//create and execute the SQL statement
//$query = mysqli_query($db, "SELECT * FROM users WHERE id=$id");

//report errors if something goes wrong
if (!$query) {
    $errno = $db->connect_errno;
    $errmsg = $db->connect_error;
    die("Connection to database failed: ($errno) $errmsg.");
} else {

    //gather all data attributes from each field in a user's record to output on the screen
    $data = $query->fetch_assoc();
}
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Local History Obituaries</h1>
        <h2>Manage Account</h2>
    </div>
</div>

<div class="container">
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>Account Update: </strong>You must type a password before making changes.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="accountManagement_SQL.php" method="post">
        <h3>Account Management</h3>
        <br/>
        <label for="username">Username</label><br/>
        <input type="text" name="username" class="form-control" value="<?php echo $data['username'] ?>" autofocus required><br/>
        <label for="password">Password</label><br/>
        <input type="password" name="password" class="form-control" value="" required>
        <br/>

        <label class="radio-inline">
            <input type="radio" name="role" value="1" <?php echo ($data['role'] == 1) ? 'checked' : '' ?>> Regular User
        </label><br/>
        <label class="radio-inline">
            <input type="radio" name="role" value="2" <?php echo ($data['role'] == 2) ? 'checked' : '' ?>> Administrator
        </label>
        <br/>

        <br/>
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>

        
        
        <button type="submit" class="btn btn-success btn-lg">Update</button>
        <input type="button" class="btn btn-info btn-lg inner inlineBtnRight" name="Cancel" value="Cancel" onclick="window.location.href = 'account_list.php'" />   
    </form>
    <br/>

    <!--delete button-->
    <form action = "accountDelete_SQL.php" class="inner inlineBtnRight" method = "post" onsubmit = "return confirm('Confirm you wish to delete this account.')" >
        <input type = "submit" class = 'btn btn-danger btn-lg inner inlineBtnRight' value = "Delete" >
        <input type = "hidden" name = "id" value = "<?php echo $data['id'] ?>">
    </form>
</div>

