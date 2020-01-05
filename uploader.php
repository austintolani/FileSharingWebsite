<?php
/*
This script runs once a user specifies to upload a file. It checks to make sure that the filename is valid and then
saves it to the user's directory. 
*/
session_start();

// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}

$username = $_SESSION['user'];

//Create path for file
$full_path = sprintf("/home/austintolani/filesharing/%s/%s", $username, $filename);

//Save file to the user's directory. 
if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
	header("Location: home.php");
	exit;
}
else{
    // Redirect to failure page just in case. 
	header("Location: failure.html");
	exit;
}
