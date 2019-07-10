<?php
//search_results receives input from set_search and searches the database 
//on fixed session variables from what the user typed in

require_once 'includes/header.php';
require_once 'includes/database.php';

print_r($_SESSION);
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h2>Search Results</h2>
    </div>
</div>

<div class="container">

    <?php
    //set session variables as regular variables to run in SQL queries below
    $last = $_SESSION['Last'];
    $first = $_SESSION['First'];
     $middle = $_SESSION["Middle"];
     $maiden = $_SESSION["Maiden"];
     $deathDate = $_SESSION["DeathDate"];
     $birthDate = $_SESSION["BirthDate"];
     $spouse = $_SESSION["Spouse"];
     $survivedBy = $_SESSION["SurvivedBy"];
     $other = $_SESSION["Other"];
     $cemetery = $_SESSION["Cemetery"] ;
     $obitSource = $_SESSION["ObitSource"] ;
     $sourceDate = $_SESSION["SourceDate"];

//get current page number        
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }
    
    $_SESSION['page_no'] = $page_no;

    //total number of records per page
    $total_records_per_page = 8;

    //calculate the next and previous page numbers
    $offset = ($page_no - 1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";


//    get the total number of pages available from setting # of records per page
    $result_count = mysqli_query(
            $db, "SELECT COUNT(*) AS total_records FROM `records` WHERE
      Last LIKE '$last%' "
            . "&& First LIKE '$first%' "
            . "&& Middle LIKE '$middle%' "
            . "&& Maiden LIKE '$maiden%'"
            . "&& DeathDate LIKE '%$deathDate%'"
            . "&& BirthDate LIKE '%$birthDate%'"
            . "&& Spouse LIKE '%$spouse%'"
            . "&& SurvivedBy LIKE '%$survivedBy%'"
            . "&& Other LIKE '%$other%'"
            . "&& Cemetery LIKE '%$cemetery%'"
            . "&& ObitSource LIKE '%$obitSource%'"
            . "&& SourceDate LIKE '%$sourceDate%'"
    );

    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1; // total pages minus 1
    ?>

    <!--Show current page total-->
    <div style='padding: 10px 20px 0px;'>
        <strong>Page <?php echo $page_no . " of " . $total_no_of_pages; ?></strong>
        <br/>
        <br/>
    </div>
    <!--create a table to format data-->
<?php
// display records in a table
echo "<table class='table table-hover'>";

//SQL query to search the session variables input by the user
$sql = "SELECT * 
        FROM records WHERE
            Last LIKE '$last%' "
            . "&& First LIKE '$first%' "
            . "&& Middle LIKE '$middle%' "
            . "&& Maiden LIKE '$maiden%'"
            . "&& DeathDate LIKE '%$deathDate%'"
            . "&& BirthDate LIKE '%$birthDate%'"
            . "&& Spouse LIKE '%$spouse%'"
            . "&& SurvivedBy LIKE '%$survivedBy%'"
            . "&& Other LIKE '%$other%'"
            . "&& Cemetery LIKE '%$cemetery%'"
            . "&& ObitSource LIKE '%$obitSource%'"
            . "&& SourceDate LIKE '%$sourceDate%'"
        . "ORDER BY Last, First ASC "
        . "LIMIT $offset, $total_records_per_page";

//execute the search and call up all matching attributes
$result = mysqli_query($db, $sql);

//set up table headers for the user to see
echo "<tr class='table-secondary'><th>Last Name</th><th>First Name</th><th>Middle</th>"
 . "<th>Maiden</th><th>Death Date</th><th>Birth Date</th></tr>";


// tbody is implemented here to make the filter work on every single row of data while excluding the headers.
echo "<tbody id='myTable'>";


//provide a snippet from the results to be represented to the user
if ($result > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        // set up a row for each record
        echo "<tr>";
        echo "<td><b><a href='display_file.php?id=" . $row['ID'] . "'</a>" . $row['Last'] . "</b></td>";
        echo "<td>" . $row['First'] . "</td>";
        echo "<td>" . $row['Middle'] . "</td>";
        echo "<td>" . $row['Maiden'] . "</td>";
        echo "<td>" . $row['DeathDate'] . "</td>";
        echo "<td>" . $row['BirthDate'] . "</td>";
        echo "</tr>";
    }
}
?>

    <!--Pagination class from Bootstrap invoked. Setup navigation buttons.-->
    <ul class="pagination">

        <!--create the previous page button-->
        <li class="page-item" <?php
    if ($page_no <= 1) {
        echo "class='disabled'";
    }
?>>
            <a class='page-link' <?php
            if ($page_no > 1) {
                echo "class='page-link' href='?page_no=$previous_page'";
            }
            ?>>Previous</a>
        </li>


        <?php
        if ($total_no_of_pages <= 10) {
            for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                if ($counter == $page_no) {
                    echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                }
            }
        } elseif ($total_no_of_pages > 10) {

            if ($page_no <= 4) {
                for ($counter = 1; $counter < 8; $counter++) {
                    if ($counter == $page_no) {
                        echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                    }
                }
                echo "<li><a>...</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
            } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                echo "<li><a>...</a></li>";
                for (
                $counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++
                ) {
                    if ($counter == $page_no) {
                        echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                    }
                }
                echo "<li><a>...</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
            } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                echo "<li><a>...</a></li>";
                for (
                $counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++
                ) {
                    if ($counter == $page_no) {
                        echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";
                    } else {
                        echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                    }
                }
                echo "<li><a>...</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                echo "<li><a>...</a></li>";
                for (
                $counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++
                ) {
                    if ($counter == $page_no) {
                        echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                    }
                }
            }
        }
        ?>

        <li class='page-item' <?php
        if ($page_no >= $total_no_of_pages) {
            echo "class='disabled'";
        }
        ?>>
            <a class='page-link' <?php
               if ($page_no < $total_no_of_pages) {
                   echo "class='page-link' href='?page_no=$next_page'";
               }
               ?>>Next</a>
        </li>

    </ul>

</tbody>
</table>

</div>

<?php
mysqli_close($db);
require_once 'includes/footer.php';
