<?php
//start a PHP session that will hold user information. If none is assigned, proceed without admin access.
//admin features are only unlocked if the role is set to 2.

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

error_reporting(0);
@ini_set('display_errors', 0);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>LPLD Obituaries</title>
        <meta charset="utf-8">

        <!--Bootstrap CDN and code for mobile and desktop compatibility.-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--Updated Bootstrap files-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!--My CSS-->
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-light bg-white">

                <!--Put the logo in line with the navigation items.-->
                <ul class="nav nav-tabs">
                    <a class="navbar-brand" href="https://www.lpld.lib.in.us/">
                        <img src="images/logo.jfif" width="120" height="80" alt="logo">
                    </a>    

                    <!--Navigation items that link to different pages.-->
                    <li class="nav-item form-inline">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>

                    <?php

//allow tables who are logged in to add and make changes to records in the table
                    if (isset($_SESSION['role']) == 2) {
                        ?>
                        <li class="nav-item form-inline">
                            <a class="nav-link" href="add.php">Add Record</a>
                        </li>

                        <?php
                    }
//give permission to view user accounts IF the use is an administrator
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 2) {
                        ?>
                        <li class = "nav-item form-inline">
                            <a class = "nav-link" href = "account_list.php">Account List</a>
                        </li>
                        <li class = "nav-item form-inline">
                            <a class = "nav-link" href = "account_create.php">Add Account</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>

                <!--Access login form-->
                <?php
                //prompt the user to log in if they are not. If they are, display the username in a dropdown menu.
                if (isset($_SESSION["username"])) {
                    ?>
                    <div class="dropdown">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            <?php
                            //display the username if logged in
                            echo "Hello, " . $_SESSION["username"];

                            //maintain the session ID of the user so they can edit their account.
                            $_SESSION["id"];
                            ?>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href='edit_account.php?id=<?php echo $_SESSION["id"] ?>'>Edit Account</a>
                            <a class="dropdown-item" href='logout.php'>Logout</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <a class="btn btn-info" href='login.php'>Login</a>
                    <?php
                }
                ?>

            </nav>
        </div>