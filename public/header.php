


<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 include $_SERVER['DOCUMENT_ROOT'].'/public/settings.php';
 include $_SERVER['DOCUMENT_ROOT'].'/public/headerFunctions.php';
 include $_SERVER['DOCUMENT_ROOT']."/libs/user_class.php"; 
 include $_SERVER['DOCUMENT_ROOT']."/sql/sqlFunctions.php"

?> 

  <title>EthosEnergy Icon</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=0.8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="icon_inside.css.php">
  <link rel="stylesheet" href="/public/headerStyle.css">
  <link rel="apple-touch-startup-image" href="/images/splash640x1096.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/images/appicon120.png">
  <link rel="icon" sizes="57x57" href="/images/appicon57.png">
  <link rel="icon" sizes="72x72" href="/images/appicon72.png"> 
   <link rel="icon" sizes="76x76" href="/images/appicon76.png">
   <link rel="icon" sizes="114x114" href="/images/appicon114.png">
   <link rel="icon" sizes="128x128" href="/images/appicon128.png">
   <link rel="icon" sizes="144x144" href="/images/appicon144.png">
   <link rel="icon" sizes="152x152" href="/images/appicon152.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/userDataStore.js"></script>
  <style>

</style>





<!--code for nav bar at top of the page standard header-->
<div id="topper"> 
<nav class="navbar navbar-inverse navbar-fixed-top" style="margin-bottom: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a href="#" class="navbar-left"><img src="<?php echo $baseUrl?>images/logo.png" ></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li class="inactive"><a href="\">Home</a></li>
<?php
     
    $regUser = "registeredUser";


    if (isset($_SESSION[$regUser])){
        $regUserConfirm = $_SESSION[$regUser];
        if ($regUserConfirm=="yes") {
            echo'<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">iCon <span class="caret"></span></a>';

            echo '<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';
            $wibble = $_SESSION["oid"];
            $dude = new user($wibble);
            
            $list= $dude->internalAllScreensList();
            echo $list.'</ul></li>';

            
        };
    } else {
        $regUserConfirm = "no";
    }


        $supportString = customerSupportLinks($regUserConfirm);
        echo $supportString;
        




       








         
    ?>
    <li >
        </li>
    </ul>





    <ul class="nav navbar-nav navbar-right">
    
    <?php



    if (isset($_SESSION['oid'])){
        $azureOID = $_SESSION['oid'];
    

        $userName = DirectoryfetchSQLColumnData("oid", $azureOID, "name");

        $adminSignedIn = DirectoryfetchSQLColumnData("oid", $azureOID, "iconadmin");
        
        if($adminSignedIn =='yes'){
            echo '<li><a href="/admin/adminsite.php"><span class="	glyphicon glyphicon-cog"></span>Admin Site</a></li>';

        }
}

    if ($regUserConfirm=="yes") {
        //echo '<li><a href="#"><span class="glyphicon glyphicon-user"></span>'.'hellouser'.'</a></li>';
        echo '<li><a href="#"><span class="glyphicon glyphicon-user"></span> '.$userName.'</a></li>';
        echo '<li><a href='.$logoutURI.'><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
    } else {
        //echo '<li><a href="#"><span class="glyphicon glyphicon-user"></span>'.'hello'.'</a></li>';
        echo '<li><a href='.$signupURI.'><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
        echo '<li><a href='.$loginURI.'><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
    };
    ?>  
     </ul>
    
    </div>
  </div>
</nav>





</div>




