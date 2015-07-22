/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function filterDisplay(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "-1";
                xmlhttp.open("GET","renderdisfolderajax.php?q="+str,true);
        xmlhttp.send();
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","renderdisfolderajax.php?q="+str,true);
        xmlhttp.send();
    }
}

function aliasSuggestions(str) {
    if (str.length == 0) { 
        document.getElementById("aliasSug").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("aliasSug").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "addaliases.php?q=" + str, true);
        xmlhttp.send();
    }
}


