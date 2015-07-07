<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include'includes/databaseConnection.php';
include'includes/includeFunctions.php';

//check to see if it needs to display add subscription form

$message = '';

if (!isset($_REQUEST) || count($_REQUEST)==0) {
  include 'addfolder.html';
} else {

  $siteName = $_POST['folderName'];
  $conn = dbConnect();
  if (subExists($conn, $siteName, 'folderName', 'sitefolders')) {
      $message = 'That siteFolder already exists';
  } else {  
    $sql = "INSERT INTO sitefolders (folderName) VALUES (?)";

  //print $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $siteName);
    
    if ($stmt->execute()==TRUE) {
      //$last_id = $conn->insert_id; 
      $message = "Site folder successfully added";
    }else{
      $message = "Ooops. There was a problem adding the siteFolder";
    }
    $stmt->close();
  }
  include 'addfolder.html';
}


