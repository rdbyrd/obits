<?php
/*
 * edit_account.php
 * GUI for editing the account 
 */

require_once 'includes/database.php';
require_once 'includes/header.php';

if (($_SESSION['role']) == null) {
    header("Location: login.php");
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//define the select statement
$sql = "SELECT * FROM users WHERE id=$id";

//execute the query
$query = $db->query($sql);
if (!$query) {
    $errno = $db->connect_errno;
    $errmsg = $db->connect_error;
    die("Connection to database failed: ($errno) $errmsg.");
} else {
    $data = $query->fetch_assoc();
}

//retrieve the user's id
$id = $_GET['id'];

// select statement to retrieve every attribute from a specific user's row
$sql = "SELECT * FROM users WHERE id=$id";

// execute SQL statement by invoking the query function
$query = $db->query($sql);

//handle errors if the database cannot be reached
if (!$query) {
    $errno = $db->connect_errno;
    $errmsg = $db->connect_error;
    die("Connection to database failed: ($errno) $errmsg.");
} else {

//executes if everything runs smoothly. Fetches all data from a specific row.
    $row = $query->fetch_assoc();
}
?>

<div class='container'>

    <div class='row'>

        <div class = 'col-md-6'>
            <br/>
            <h2>Update Account</h2>
            <br/>
            <form action="updateAccount_SQL.php" method="post">
                <table>
                    <label for="username">Username (optional):</label>
                    <input type="text" name="username" value="<?= $row['username'] ?>" class="form-control" required>
                    <br/>

                    <label for="password">Password: </label>
                    <input type='password' class="form-control" value="" name='password' autofocus required>
                    <tr>
                        <!--<td>ID:</td>-->
                        <td><input name="id" type="text" value="<?php echo $id ?>" hidden></td>
                    </tr>
                    <br/>
                    <tr>
                        <td>
                            <input type='submit' class="btn btn-success" value="Update" />
                            <input type="button" class="btn btn-info" value="Cancel" onclick="window.location.href = 'home.php'" />                    
                        </td>
                    </tr>
                </table>
            </form>
        </div>

    </div>

</div>




<?php
require_once 'includes/footer.php';
