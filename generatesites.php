<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include'includes/databaseConnection.php';
include'includes/includeFunctions.php';


$conn = dbConnect();

//Get file contents from database
$sql = 'SELECT fileHead, fileEnd, fileSubstitution FROM filecontents WHERE id ="2"';

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$fileHead = $row['fileHead'];
$fileEnd = $row['fileEnd'];
$fileSub = $row['fileSubstitution'];
$subsString = '---FOLDERNAME---'; //substitution string

$siteFile = $fileHead."\n";
//$sql = "SELECT sitefolders.folderName, aliases.aliasName FROM sitefolders LEFT JOIN aliases ON "
//    . "sitefolders.id = aliases.folderNameID";
$sqlFolder = "SELECT folderName, id FROM sitefolders";
print $fileSub;
$result = $conn->query($sqlFolder);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $siteFile .= str_replace($subsString, $row['folderName'], $fileSub);
    //print $siteFile."<br>";
    $sqlAlias = "SELECT aliasName FROM aliases WHERE folderNameID = ".$row['id'];
    $aliasResult = $conn->query($sqlAlias);
    if ($aliasResult->num_rows > 0) {
      while ($aliasRow = $aliasResult->fetch_assoc()) {
        $siteFile .= "\n      '".$aliasRow['aliasName']."',";
        //print $aliasRow['aliasName']."<br>";
      }
    }
    $siteFile .= "\n    ),\n  ),\n";
  }
}
print $siteFile;
connectClose($conn);




  