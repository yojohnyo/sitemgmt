<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  /*include'includes/databaseConnection.php';
  include'includes/includeFunctions.php'; 
include 'verifySubscription.php';*/
print '
  <html>
    <head>
        <title>Site Management Tool</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/the.css" media="screen" />
        <script src="includes/javascriptincludes.js"></script>';
if (isset($jsfile)) {
  print $jsfile;
}
?>

</head>
<body>
  <div id="wrap">
    <div id="top">
      <h2><a href="index.php">Site Management Tool</a></h2>
      <nav>
        <div id="menu">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="addSubscription.php">Add Subscription</a></li>
            <li><a href="addfolder.php">Add Folder</a></li>
            <li><a href="displayFolders.php">Display folder</a></li>
          </ul>
        </div>
      </nav>

    </div>      
    <div id="message">
      <?php
      if (isset($message))
        print $message;
      ?>
    </div>


</body>
</html>
