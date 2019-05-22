<?php
require_once 'includes/header.php';
require_once 'includes/database.php';
?>
<br/>
<div class="container">
    <h2>Search Results</h2>
    <br/>
</div>
<div class="container">

    <?php
//checks for data posted in the search form        
    if (!empty($_POST['Last'] || isset($_POST['First']))) {

        //prevent unwanted characters from harming the SQL database, then pass posted data as a string
        $last = mysqli_real_escape_string($db, filter_input(INPUT_POST, 'Last', FILTER_SANITIZE_STRING));
        $first = mysqli_real_escape_string($db, filter_input(INPUT_POST, 'First', FILTER_SANITIZE_STRING));

        $perpage = 12;
        if (isset($_GET["page"])) {
            $page = intval($_GET["page"]);
        } else {
            $page = 1;
        }

        $calc = $perpage * $page;
        $start = $calc - $perpage;

        $sql = "SELECT * FROM records WHERE
            Last LIKE '$last%' && First LIKE '$first%' LIMIT $start, $perpage";

        //execute the search and call up all matching attributes
        $result = mysqli_query($db, $sql);

        //display all results
        $queryResult = mysqli_num_rows($result);

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
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        }

        if (isset($page)) {

            //HERE IS THE PROBLEM
            $result = mysqli_query($db, "SELECT Count(*) As Total FROM records");

            $rows = mysqli_num_rows($result);

            if ($rows) {

                $rs = mysqli_fetch_assoc($result);

                $total = $rs["Total"];
            }

            $totalPages = ceil($total / $perpage);

            if ($page <= 1) {

                echo "<span style='font-weight: bold;'> Prev </span>";
            } else {

                $j = $page - 1;

                echo "<span><a href='search_results.php?page=$j'>< Prev ></a></span>";
            }

            for ($i = 1; $i <= $totalPages; $i++) {

                if ($i <> $page) {

                    echo "<span><a href='search_results.php?page=$i'>$i</a> </span>";
                } else {

                    echo "<span style='font-weight: bold;'>$i</span>";
                }
            }

            if ($page == $totalPages) {

                echo "<span style='font-weight: bold;'>Next ></span>";
            } else {

                $j = $page + 1;

                echo "<span><a href='search_results.php?page=$j'>Next</a></span>";
            }
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
        