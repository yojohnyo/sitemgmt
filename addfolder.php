<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'includes/databaseConnection.php';
include_once 'includes/includeFunctions.php';
include_once 'index.php';
//include'addAliases.php';

//check to see if it needs to display add subscription form

$message = '';

//If first time on page, render the page
if (isset($_REQUEST) && count($_REQUEST) != 0) {
    // Check to make sure there are no duplicate records
    $returnValue = True;
    //var_dump($_POST);
    $conn = dbConnect();
    foreach ($_POST as $key => $value) {
        switch ($key) {
            case 'folderName':
                $folderName = strtolower($value);
                if (subExists($conn, $folderName, 'folderName', 'sitefolders')) {
                    $message .= 'The sitefolder ' . $folderName . ' already exists<br>';
                    $returnValue = False;
                }
                break;
            case 'database':
                $dbName = strtolower($value);
                if (subExists($conn, $dbName, 'databaseName', 'sitefolders')) {
                    $message .= 'The database: ' . $dbName . ' already exists<br>';
                    $returnValue = False;
                }
                break;
            case 'alias1':
                $alias1 = strtolower($value);
                if (subExists($conn, $alias1, 'aliasName', 'aliases')) {
                    $message .= 'The alias: ' . $alias1 . ' already exists<br>';
                    $returnValue = False;
                }
                break;
            case 'alias2':
                $alias2 = strtolower($value);
                if (subExists($conn, $alias2, 'aliasName', 'aliases')) {
                    $message .= 'The alias: ' . $alias2 . ' already exists<br>';
                    $returnValue = False;
                }
                break;
            case 'ownerEmail':
                $ownerEmail = strtolower($value);
                if (!subExists($conn, $ownerEmail, 'ownerEmail', 'siteowners')) {
                    $message .= 'The site owners email is not yet in the system.  The owner information <a href = "addSiteOwner.php">' .
                        'needs to be entered</a> before the site can be added.<br>';
                    $returnValue = False;

                } elseif (!filter_var($ownerEmail, FILTER_VALIDATE_EMAIL)) {
                    $message .= 'The email address you entered is not valid.<br>';
                    $returnValue = False;
                } else {
                    $ownerID = getID($conn, $ownerEmail, 'ownerEmail', 'siteowners');
                }

        }
    }
    connectClose($conn);

    //Verify all required values are entered
    if ((!isset($_POST['subID'])) || (!isset($_POST['folderName'])) || ($_POST['database'] == '') ||
        ($_POST['alias1'] == '') || $_POST['alias2'] == '' || $_POST['ownerEmail'] == ''
    ) {
        $message .= 'A required value is missing';
        $returnValue = False;
    }

    //If all no problems were found with the form entries
    if ($returnValue) {
        $conn = dbConnect();
        //Write values to siteFolder table
        $message .= addSitePrepare($conn, $folderName, $_POST['subID'], $_POST['repoName'], $ownerID, $dbName) . '<br>';
        //Write aliases to siteFolder table
        $folderID = getID($conn, $folderName, 'folderName', 'sitefolders');
        //print 'folderName '.$folderID;
        $message .= addDBPrepare($conn, $alias1, $folderID, 'aliases', 'aliasName', 'folderNameID') . '<br>';
        $message .= addDBPrepare($conn, $alias2, $folderID, 'aliases', 'aliasName', 'folderNameID') . '<br>';
        connectClose($conn);
        //  print $message;
    }
    //include 'index.php';
}
include 'addfolder.html';

