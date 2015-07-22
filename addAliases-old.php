<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include'includes/databaseConnection.php';
include'includes/includeFunctions.php';

$conn = dbConnect();

//If the foldername is passed, get folder info
if (isset($_POST['folderName'])) {
  $folderName = $_POST['folderName'];
  //Get folder ID
  $folderID = getID($conn, $folderName, 'folderName', 'siteFolders');
}

$count = 1;
$message = '';
$validEntry = True;
//Check for valid entries in the aliases
while (isset($_POST['alias' . $count])) {
$subName = $_POST['alias' . $count];
$conn = dbConnect();
$count += 1;
//Make sure alias doesn't already exist
if (subExists($conn, $subName, 'aliasName', 'aliases')) {
  $validEntry = False;
  $message.='The alias ' . $subName . ' already exists';
}
$message .='<br>';
}

//Check for valid database entry
if (isset($_POST['database'])) {
  $dbName = $_POST['database'];
  //Verify db doesn't already exist
  if (subExists($conn, $dbName, 'databaseName', 'sitefolders')) {
    $validEntry = False;
    $message .= "The database already exists";
  }
}

//If the aliases or db are not valid, return to the alias entry screen
if (!$validEntry){
  connectClose($conn);
  addAliases($folderName, $message);
} else {
  //For valid entries put the alias + DB (if necessary) into the database
  $count = 1;
  while (isset($_POST['alias'.$count])) {
    $subName = $_POST['alias' . $count];
    $conn = dbConnect();
    $count += 1;
    $message .= addDBPrepare($conn, $subName, $folderID, 'aliases', 'aliasName', 'folderNameID');
    
  }
  if (isset($_POST['database'])) {
    $dbName = $_POST['database'];
    //@todo ----needs update not insert
    $message .=updateDBPrepare($conn, $dbName, $folderID, 'sitefolders', 'databaseName', 'id');
  }
  connectClose($conn);
  include 'index.php';
}

