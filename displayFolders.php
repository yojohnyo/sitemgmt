<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include'includes/databaseConnection.php';
include'includes/includeFunctions.php';
//include'javascriptincludes.js';
include 'index.php';

//Generate list of subscriptions to display
$sql = "SELECT subscriptionName, id FROM subscriptions";

$conn = dbConnect();
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $output = 'Filter on subscription: <select onchange="filterDisplay(this.value)">'
      . '<option value="-1">None</option>';
  while ($row = $result->fetch_assoc()) {
    $output.='<option value="'.$row['id'].'">'.$row['subscriptionName'].'</option>';
  }
  $output .='</select>';
}
print $output;
connectClose($conn);
//Need to separate rendering of the page so when AJAX is called, this page isn't rendered again
include 'renderdisfolderajax.php';