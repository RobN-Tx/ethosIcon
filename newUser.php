<!DOCTYPE html>

<head>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    include "public/header.php";
    include "public/settings.php";
    //include "../sql/sqlFunctions.php";
    //include "sql_used_variables.php";
    //include "sql/sqlSettings.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" >
<LINK REL="SHORTCUT ICON" HREF="/favicon.ico">
<title>EthosEnergy Icon</title>
<script src="js/Base64.js"></script>
<script src="js/userDataStore.js"></script>
<style type="text/css">
<style>
body {
    color:#000000;
    background-color:#FFFFFF;
    margin:0;
}

#container {
    margin-left:auto;
    margin-right:auto;
    text-align:center;
    background-color:#999999;
    }

a img {
    border:5px;
}


</style>



</head>

<html>
<body>

<br>
<p id="bounce"><strong>Thankyou for registering with EthosEnergy iCon <br> Once you account is verified and 
setup you will recieve and email to:    <?php echo $_SESSION["emails"] ?> <strong></p>
<a onclick="clearLocalStorage()" href="javascript:void(0);"><br>Logout</a>


<?php
echo "<br>";
$testNewUser =  newUserSQLInsert($_SESSION);
?>


</body>
</html>
