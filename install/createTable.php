<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// sql to create table

include('databaseConnection.php');

$conn = dbConnect();
$sqlSub = "CREATE TABLE subscriptions (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
subscriptionName VARCHAR(30) NOT NULL,
create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$sqlFolder = "CREATE TABLE siteFolders ("
    . "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
    . "folderName VARCHAR(30) NOT NULL,"
    . "subscriptionsID INT(6) NOT NULL,"
    . "databaseName VARCHAR(30) NOT NULL,"
    . "repositoryName VARCHAR(30),"
    . "launchDate TIMESTAMP,"
    . "create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
    . ")";

$sqlAlias = "CREATE TABLE aliases ("
    . "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
    . "aliasName VARCHAR(30) NOT NULL,"
    . "folderNameID INT(6) NOT NULL,"
    . "create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
    . ")";

$sqlFileContents = "CREATE TABLE fileContents ("
    . "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
    . "fileHead LONGTEXT NOT NULL,"
    . "fileEnd LONGTEXT NOT NULL,"
    . "fileSubstitution LONGTEXT NOT NULL,"
    . "create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
    . ")";

$sqlAlias = "CREATE TABLE siteOwners ("
    . "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
    . "ownerName VARCHAR(30) NOT NULL,"
    . "ownerEmail VARCHAR(30) NOT NULL,"
    . "ownerDept VARCHAR(30) NOT NULL,"
    . "create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
    . ")";

$sqlEntityID = "CREATE TABLE entityID (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
entityID VARCHAR(30) NOT NULL)";

if ($conn->query($sqlSub) === TRUE && $conn->query($sqlFolder) === TRUE && $conn->query($sqlAlias)
    && $conn->query($sqlFolder)) { 
  echo "Tables created successfully ";
} else {
    echo "Error creating table: " . $conn->error;
}
connectClose($conn);

