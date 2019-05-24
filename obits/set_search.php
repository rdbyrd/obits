<?php

//initialize sessions
session_start();

//set_search.php receives input from the user's search attempt, 
//assigns it to a session superglobal, and sends the user to search_results.php
//This page is NOT viewed by the user

require_once "includes/database.php";

    //checks for data posted in the search form
    if (!empty($_GET['Last'] || isset($_GET['First']))) {

//prevent unwanted characters from harming the SQL database, then pass posted data as a string
        $last = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'Last', FILTER_SANITIZE_STRING));
        $first = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'First', FILTER_SANITIZE_STRING));
        

    //assigns session superglobals to the user input.
        $_SESSION["Last"] = $last;
        $_SESSION["First"] = $first;
        
        //let the user view results by redirecting them to search_results.php
    header("Location: search_results.php");

    

    }