<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include'includes/databaseConnection.php';
include'includes/includeFunctions.php'; 
include 'verifySubscription.php';


//check to see if it needs to display add subscription form

$message = '';
print isset($_POST['add']);
if (!isset($_POST['add'])) {
    $message = newSubs();
    include 'index.php';
    include 'addSubscription.html';

}else{
  $form_input = $_POST;

//var_dump($form_input);

if ($form_input['add'] == 'Yes') {
  $conn = dbConnect();
  $subs = getAcquiaSubInfo();
  foreach ($subs as $newSub) {
    $message .= writeToTable($newSub, $conn);
  }
} else {
  $message = 'No subscriptions were added';
}

include 'index.php';
}

//$conn = connect();
function writeToTable($subscriptionName, $conn){

  $sql = "INSERT INTO subscriptions (subscriptionName) VALUES"
    . "('".$subscriptionName."')";

  if ($conn->query($sql)==TRUE) {
    $last_id = $conn->insert_id; 
    return $subscriptionName.' successfully added<br>';
  }else{
    return "Failure";
  }
}

/*if (!isset($_REQUEST) || count($_REQUEST)==0) {
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
}*/


