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
if (isset($_POST['entityID'])) {
    $conn = dbConnect();
    $usedValue = subExists($conn, $_POST['entityID'],'entityID', 'entityid');
    if ($usedValue) {
        $message = 'That Entity ID already exist';
    } else {
        $message = addEntityIDPrepare($conn,$_POST['entityID'], 'entityid', 'entityID');
    }
}
include 'addEntityID.html';


