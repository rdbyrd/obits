<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "host_lpld_gen";

?>

<?php
//Establish connection
@$db = mysqli_connect($servername, $username, $password, $dbname);

//Error if no connection. The @ operator is used to suppress errors.
$connection_error = mysqli_connect_error();
if ($connection_error != null) {
    echo "<p>Error connecting to database: $connection_error</p>";
}

?>