<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include'includes/databaseConnection.php';
include'includes/includeFunctions.php';
$folderName = $_POST['folderName'];
$conn = dbConnect();
//Get folder ID
$folderID = getID($conn, $folderName, 'folderName', 'siteFolders');
$count = 1;
$message = '';
while (isset($_POST['alias' . $count])) {
  $subName = $_POST['alias' . $count];
  $conn = dbConnect();
  $count += 1;
  //Make sure alias doesn't already exist
  if (subExists($conn, $subName, 'aliasName', 'aliases')) {
    $message.='The alias ' . $subName . ' already exists';
  }
  else {
    $message .= addDBPrepare($conn, $subName, $folderID, 'aliases', 'aliasName', 'folderNameID');
  }
  $message .='<br>';
}
connectClose($conn);
include 'index.php';
