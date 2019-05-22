<?php
require_once 'includes/header.php';
require_once 'includes/database.php';
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Local History Obituaries</h1>
        <h2>Search Results</h2>
    </div>
</div>

<div class="container">

    <?php
//checks for data posted in the search form
    if (!empty($_POST['Last'] || isset($_POST['First']))) {

        //prevent unwanted characters from harming the SQL database, then pass posted data as a string
        $last = mysqli_real_escape_string($db, filter_input(INPUT_POST, 'Last', FILTER_SANITIZE_STRING));
        $first = mysqli_real_escape_string($db, filter_input(INPUT_POST, 'First', FILTER_SANITIZE_STRING));
        
        //design for a more advanced search later
        $sql = "SELECT * FROM records WHERE
            Last LIKE '$last%' && First LIKE '$first%'";
        

//            OR First LIKE '%$search%'
//            OR Middle LIKE '%$search%' 
//            OR Maiden LIKE '%$search%' 
//            OR DeathDate LIKE '%$search%'
//            OR BirthDate LIKE '%$search%'
//            OR Spouse LIKE '%$search%'
//            OR SurvivedBy LIKE '%$search%'
//            OR Other LIKE '%$search%'
//            OR ObitSource LIKE '%$search%'
//            OR SourceDate LIKE '%$search%'
//            OR Cemetery LIKE '%$search%'";

        //execute the search and call up all matching attributes
        $result = mysqli_query($db, $sql);

        //display all results
        $queryResult = mysqli_num_rows($result);

        //display number of results discovered
        echo "Results: " . $queryResult . "<hr/>";

// display records in a table
        echo "<table class='table table-hover'>";

// how to set width in table header tags width='15%'
// set table headers
        echo "<tr class='table-secondary'><th>Last Name</th><th>First Name</th><th>Middle</th>"
        . "<th >Maiden</th><th>Death Date</th><th>Birth Date</th></tr>";


        // tbody is implemented here to make the filter work on every single row of data while excluding the headers.
        echo "<tbody id='myTable'>";

        //provide a snippet from the results to be represented to the user
        if ($queryResult > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
// set up a row for each record
                echo "<tr>";
                echo "<td><b><a href='display_file.php?id=" . $row['ID'] . "'</a>" . $row['Last'] . "</b></td>";
                echo "<td>" . $row['First'] . "</td>";
                echo "<td>" . $row['Middle'] . "</td>";
                echo "<td>" . $row['Maiden'] . "</td>";
                echo "<td>" . $row['DeathDate'] . "</td>";
                echo "<td>" . $row['BirthDate'] . "</td>";
//                echo "<td>" . $row['Spouse'] . "</td>";
//                echo "<td>" . $row['SurvivedBy'] . "</td>";
//                echo "<td>" . $row['Other'] . "</td>";
//                echo "<td>" . $row['ObitSource'] . "</td>";
//                echo "<td>" . $row['SourceDate'] . "</td>";
//                echo "<td>" . $row['Cemetery'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        }


//Report this message if no data could be found.
    } else {
        echo "No results.";
    }

    $db->close();
    ?>

</div>

<?php
require_once 'includes/footer.php';
