
<?php
/*
Once a username is submitted, this php file performs the following fucntions:
    1) Checks to see that the inputted string contains valid characters (FIEO philosophy).
    2) Checks to see if the username matches those in users.txt. If it does, the user is directed to the main page, if not, the user is redirected to the login page with an error. 
*/
session_start();

// Check to see if the input contains valid characters. 
if (!preg_match('/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/', (string) $_POST['username'])) {
    $_SESSION['error'] = "Username contains invalid characters. Please try again.";
    header("Location: login.php");
    exit;
}

$username = (string) $_POST['username'];
$users = file('/home/austintolani/filesharing/users.txt', FILE_IGNORE_NEW_LINES);

// Username not found, redirect to login page and show error message
if (!in_array($username, $users)) {
    $_SESSION['error'] = "Incorrect username provided, please try again.";
    header("Location: login.php");
    exit;
}
// Username found, redirect to main page
else {
    $_SESSION['user'] = $username; // set session username
    header("Location: home.php");
    exit;
}
