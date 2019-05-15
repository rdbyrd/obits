<?php
/*
 * Ryan Byrd
 * 10/05/2018
 * login.php
 * Login form for using the system as admin
 */

//get files to start session
require_once('includes/database.php');
require_once('includes/header.php');
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Local History Obituaries</h1>
        <h2>Log in</h2>
    </div>
</div>

<!--Format the page to have all content contained towards the center and left-aligned.-->
<div class='container'>
    <div class='row'>
        <div class = 'col-md-6'>    
            <form method='post' action='login_user.php'>
                
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" placeholder="Username" autofocus required>
                <br/>

                <label for="password">Password:</label>
                <input type='password' class="form-control" name='password' placeholder="Password" required>
                <br/>

                <input type='submit' class="btn btn-success btn-block" value='Login'>
                <input type="button" class="btn btn-info btn-block" name="Cancel" value="Cancel" onclick="window.location.href = 'home.php'" />                      

            </form>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.php';