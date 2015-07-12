<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include'includes/databaseConnection.php';
include'includes/includeFunctions.php';
include 'index.php';

//check to see if it needs to display add subscription form

$message = '';

if (!isset($_REQUEST) || count($_REQUEST)==0) {
  include 'addSubscription.html';
} else {
  $subName = $_POST['subscriptionName'];
  $conn = dbConnect();
  if (subExists($conn, $subName, 'subscriptionName', 'subscriptions')) {
      $message = 'That subscription already exists';
  } else {  
    $sql = "INSERT INTO subscriptions (subscriptionName) VALUES (?)";

  //print $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $subName);
    
    if ($stmt->execute()==TRUE) {
      //$last_id = $conn->insert_id; 
      $message = "Subscription successfully added";
    }else{
      $message = "Ooops. There was a problem adding the subscription";
    }
    $stmt->close();
  }
  include 'addSubscription.html';
}


