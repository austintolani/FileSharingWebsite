<?php
/*
This script runs when the user opts to view a file. IT gets the file from the server and displays it. 
*/
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "You must be logged in to access that page. Please login.";
    header("Location: login.php");
} // check to make sure the user is logged in
// Path to file on server
$fullPath = sprintf("/home/austintolani/filesharing/%s/%s",$_SESSION['user'],$_GET['file']);
//Get MIME Type
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($fullPath);
header("Content-Type: ".$mime);
//Display file
readfile($fullPath);
?>
    
