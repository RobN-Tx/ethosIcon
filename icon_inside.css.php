<?php header("Content-type: text/css"); ?>

body {
  font-family: Verdana, sans-serif;
  padding-top: 50px;
  margin: 0;
}


html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  
  /*padding-bottom: 6rem;
  margin-bottom: 60px;*/
}
.footer {
  position: fixed;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1rem;
  text-align: center;
 display: block;
  height: 60px;
  background-color: #f5f5f5;
}
.topper{
  background:#222;
}


/* css for the not logged in here */

body {

}
.title {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  
}
button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 70%;
	margin-left: 15%;
	border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.5s;
}

button.accordion.active, button.accordion:hover {
    background-color: #ddd;
}

button.accordion:after {
    content: '\002B';
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 12%;
}

button.accordion.active:after {
    content: "\2212";
}

div.panel {
    padding: 0 18px;
    background-color: white;
	margin-left: 17%;
	width: 70%;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s ease-out;
}
div.well {
	
	border: 1px;
	
}
/*css for not logged in ends here*/


.navbar-nav > li > a {padding-top:15px !important; padding-bottom:10px !important;}
/*.navbar {min-height:10%; !important}*/







/*my play starts here for the sso2 siteg*/
[id=topper]{
	
}


/* from the header document*/
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