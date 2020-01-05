<!DOCTYPE html>
<!-- 

This is the html page that allows users to create a new username. The php script in this page checks to see if the inputted username 
contains valid characters, doesn't already exist and then creates a new user by creating a new directory and appending to users.txt. 
 -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>Please enter your new username. A username must:</label>
        <ul>
            <li>Only contain valid characters</li>
            <li>Be between 8 to 20 characters</li>
        </ul>
        
        <input type="text" name="newUsername">
        <input type="submit" name="submit" value="Create User">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        // check to see if valid input
        if (!preg_match('/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/', (string) $_POST['newUsername'])) {
            echo "Username invalid. Please try again.";
            exit;
        }
        $newUsername = (string) $_POST['newUsername'];
        // check to see if username already exists
        $users = file('/home/austintolani/filesharing/users.txt', FILE_IGNORE_NEW_LINES);
        if (in_array($newUsername, $users)) {
            echo "Username already exists.";
            exit;
        }
        // create user
        $usersContent = file_get_contents('/home/austintolani/filesharing/users.txt');
        $usersContent .= $newUsername . "\n";

        file_put_contents('/home/austintolani/filesharing/users.txt', $usersContent); // append to users.txt
        mkdir('/home/austintolani/filesharing/' . $newUsername); // make a new directory 

        session_start();
        $_SESSION['user'] = $newUsername; //start session with username set
        echo "User succesfully created.";
        echo "<a href=home.php>Click here to log in.</a>"; //create link to login


    }
    ?>
</body>

</html>