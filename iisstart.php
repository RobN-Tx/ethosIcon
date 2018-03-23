
<!DOCTYPE html>

<head>
<?php
//start a session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//now the includes - which for this sheet is currently just the header itself
include $_SERVER['DOCUMENT_ROOT']."/public/header.php";
       
        ?>

<!--This is all of the link pieces, including nice icons to svae the website to home screen -->
<LINK REL="SHORTCUT ICON" HREF="/images/favicon.ico">
<link rel="apple-touch-startup-image" href="/images/splash750x1334.png">
<link rel="apple-touch-icon" sizes="120x120" href="/images/appicon120.png">
<link rel="icon" sizes="57x57" href="/images/appicon57.png">
<link rel="icon" sizes="72x72" href="/images/appicon72.png"> 
<link rel="icon" sizes="76x76" href="/images/appicon76.png">
<link rel="icon" sizes="114x114" href="/images/appicon114.png">
<link rel="icon" sizes="128x128" href="/images/appicon128.png">
<link rel="icon" sizes="144x144" href="/images/appicon144.png">
<link rel="icon" sizes="152x152" href="/images/appicon152.png">
<title>EthosEnergy Icon</title>
<style type="text/css"></style>
<style>

</style>
</head>
<body>





<?php

$regUser = "registeredUser";

if (isset($_SESSION["oid"])){
$azureOID = $_SESSION["oid"];
}

if (!isset($_SESSION["$regUser"])) {
    include "notLoggedInContent.php";
            //;
} elseif (($_SESSION["$regUser"] =="yes") and (DirectoryfetchSQLColumnData("oid", $azureOID, "iconenable")=="yes")) {
    
    if (!isset($_GET["screenID"])) {
        echo '<h1> Welcome to iCon. </h1>';
        include $_SERVER['DOCUMENT_ROOT'].'/public/notScreenOutput.php';
    } else {

        $screenID = $_GET["screenID"];
            if ($screenID != "") {
                echo '<div id="container-fluid" style="position: absolute; height: 95%;  width:100%">';
                $screenURL = $_SESSION[$screenID];
                        
                echo '<iframe frameborder="0" src="'.$screenURL.'" style="position: relative;  height: 100%;  width:100%"></iframe></div>';
                        
                //
            } 
               
                    //
            };
    // 
}




?>











</body>
</html>
