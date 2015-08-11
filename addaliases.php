<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Foldername called, assume coming from add folder
//Render the input text fields
print '<span id="aliasSug">';
if (isset($_REQUEST["q"])) {
    $newSiteName = $_REQUEST["q"];
    $titleMsg = '<h1> Adding aliases for ' . $newSiteName . '</h1>';
    $dbName = str_replace('-', '_', strtok($newSiteName, "."));
    $devAlias = preg_replace('/\./', '-dev.', $newSiteName, 1);
    $stgAlias = preg_replace('/\./', '-stg.', $newSiteName, 1);
    $output = '<p>Please verify the database name: <input type="text" name="database" value="' . $dbName . '">';
    $output .= '<p>Please enter the dev alias: <input type="text" name="alias1" value="' . $devAlias . '">';
    $output .= '<p>Please enter the stg alias: <input type="text" name="alias2" value="' . $stgAlias . '">';
    //$output .= '<input type="hidden" name="folderName" value="' . $folderName . '"><p>';
    $output .= '</span></p>';
    $output .= '<input type="submit" name="Add Folder" value="Add Folder">';
    print $output;
}
