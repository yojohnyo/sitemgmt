<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 8/9/2015
 * Time: 2:43 PM
 */

include_once'includes/databaseConnection.php';
include_once'includes/includeFunctions.php';
//include'javascriptincludes.js';
include_once 'index.php';
$message = '';
if (isset($_POST['ownerEmail'])) {
    $conn = dbConnect();
    $usedValue = subExists($conn, $_POST['ownerEmail'],'ownerEmail', 'siteOwners');
    if ($usedValue) {
        $message = 'An owner with that email address already exists';
    } else {
        $message = addSiteOwnerPrepare($conn, $_POST['firstName'], $_POST['lastName'], $_POST['ownerEmail'], $_POST['dept']);
    }
}
include 'addSiteOwner.html';


