<?php

//initialize sessions
session_start();

//set_search.php receives input from the user's search attempt, 
//assigns it to a session superglobal, and sends the user to search_results.php
//This page is NOT viewed by the user

require_once "includes/database.php";

    //checks for data posted in the search form
    if (!empty($_GET['Last'] ||
        isset($_GET['First']) ||
        isset($_GET['Middle']) ||
        isset($_GET['Maiden']) ||
        isset($_GET['DeathDate']) ||
        isset($_GET['BirthDate']) ||
        isset($_GET['Spouse']) ||
        isset($_GET['SurvivedBy']) ||
        isset($_GET['Other']) ||
        isset($_GET['Cemetery']) ||
        isset($_GET['ObitSource']) ||
        isset($_GET['SourceDate']))) {

//prevent unwanted characters from harming the SQL database, then pass posted data as a string
        $last = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'Last', FILTER_SANITIZE_STRING));
        $first = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'First', FILTER_SANITIZE_STRING));
        $middle = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'Middle', FILTER_SANITIZE_STRING));
        $maiden = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'Maiden', FILTER_SANITIZE_STRING));
        $deathDate = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'DeathDate', FILTER_SANITIZE_STRING));
        $birthDate = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'BirthDate', FILTER_SANITIZE_STRING));
        $spouse = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'Spouse', FILTER_SANITIZE_STRING));
        $survivedBy = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'SurvivedBy', FILTER_SANITIZE_STRING));
        $other = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'Other', FILTER_SANITIZE_STRING));
        $cemetery = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'Cemetery', FILTER_SANITIZE_STRING));
        $obitSource = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'ObitSource', FILTER_SANITIZE_STRING));
        $sourceDate = mysqli_real_escape_string($db, filter_input(INPUT_GET, 'SourceDate', FILTER_SANITIZE_STRING));
        

    //assigns session superglobals to the user input.
        $_SESSION["Last"] = $last;
        $_SESSION["First"] = $first;
        $_SESSION["Middle"] = $middle;
        $_SESSION["Maiden"] = $maiden;
        $_SESSION["DeathDate"] = $deathDate;
        $_SESSION["BirthDate"] = $birthDate;
        $_SESSION["Spouse"] = $spouse;
        $_SESSION["SurvivedBy"] = $survivedBy;
        $_SESSION["Other"] = $other;
        $_SESSION["Cemetery"] = $cemetery;
        $_SESSION["ObitSource"] = $obitSource;
        $_SESSION["SourceDate"] = $sourceDate;
        
        //let the user view results by redirecting them to search_results.php
    header("Location: search_results.php");

    

    }