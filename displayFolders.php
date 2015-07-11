<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include'includes/databaseConnection.php';
include'includes/includeFunctions.php';

$sql = "SELECT subscriptions.subscriptionName, sitefolders.folderName "
    . "FROM subscriptions INNER JOIN sitefolders "
    . "WHERE subscriptions.id = sitefolders.subscriptionsID "
    . "ORDER BY subscriptions.subscriptionName";
//print $sql;
include 'index.php';

$output = '<table border="1">'
    . '<th>Subscription Name</th>'
    . '<th>Folder Name</th>';

$conn = dbConnect();
$result = $conn->query($sql);
if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()) {
    //var_dump($row);
    $output .='<tr>';
    foreach ($row as $key=>$value){
      $output.='<td>'.$value.'</td>';
    }
    $output .='</tr>';
  }
  $output .='</table>';
  print $output;
} else {
  $message = "No folders were found";
}
