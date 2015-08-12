<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Check if an entity already exists in the DB
//Takes in connection string, entity, column name, tableName
function subExists($conn, $subName, $columnName, $tableName) {
  $sql = "SELECT " . $columnName . " from " . $tableName . " where " . $columnName . " = ?";
  //print $sql;
  if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $subName);
    $stmt->execute();
    $stmt->bind_result($results);
    $stmt->fetch();
    $stmt->close();
  }
  //$result = $conn->query($sql);
  //var_dump($results);
  if ($results != null) {
    return TRUE;
  }
  else {
    return FALSE;
  }
}

function addAliases($folderName = '', $message = '') {

  
    //Foldername called, assume coming from add folder
    //Render the input text fields
    if (isset($_REQUEST["q"])) {
      $q = $_REQUEST["q"];
      var_dump($q);
    }
    $titleMsg = '<h1> Adding aliases for ' . $folderName . '</h1>';
    $dbName = str_replace('-','_',strtok($folderName, "."));
    $devAlias = preg_replace('/\./', '-dev.', $folderName, 1);
    $stgAlias = preg_replace('/\./', '-stg.', $folderName, 1);
    $output = '<p>Please verify the database name: <input type="text" name="database" value="'.$dbName.'">';
    $output .= '<p>Please enter the dev alias: <input type="text" name="alias1" value="' . $devAlias . '">';
    $output .= '<p>Please enter the stg alias: <input type="text" name="alias2" value="' . $stgAlias . '">';
    $output .= '<input type="hidden" name="folderName" value="' . $folderName . '"><p>';
    print $output;
    //include 'getdevaliases.html';
}

function getID($conn, $folderName, $column, $table) {
  $sql = "SELECT id FROM " . $table . " WHERE " . $column . " = '" . $folderName . "'";
  //print $sql;
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $folderID = $row['id'];
  //print $folderID;
  return $folderID;
}

function addDBPrepare($conn, $name, $id, $table, $nameColumn, $idColumn) {
  //insert the new folder name $siteName to subscription ID $subID
  $sql = "INSERT INTO " . $table . " (" . $nameColumn . ", " . $idColumn . ") VALUES (?,?)";
  //print $sql;
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $name, $id);

  if ($stmt->execute() == TRUE) {
    //$last_id = $conn->insert_id; 
    $message = $name . " successfully added";
  }
  else {
    $message = "Ooops. There was a problem adding this";
  }
  $stmt->close();
  return $message;
}

function addSitePrepare($conn, $name, $id, $repo, $ownerID, $database) {
  //insert the new folder name $siteName to subscription ID $subID
  //print $id." ".$database." - ".$name."<br>";
  $sql = "INSERT INTO sitefolders (folderName, subscriptionsID, databaseName, ownerID, repositoryName) VALUES (?,?,?,?,?)";
  //print $sql;
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sisis", $name, $id, $database,$ownerID, $repo);

  if ($stmt->execute() == TRUE) {
    //$last_id = $conn->insert_id; 
    $message = $name . " successfully added";
  }
  else {
    $message = "Ooops. There was a problem adding the siteFolder";
  }
  $stmt->close();
  return $message;
}

function updateDBPrepare($conn, $name, $id, $table, $nameColumn, $idColumn) {
  //insert the new folder name $siteName to subscription ID $subID
  $sql = "UPDATE ".$table." SET ". $nameColumn . "= ? WHERE " . $idColumn . " = ?";
  print $sql;
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $name, $id);

  if ($stmt->execute() == TRUE) {
    //$last_id = $conn->insert_id; 
    $message = $name . " successfully added";
  }
  else {
    $message = "Ooops. There was a problem adding the siteFolder";
  }
  $stmt->close();
  return $message;
}

function getSubs() {
  $message = '';
  $subInfo = array();
  $subInput = '';

//Get the list of subscriptions for HTML form
  $sql = "SELECT * FROM SUBSCRIPTIONS";
  $conn = dbConnect();
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      //var_dump($row);
      $subInfo[$row['id']] = $row['subscriptionName'];
      $subInput .='<input type="radio" name="subID" value="' . $row['id'] . '">' . $row['subscriptionName'] . '<br>';
    }

    //print $subInput;
    //var_dump($subInfo);
  }
  else {
    echo "No results returned";
  }
  connectClose($conn);
  return $subInput;
}


function writeDBtoAcquia($dbName, $subName) {

      include('includes/acquiaCredentials.php');

  $postfields = array('db' => $dbName);
  $url_for_site = "https://cloudapi.acquia.com/v1/sites/devcloud:".$subName."/dbs.json";
  $json_data = json_encode($postfields);

  //Set as post
  //curl_setopt($ch, CURLOPT_POST, true);
  $ch = curl_init($url_for_site);
  // set credentials
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
  curl_setopt($ch, CURLOPT_HTTPAUTH, TRUE);
  curl_setopt($ch, CURLOPT_USERPWD, $username_key);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json;charset=utf-8',
    'Content-Length: ' . strlen($json_data))
  );
  //return the transfer as a string 
  // $output contains the output string 
  $output = curl_exec($ch);
  $curl_info = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
  //Check results
  if ($output) {
    $returnString = "DB Add successful";
  }
  else {
    $returnString = "DB add failed";
  }
  // close curl resource to free up system resources 
  curl_close($ch);
  return $returnString;
}

function addEntityIDPrepare($conn, $name, $table, $nameColumn) {
  //insert the new folder name $siteName to subscription ID $subID
  $sql = "INSERT INTO " . $table . " (" . $nameColumn . ") VALUES (?)";
  //print $sql;
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $name);

  if ($stmt->execute() == TRUE) {
    //$last_id = $conn->insert_id;
    $message = $name . " successfully added";
  }
  else {
    $message = "Ooops. There was a problem adding the siteFolder";
  }
  $stmt->close();
  return $message;
}

function getFolderName($conn, $folderID) {
    $sql = "SELECT folderName FROM sitefolders WHERE id = ".$folderID;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $folderName = $row['folderName'];
    //print $folderID;
    return $folderName;
}

function addSiteOwnerPrepare($conn, $ownerFirstName, $ownerLastName, $ownerEmail, $ownerDept) {
    //insert the new folder name $siteName to subscription ID $subID
    //print $id." ".$database." - ".$name."<br>";
    $sql = "INSERT INTO siteowners (ownerFirstName, ownerLastName, ownerEmail, ownerDept) VALUES (?,?,?,?)";
    //print $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $ownerFirstName, $ownerLastName, $ownerEmail, $ownerDept);

    if ($stmt->execute() == TRUE) {
        //$last_id = $conn->insert_id;
        $message = "The Site Owner ".$ownerFirstName . " ". $ownerLastName ." successfully added";
    }
    else {
        $message = "Ooops. There was a problem adding the siteFolder";
    }
    $stmt->close();
    return $message;
}