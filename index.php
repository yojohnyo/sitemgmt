<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

print '
  <html>
    <head>
        <title>Site Management Tool</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="includes/javascriptincludes.js"></script>';
        if (isset($jsfile)) {
          print $jsfile;
        }
print '
    </head>
    <body>
        <div>';
if (isset ($message)) print $message;
include"headerfile.html";

print '</div>
        
    </body>
</html>';