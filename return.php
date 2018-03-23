<?php
//this file processes the return of a user from logging in or signing up
//updated and commented on 10/20/2017

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    
    include "public/settings.php";
    include "sql/sqlFunctions.php";
	include "sql/sql_used_variables.php";
    include "sql/sqlSettings.php";
    include $_SERVER['DOCUMENT_ROOT'].'/libs/returnFunctions.php';
   
    //there is probably a nicer way to do this but hey ho
   $accessToken = 9000; //used to guide where the script sends the user after login
   
   
   //fetch the raw token delivered to us by Azure $_POST["id_token"], explode it into the 3 pieces (openID Connect token)
   $rawAzureToken = $_POST["id_token"];


   $splitRawAzureTkn = explode(".", $rawAzureToken);

   //decode the payload (part 1) from base64 into a string of real letters
   $decodedTokenPayload = base64_decode(str_replace(array('-', '_'), array('+', '/'), $splitRawAzureTkn[1]));
error_log("returning".$decodedTokenPayload);
   //now decode said string into a $json which can then be used for the log in process of the site
    $readablePayload=json_decode($decodedTokenPayload, true);


    //first compare the reversed NONCE string received from azure to the session ID (as the session if is reversed when sending the nonce
    //- if they are the same then ok to proceed, if different then logout and send to the home page
  
if (strrev($readablePayload["nonce"]) != session_id()){

    //if different then end the session, destroy the session and log them out leaving them returning to the home page
        $_SESSION = array();
    session_destroy();

    header($azureLogOut);

}
else 
{
//if you made it here then they have come to and from azure properly and arent trying to hack their way in (probably)

        //setup some variables for making a cookie
        $cookie_name = "name";
        $cookie_value = $readablePayload["name"];

        //make that cookie
        setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day

        //for all the values in the token store in their own $_SESSION value apart from emails which come in an array so fetch the first value of the array [0]g
        //the processIncomingUserData function is located in libs/returnFunction
        processIncomingUserData($readablePayload);
       


//now check if the user incoming is registered and allowed to access the site .The checkIfUserIsRegistered function is located in libs/returnFunction.php
$accessToken = checkIfUserIsRegistered();




//check if it is a new user (newUser flag set in session).
if(isset($_SESSION["newUser"])){
    if ($_SESSION["newUser"] ==1) {
        //if it is a new user then call the function to insert a new user into the sql database
        newUserSQLInsert($readablePayload);//this was $json_a before, if we suddenly get an issue registering new users ------<<<<<<look here
        $accessToken = 100; /* Redirect browser to new user page*/
        
    };
}



    $regUser = "registeredUser";
    $_SESSION["accessToken"]=$accessToken;
    //$_SESSION[$regUser]="yes";
    switch ($accessToken) {
        case 0:
            $_SESSION[$regUser]="yes";
            header($regUserURL); // Redirect browser to the front page which will then load logged in data
            break;
        case 100:
            $_SESSION[$regUser]="no";
            header($newUserURL); // Redirect browser to the new user page, which needs some love.
            $to      = 'robert.nelson@ethosenergygroup.com';
            $subject = 'New User! '.$_SESSION["given_name"]." ".$_SESSION["family_name"];
            $message = 'A new user has just registered details below bro';

            foreach ($_SESSION as$key => $value){
                    $message = $message.$key."-->".$value."\r\n";
                
            }

            $headers = 'From: noreply@ethosicon.info' . "\r\n" .
                'Reply-To: noreply@ethosicon.info' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            
            mail($to, $subject, $message, $headers);
            break;
        case 9000:
            $_SESSION[$regUser]="no";
            header($unknownUserURL ); // Redirect browser to unknown user page and tell them to piss off.
            
            break;
    }
}

