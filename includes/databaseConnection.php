<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function dbConnect(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "sitemgmt";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  //echo "Connected successfully";
  return $conn;
}


function connectClose($conn) {
$conn->close();
}
