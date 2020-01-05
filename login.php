<?php
/*
This is the landing page of the application. User's can log in or create a new user. 
*/
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <h1>File Share</h1>
    <div class="center">
    <form action="checklogin.php" method="POST">
        <label>Please enter your username:</label>
        <input type="text" name="username" />
        <input type="submit" value="login" />
    </form>
    <p>Don't have a username? <a href="createUser.php">Create a username</a>.</p>
    
    <?php
    // Display errors if there are any
    if (isset($_SESSION['error'])) {
        printf("<p class='error'>%s</p>",$_SESSION['error']);
    }
    ?>
    </div>
</body>

</html>

<?php
// Remove errors so that user doesn't see any errors on initial login. 
unset($_SESSION['error']);
?>