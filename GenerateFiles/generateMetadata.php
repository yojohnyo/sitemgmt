<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../includes/databaseConnection.php';
include '../includes/includeFunctions.php';

$conn = dbConnect();
$sql = 'SELECT fileHead, fileEnd, fileSubstitution FROM filecontents WHERE id ="1"';

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$fileHead = $row['fileHead'];
$fileEnd = $row['fileEnd'];
$fileSub = $row['fileSubstitution'];
$subsString = '---SUBSTITUTION---';
$metadata = $fileHead;
$sql = "SELECT folderName FROM sitefolders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $metadata .= "\n\n";
        $metadata .= str_replace($subsString, $row['folderName'], $fileSub);
    }
}
$sql = "SELECT aliasName FROM aliases";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $metadata .= "\n\n";
        $metadata .= str_replace($subsString, $row['aliasName'], $fileSub);
    }
}
connectClose($conn);
// $fileEnd;
$metadata .= $fileEnd;
file_put_contents('../generatedFiles/metadata.xml', $metadata);
//print $metadata;



  