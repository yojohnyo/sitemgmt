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

  if ($folderName == '') {
    include 'getfoldername.html';
  }
  else {
    //Foldername called, assume coming from add folder
    //Render the input text fields
    $titleMsg = '<h1> Adding aliases for ' . $folderName . '</h1>';
    $dbName = str_replace('-','_',strtok($folderName, "."));
    $devAlias = preg_replace('/\./', '-dev.', $folderName, 1);
    $stgAlias = preg_replace('/\./', '-stg.', $folderName, 1);
    $output = '<p>Please verify the database name: <input type="text" name="database" value="'.$dbName.'">';
    $output .= '<p>Please enter the dev alias: <input type="text" name="alias1" value="' . $devAlias . '">';
    $output .= '<p>Please enter the stg alias: <input type="text" name="alias2" value="' . $stgAlias . '">';
    $output .= '<input type="hidden" name="folderName" value="' . $folderName . '">';
    include 'getdevaliases.html';
  }
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
  $stmt->bind_param("ss", $name, $id);

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
