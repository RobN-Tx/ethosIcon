<?php

//First is the urls for logging in, out and signing up
//TODO - 	need to split this back up at somepoint for proper nonce ing


//change this to "" from "sso2." when pushing to production
$adderToUrlForSSO2 = "";




$adminBaseUrl = "https://".$adderToUrlForSSO2."ethosicon.info/";
$loginURI = "https://login.microsoftonline.com/eeltrmd2c.onmicrosoft.com/oauth2/v2.0/authorize?p=B2C_1_trialb2csignup-in&client_Id=b8a7e1a2-c9bc-4c00-b777-652fb0343873&nonce=91234&redirect_uri=https%3A%2F%2F".$adderToUrlForSSO2."ethosicon.info%2Freturn.php&scope=openid&response_mode=form_post&response_type=id_token&prompt=login&state=91234";
$signupURI= "https://login.microsoftonline.com/eeltrmd2c.onmicrosoft.com/oauth2/v2.0/authorize?p=B2C_1_b2ctrial-sign-up&client_Id=b8a7e1a2-c9bc-4c00-b777-652fb0343873&nonce=defaultNonce&redirect_uri=https%3A%2F%2F".$adderToUrlForSSO2."ethosicon.info%2Freturn.php&scope=openid&response_mode=form_post&response_type=id_token&prompt=login";
$logoutURI = "https://".$adderToUrlForSSO2."ethosicon.info/logout.php";
$azureLogOut = "Location: https://login.microsoftonline.com/eeltrmd2c.onmicrosoft.com/oauth2/v2.0/logout?p=b2c_1_trialb2csignup-in&post_logout_redirect_uri=https%3A%2F%2F".$adderToUrlForSSO2."ethosicon.info%2F";

//next are the urls for internal site use - this was made so that I could push this into production
$regUserURL = "Location: https://".$adderToUrlForSSO2."ethosicon.info/";
$newUserURL =  "Location: https://".$adderToUrlForSSO2."ethosicon.info/newUser.php";
$unknownUserURL = "Location: https://".$adderToUrlForSSO2."ethosicon.info/notregistered.php";
$postToUserTableUrl = "https://".$adderToUrlForSSO2."ethosicon.info/admin/userTable.php";

?>
