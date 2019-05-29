<?php
/*
 * display_file.php
 * display the details of a record
 */

require_once 'includes/header.php';
require_once 'includes/database.php';

//get current page number        
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }

    echo $page_no;
    
//variable to pass a file's unique id number on a successful selection 
//Input get method retrieves all attributes within a row of data. Sanitize to ensure it is an integer.
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//select statement
$query = "SELECT * FROM records WHERE id =" . $id;
$result = $db->query($query);

//check the results, but display an error if the requested file did not appear
if ($result == false) {
    $error_message = $db->error;
    echo "<p>An error occurred: $error_message</p>";
    exit();
}

//get the data for a specific file and display it as a row
$row_count = mysqli_num_rows($result);
?>

<!--Jumbotron identifying what the page is-->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h2>Record Details</h2>
    </div>
</div>

<?php
//for loop to display each new piece of data as a row.
for ($i = 0; $i < $row_count; $i++) :
    $data = $result->fetch_assoc();
    ?>     

    <div class="container">

        <h3><?php echo $data['First'] . " " . $data['Middle'] . " " . $data['Last']; ?></h3>

        <br/>

        <table class="table">
            <tr><td>Maiden Name: <b><?php echo $data['Maiden']; ?></b></td></tr>
            <tr><td>Death Date: <b><?php echo $data['DeathDate']; ?></b></td></tr>
            <tr><td>Birth Date: <b><?php echo $data['BirthDate']; ?></b></td></tr>
            <tr><td>Spouse: <b><?php echo $data['Spouse']; ?></b></td></tr>
            <tr><td>Survived By: <b><?php echo $data['SurvivedBy']; ?></b></td></tr>
            <tr><td>Other: <b><?php echo $data['Other']; ?></b></td></tr>
            <tr><td>Cemetery: <b><?php echo $data['Cemetery']; ?></b></td></tr>
            <tr><td>Obituary Source: <b><?php echo $data['ObitSource']; ?></b></td></tr>
        </table>

        <?php
        //this isset checks if a role is assigned. If it is, then it permits the edit button to appear.
        //Otherwise, the user sees nothing.
        if (isset($_SESSION['role']) == 2) {
            echo "<div id='outer'>";
            echo "<div class='inner inlineBtnMiddle'> <a class='btn btn-primary' href=search_results.php?page_no=", $_SESSION['page_no'], ">Return</a></div><br/><br/>";
            echo "<div class='inner'> <a class='btn btn-info' href=edit_file.php?id=", $data['ID'], ">Edit</a></div>";
            ?>
            <!--delete button-->
            <form action = "delete_SQL.php" class="inner inlineBtnRight" method = "post" onsubmit = "return confirm('Confirm you wish to delete this record.')" >
                <input type = "submit" class = 'btn btn-danger' value = "Delete" >
                &nbsp;
                &nbsp;
                <input type = "hidden" name = "ID" value = "<?php echo $data['ID'] ?>">
            </form>
            <?php
            echo "</div>";
        }
        ?>

    </div>


    <?php
//close the loop. It performs the same function as a closing }
endfor;

//close the database 
$db->close();
?>

<?php
require_once 'includes/footer.php';
