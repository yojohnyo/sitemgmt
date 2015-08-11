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
//Get folder Name
$folderID = $_GET['folderID'];
$conn = dbConnect();
$folderName = getFolderName($conn, $folderID);

if (isset($_POST['aliasName'])) {
    $conn = dbConnect();
    $usedValue = subExists($conn, $_POST['aliasName'],'aliasName', 'aliases');
    if ($usedValue) {
        $message = 'That alias already exist';
    } else {
        $message = addDBPrepare($conn, $_POST['aliasName'], $folderID, 'aliases', 'aliasName', 'folderNameID');
    }
}
include_once 'addPRDAlias.html';