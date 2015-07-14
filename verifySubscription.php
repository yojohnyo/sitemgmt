<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//include'includes/databaseConnection.php';
//include'includes/includeFunctions.php';
//include 'index.php';

//This function connects to the Acquia network and gets a list of subscriptions
function getAcquiaSubInfo() {
  include'includes/acquiaCredential.php';

//set up curl
// create curl resource 
  $ch = curl_init();
  $url_for_site = "https://cloudapi.acquia.com/v1/sites.json";
  // set credentials
  curl_setopt($ch, CURLOPT_USERPWD, $username_key);

  // set url 
  curl_setopt($ch, CURLOPT_URL, $url_for_site);
  //return the transfer as a string 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  // $output contains the output string 
  $output = curl_exec($ch);
  $curl_info = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
  //print curl_error($ch)."<br>";
  //print $ch."<br>";
  //print $output."<br>";
  curl_close($ch);
  $replace_array = array('"', '[', ']', 'devcloud:');
  $clean_output = str_replace($replace_array, '', $output);
  $subs = explode(',', $clean_output);
  /*foreach ($subs as $value) {
    print $value . "<br>";
  }*/
  return $subs;
  //print $curl_info;
  // close curl resource to free up system resources 
}

//This function uses a combination of other functions to determine if there are new
//subscriptions available, if yes, offers to add to DB
function newSubs() {

  $acquiaSubs = getAcquiaSubInfo();
  $newSubs = array();
  $conn = dbConnect();
  foreach ($acquiaSubs as $sub) {
    if (!subExists($conn, $sub, 'subscriptionName', 'subscriptions')) {
      array_push($newSubs, $sub);
    }
  }
  connectClose($conn);
  if (count($newSubs) < 1) {
    //return "There are no new subscriptions to be added";
    return -1;
  }
  else {
    $message = 'The following subs have not yet been recorded:';
    $message .='<ul>';
    foreach ($newSubs as $sub) {
      $message .= '<li>' . $sub . '</li>';
    }
    $message .= '</ul>';
    //include 'addSubscription.html';
    return $message;
}
}

//newSubs();
