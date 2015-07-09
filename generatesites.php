<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include'includes/databaseConnection.php';
include'includes/includeFunctions.php';


$conn = dbConnect();
$sql = 'SELECT fileHead, fileEnd, fileSubstitution FROM filecontents WHERE id ="1"';

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$fileHead = $row['fileHead'];
$fileEnd = $row['fileEnd'];
$fileSub = $row['fileSubstitution'];
$subsString = '---SUBSTITUTION---';

$metadata = $fileHead;
//$sql = "SELECT sitefolders.folderName, aliases.aliasName FROM sitefolders LEFT JOIN aliases ON "
//    . "sitefolders.id = aliases.folderNameID";
$sqlFolder = "SELECT folderName, id FROM sitefolders";
print $sqlFolder;
$result = $conn->query($sqlFolder);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    print $row['folderName']."<br>";
    $sqlAlias = "SELECT aliasName FROM aliases WHERE folderNameID = ".$row['id'];
    $aliasResult = $conn->query($sqlAlias);
    if ($aliasResult->num_rows > 0) {
      while ($aliasRow = $aliasResult->fetch_assoc()) {
        print $aliasRow['aliasName']."<br>";
      }
    }
    print "<p>";
  }
}
connectClose($conn);




  