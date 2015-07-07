<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function subExists($conn, $subName, $columnName, $tableName) {
  $sql = "SELECT ".$columnName." from ".$tableName." where ".$columnName." = ?";
  //print $sql;
  if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s",$subName);
    $stmt->execute();
    $stmt->bind_result($results);
    $stmt->fetch();    
    $stmt->close();
  }
  //$result = $conn->query($sql);
  //var_dump($results);
  if ($results != null) {
    return TRUE;
  } else {
    return FALSE;
  }
}