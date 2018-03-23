


<?php if(!isset($_SESSION)) 
    { 
        session_start(); 
    } ?>
 <?php 
 include "adminsettings.php";
 include $_SERVER['DOCUMENT_ROOT']."/public/headerFunctions.php";
 include $_SERVER['DOCUMENT_ROOT']."/libs/user_class.php"; 
 include $_SERVER['DOCUMENT_ROOT'].'/public/settings.php';
 include $_SERVER['DOCUMENT_ROOT']."/sql/sqlFunctions.php"
 //include $_SERVER['DOCUMENT_ROOT'].'/public/cookietest.php';
//include "sql/sqlFunctions.php"
?>

  <title>EthosEnergy Icon</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=0.8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../icon_inside.css.php">
  <link rel="apple-touch-startup-image" href="/Images/splash640x1096.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/Images/appicon120.png">
  <link rel="icon" sizes="57x57" href="/Images/appicon57.png">
  <link rel="icon" sizes="72x72" href="/Images/appicon72.png"> 
   <link rel="icon" sizes="76x76" href="/Images/appicon76.png">
   <link rel="icon" sizes="114x114" href="/Images/appicon114.png">
   <link rel="icon" sizes="128x128" href="/Images/appicon128.png">
   <link rel="icon" sizes="144x144" href="/Images/appicon144.png">
   <link rel="icon" sizes="152x152" href="/Images/appicon152.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../js/userDataStore.js"></script>
  <style>
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}
</style>




<!--code for nav bar at top of the page-->
<div id="topper"> 
<nav class="navbar navbar-inverse navbar-fixed-top" style="margin-bottom: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a href="#" class="navbar-left"><img src="<?php echo $baseUrl?>/images/logo.png" height="48"></a>
    </div>
	<div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li class="inactive"><a href="\">Admin</a></li>
     <?php 
	 
	 $regUser = "registeredUser";
	$regUserConfirm = $_SESSION[$regUser];
		if($regUserConfirm=="yes"){
			echo'<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">iCon <span class="caret"></span></a>';

			echo '<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';
			$wibble = $_SESSION["oid"];
            $dude = new user($wibble);
			
			$list= $dude->internalAllScreensList();
			echo $list;
			
				 
	  			
	
			echo '</ul>';
			echo '</li>';
			$supportString = customerSupportLinks("yes");
			echo $supportString;
			
			
			
			};
		
		 
	?>

    </ul>
	<ul class="nav navbar-nav navbar-right">
	<?php 
	$regUser = "registeredUser";
	$regUserConfirm = $_SESSION[$regUser];
    $azureOID = $_SESSION['oid'];
    $userName = DirectoryfetchSQLColumnData("oid", $azureOID, "name", "directory");
    $adminSignedIn = DirectoryfetchSQLColumnData("oid", $azureOID, "iconadmin", "directory");

    if($adminSignedIn =='yes'){
        echo '<li><a href="/admin/adminsite.php"><span class="	glyphicon glyphicon-cog"></span>Admin Site</a></li>';
  echo "<!--code for nav bar at top of the page admoin header-->";
    }
	
		if($regUserConfirm=="yes"){
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




