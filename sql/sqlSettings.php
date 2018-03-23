<?php

global $servername; 
global $username; 
global $password; 
global $activeDB; 

//what server is the sql server on? --- one day this will end up on a seperate server as we grow - by which point this should have been rewritten!
$servername = "localhost";

//yeah I know i've written this in the document, we'll secure this at some point
$username = "b2ctrial";

//and even worse!
$password = "3ThosRMD";


//data base scheme name selection below comment them in and out as required when moving from development to production
// this is the production one

$activeDB = "ethosicontrial";

//this is the development one
//$activeDB = "mydbpdo";

?>