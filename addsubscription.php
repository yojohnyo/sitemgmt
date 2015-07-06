<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include'includes/databaseConnection.php';

//check to see if it needs to display add subscription form

$message = '';

if (!isset($_REQUEST) || count($_REQUEST)==0) {
  include 'addSubscription.html';
} else {
  $subName = $_POST['subscriptionName'];
  $conn = dbConnect();
  if (subExists($conn, $subName)) {
      $message = 'That subscription already exists';
  } else {  
    $sql = "INSERT INTO subscriptions (subscriptionName) VALUES ('"
      .$subName."')";

  //print $sql;
  
    if ($conn->query($sql)==TRUE) {
      $last_id = $conn->insert_id; 
      $message = "Subscription successfully added";
    }else{
      $message = "Ooops. There was a problem adding the subscription";
    }
  }
  include 'addSubscription.html';
}


function subExists($conn, $subName) {
  $sql = "SELECT subscriptionName from subscriptions where subscriptionName = '".$subName."'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}