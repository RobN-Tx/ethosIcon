<?php
//get access to session variables

include "public/settings.php";
session_start();

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

//redirect to the azure log out to complete the process. 
header($azureLogOut);
?>