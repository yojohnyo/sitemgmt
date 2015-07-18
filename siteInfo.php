<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include'includes/databaseConnection.php';
include'includes/includeFunctions.php';
include'index.php';

$folderID = $_GET['folderID'];
//print $folderID;
$folderInfo = folderSubInfo($folderID);
$message ='Hello';

$output = '<p><table border="2">'
    . '<tr><td>Folder Name:</td><td>'.$folderInfo['folderName'].'</td></tr>'
    . '<tr><td>Subscription Name:</td><td>'.$folderInfo['subscriptionName'].'</td></tr>'
    . '<tr><td>Aliases:</td><td></td></tr>';

foreach ($folderInfo['aliases'] as $alias){
  $output .= '<tr><td></td><td>'.$alias.'</td></tr>';
}

print $output;

function folderSubInfo($folderID) {
  $conn = dbConnect();
  $sql = 'SELECT sitefolders.folderName, sitefolders.databaseName, subscriptions.subscriptionName ' .
      'FROM subscriptions INNER JOIN sitefolders ON subscriptions.id = sitefolders.subscriptionsID ' .
      'WHERE sitefolders.id = ' . $folderID;

  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $folderInfo = $row;

  $sql = 'SELECT aliases.aliasName FROM aliases WHERE folderNameID = ' . $folderID;
  //print $sql;
  $aliasInfo = array();
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    $aliasInfo[] = $row['aliasName'];
  }
  connectClose($conn);
  $folderInfo['aliases'] = $aliasInfo;
  return $folderInfo;
}
