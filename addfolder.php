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
$subInfo = array();
$subInput = '';

$sql = "SELECT * FROM SUBSCRIPTIONS";
$conn = dbConnect();
$result = $conn->query($sql);
if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()) {
    //var_dump($row);
    $subInfo[$row['id']]=$row['subscriptionName'];
    $subInput .='<input type="radio" name="subID" value="'.$row['id'].'">'.$row['subscriptionName'].'<br>';
  }

  //print $subInput;
  //var_dump($subInfo);
  } else {
  echo "No results returned";
}
connectClose($conn);

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
  } elseif ($siteName == '' || $subID == -1) {
      $message = 'That was not a valid entry';
  } else {
    $sql = "INSERT INTO sitefolders (folderName, subscriptionsID) VALUES (?,?)";

  //print $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $siteName, $subID);
    
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


