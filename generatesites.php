<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include'includes/databaseConnection.php';
include'includes/includeFunctions.php';


$conn = dbConnect();
$sql = 'SELECT id, subscriptionName FROM subscriptions';
$subResult = $conn->query($sql);
while ($subRow = $subResult->fetch_assoc()) {
//Get file contents from database
  print "\n------" . $subRow['subscriptionName'] . "--------\n";
  $sql = 'SELECT fileHead, fileEnd, fileSubstitution FROM filecontents WHERE id ="2"';

  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $fileHead = $row['fileHead'];
  $fileEnd = $row['fileEnd'];
  $fileSub = $row['fileSubstitution'];
  $subsString = '---FOLDERNAME---'; //substitution string

  //Add file head
  $siteFile = $fileHead . "\n";
//$sql = "SELECT sitefolders.folderName, aliases.aliasName FROM sitefolders LEFT JOIN aliases ON "
//    . "sitefolders.id = aliases.folderNameID";
  $sqlFolder = "SELECT folderName, id FROM sitefolders WHERE subscriptionsID = " . $subRow['id'];
  //print $fileSub;
  $result = $conn->query($sqlFolder);

  if ($result->num_rows > 0) {
    //Loop to add site folder
    while ($row = $result->fetch_assoc()) {
      $siteFile .= str_replace($subsString, $row['folderName'], $fileSub);
      //print $siteFile."<br>";
      $sqlAlias = "SELECT aliasName FROM aliases WHERE folderNameID = " . $row['id'];
      $aliasResult = $conn->query($sqlAlias);
      if ($aliasResult->num_rows > 0) {
        //Loop to add alias
        while ($aliasRow = $aliasResult->fetch_assoc()) {
          $siteFile .= "\n      '" . $aliasRow['aliasName'] . "',";
          //print $aliasRow['aliasName']."<br>";
        }
      }
      $siteFile .= "\n    ),\n  ),\n";
    }
  }
  $siteFile .= $fileEnd;
  print $siteFile;
}
connectClose($conn);




