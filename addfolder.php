<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include'includes/databaseConnection.php';
include'includes/includeFunctions.php';
include'headerfile.html';
//include'addAliases.php';

//check to see if it needs to display add subscription form

$message = '';

//If first time on page, render the page
if (!isset($_REQUEST) || count($_REQUEST)==0) {
  include 'addfolder.html';
} else {

  $siteName = $_POST['folderName'];
  
  // Check for case where no radio button selected
  if (!isset($_POST['subID'])) {
    $subID =-1;
  } else {
    $subID = $_POST['subID'];
  }
  $conn = dbConnect();
  //Verify the folder doesn't already exist
  if (subExists($conn, $siteName, 'folderName', 'sitefolders')) {
      $message = 'That siteolder already exists';
      include 'addfolder.html';
  } elseif ($siteName == '' || $subID == -1) {
      $message = 'That was not a valid entry';
      include 'addfolder.html';
  } else {
$message = addDBPrepare($conn, $siteName, $subID, 'siteFolders', 'folderName', 'subscriptionsID');
//Since adding a folder should always include adding aliases, call function to add aliases
  addAliases($siteName,$message);
  
  }
  connectClose($conn);
  //include 'addfolder.html';
}


