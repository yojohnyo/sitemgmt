<?php

/* 
 * This page renders a list of site folders potentially filtered.
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$q = "";
//print "value of q: ".isset($_GET['q']);
//Find out what value, if any is filtered on
if (isset($_GET['q'])){
  include'includes/databaseConnection.php';
  if ($_GET['q']!=-1) {
  $q = " AND subscriptions.id = ".intval($_GET['q']);
  } else {
    $q = "";
  }
}
$sql = "SELECT subscriptions.subscriptionName, sitefolders.folderName "
    . "FROM subscriptions INNER JOIN sitefolders "
    . "WHERE subscriptions.id = sitefolders.subscriptionsID ".$q
    . " ORDER BY subscriptions.subscriptionName, sitefolders.folderName";
//print $sql;

$output = '<div id="txtHint"><table border="1">'
    . '<th>Subscription Name</th>'
    . '<th>Folder Name</th>';

$conn = dbConnect();
$result = $conn->query($sql);
if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()) {
    //var_dump($row);
    $output .='<tr>';
    foreach ($row as $key=>$value){
      $output.='<td>'.$value.'</td>';
    }
    $output .='</tr>';
  }
  $output .='</table></div>';
  print $output;
} else {
  $message = "No folders were found";
}
connectClose($conn);

