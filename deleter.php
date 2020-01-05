<?php
/*
This php script runs once a user specifies that they would like to delete a file. This script deletes the file from the directory on the instance. 
*/
session_start();
// Find the path of the file
$username = $_SESSION['user'];
$file = $_GET['file'];
$filepath = sprintf("/home/austintolani/filesharing/%s/%s",$username,$file);

// Delete the file
if (unlink($filepath)){
    //redirect to home page
    header("Location: home.php");
    exit;

}
// Direct to an error page just in case
else{
    header("Location: failure.html");
	exit; 
}
