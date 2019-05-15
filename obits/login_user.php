<?php

/*
 * Ryan Byrd
 * 10/05/2018
 * login.php
 * Login form for using the system as admin
 */

require_once 'includes/header.php';
require_once 'includes/database.php';

//retrieve user name and password from what the user typed into the login fields
if (isset($_POST['username'])) {
    $username = $db->real_escape_string(trim($_POST['username']));
}

//retrieve what the user typed in as a password 
if (isset($_POST['password'])) {
    $password = $db->real_escape_string(trim($_POST['password']));
}

//variable result runs an SQL command to check the user's input on the database
$result = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");

//fetch results if any were found
if (mysqli_num_rows($result) === 1) {

//initialize session variables if a result is found
    while ($row = mysqli_fetch_assoc($result)) {

//get the password the user typed. If they had a matching username, then check if their password also matched.
//the password in the database will also be hashed, so the verify will see if the typed password matches the password hidden by the hashing
        if (password_verify($_POST['password'], $row['password'])) {

//set the username so that it displays in place of the login option
            $_SESSION['username'] = $row['username'];

//set the user's id so the account credentials can be updated (username and password only)
            $_SESSION['id'] = $row['id'];

//set the user's role so that they can access the site with admin privileges.
            $_SESSION['role'] = $row['role'];

//if the admin role is set to 2, send the user to administrator.php
//note: users with a role set to anything else will not be given any administrator privileges
            if (isset($row['role']) && $row['role'] ) {

//redirect users who login to the administrator page.
                header("Location: administrator.php");
            }
        } else {
            //redirect the user to the login_1 failure page if the user has the right username and the wrong password
            header("Location: login_1.php");
        }
    }
} else { //send the user to the login_1 failure page if the user has the wrong username or password
    header("Location: login_1.php");
}

$db->close();




