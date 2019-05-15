<?php
/*
 * account_list.php
 * List all accounts on a user interface
 */

require_once 'includes/header.php';
require_once 'includes/database.php';

if (($_SESSION['role']) != 2) {
    header("Location: login.php");
}
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Local History Obituaries</h1>
        <h2>Manage Accounts</h2>
    </div>
</div>

<div class="container">

    <?php
    
//get the records from the database
    $result = mysqli_query($db, "SELECT * FROM users");

//display records as rows if there are any to display
    if ($result->num_rows > 0) {

//display the records in a table
        echo "<table id='myTable2' class='table table-hover'>";
        
// set table headers
        echo "<tr class='table-secondary'>"
        . "<th>Username</th>"
        . "<th>Role</th>"
        . "</tr>";

        while ($row = $result->fetch_object()) {

// set up a row for each record
            echo "<tr>";
            echo "<td><b><a href='account_details.php?id=" . $row->id . "'</a>" . $row->username . "</b></td>";
            echo "<td>" . $row->role . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }

//Report this message if no data could be found.
    else {
        echo "This database contains no records.";
    }

// close database connection
    $db->close();
    ?>
</div>

<?php
require_once 'includes/footer.php';
