<?php
/*
This is the "home page" of the application. This is where the user can view, upload and delete files. The user can also log out from this page. 
*/
session_start();
// Check to see that a user is logged in before loading the page. 
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "You must be logged in to acceszs that page. Please login.";
    header("Location: login.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <title>Home Page</title>
</head>

<body>
    <div class="center">
    <?php


    // use preg_grep function to remove hidden files. 
    $files = preg_grep('/^([^.])/', scandir("/home/austintolani/filesharing/" . $_SESSION['user']));

    printf("<h2>Welcome %s!</h2>\n",htmlentities($_SESSION['user']));
    //List all of the files in the user's directory
    printf("<h3>Your Files:</h3>\n");
    foreach ($files as $file) {
        if (preg_match('/^[\w_\.\-]+$/', $file)) {
            printf("<div class='file'>\n%s  <a href=viewfile.php?file=%s>view</a>\n<a href=deleter.php?file=%s class='delete'>%s</a>\n</div>", $file, $file, $file, "delete");
        }
    }
    ?>
    <!-- Form to create new upload -->
    <h3>Upload Files:</h3>
    <form enctype="multipart/form-data" action="uploader.php" method="POST">
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
            <label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
        </p>
        <p>
            <input type="submit" value="Upload File" />
        </p>
    </form>
    <!-- Allow user to log out -->
    <p class="center"><a href="logout.php" >Logout</a></p>
    </div>
</body>

</html>