<?php

/*
 * display_file.php
 * display the details of a record
 */

require_once 'includes/header.php';
require_once 'includes/database.php';

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
        <h1>Local History Obituaries</h1>
        <h2>Record Details</h2>
    </div>
</div>

<?php
//for loop to display each new piece of data as a row.
for ($i = 0; $i < $row_count; $i++) :
    $data = $result->fetch_assoc();
    ?>     

    <div class="container">

        <h2><?php echo $data['filename']; ?></h2>

        <br/>

        <p>Alias/Other Names: <b><?php echo $data['alias']; ?></b></p>

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Category/
                        <br/>Subcategory</th>
                    <th>Additional Information</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b><?php echo $data['category']; ?></b></td>
                    <td>Related Resources: <b><?php echo $data['related']; ?></b></td>

                </tr>
                <tr>
                    <td><b><?php echo $data['subcategory']; ?></b></td>
                    <td>Keywords: <b><?php echo $data['keywords']; ?></b></td>

                </tr>
            </tbody>
        </table>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Vertical File Location</th>
                    <th>Location Related to the File</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b><?php echo $data['file_location']; ?></b></td>
                    <td>City: <b><?php echo $data['city']; ?></b></td>
                    <td>County: <b><?php echo $data['county']; ?></b></td>
                </tr>
                <tr>
                </tr>
                <tr/>
            <td></td>
            <td>Township: <b><?php echo $data['township']; ?></b></td>
            <td>State: <b><?php echo $data['state']; ?></b></td>

            </tbody>
        </table>

        <!--Access the edit button. Sends to edit_file.php and div tags align right.-->
        <?php
        //this isset checks if a role is assigned. If it is, then it permits the edit button to appear.
        //Otherwise, the user sees nothing.
        if (isset($_SESSION['role']) == 2) {
            echo "<div id='outer'>";
            echo "<div class='inner'> <a class='btn btn-info' href=edit_file.php?id=", $data['id'], ">Edit</a></div>";
            ?>
            <!--delete button-->
            <form action = "delete_SQL.php" class="inner inlineBtnRight" method = "post" onsubmit = "return confirm('Confirm you wish to delete this record.')" >
                <input type = "submit" class = 'btn btn-danger' value = "Delete" >
                &nbsp;
                &nbsp;
                <input type = "hidden" name = "id" value = "<?php echo $data['id'] ?>">
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
