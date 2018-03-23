<?php

//this document contains the user_class code.$_COOKIE
//I should apologise for my mix of camelCase and under_score notation, but such is the methods of somebody learning!

//updated and commented on 10/20/17

//start with the usual includes
include $_SERVER['DOCUMENT_ROOT'].'/sql/sqlSettings.php';
include $_SERVER['DOCUMENT_ROOT'].'/public/settings.php';

//boot up a session just incase one doesnt exist - it really should but better safe than sorry you know
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


class user
{
    //lets declare a load of variables which should be self explanitory
    var $userOid;//OID is the unique ID passed back from azure B2C authenication which is used to ID each registered user
    var $userCompany; //guess
    var $unitsAtSite; //fairly obvious, how many units at the registered customers site
    var $userAdmin; //is the user logged in an icon admin - if so then give them more access to coresight, if not then dont
    var $userPrimarySite;

    function set_oid($incomingOid)//function to set the oid of the user who has just logged in
    {
        $this->userOid = $incomingOid;
    }

    function get_oid() //function to return the oid of the logged in user when requested
    {
        return $this->userOid;
    }

    function __construct($incomingOid) //the construct function, this is auto called when the class is first declared (its declared in iisstart or return) and runs automatically
    {
         $this->userOid = $incomingOid;
         $this->userCompany = self::get_Registered_Company();
         $this->userAdmin = self::get_Admin_Status();
         $this->userPrimarySite = self::get_Registered_Site();
         $this->unitsAtSite = self::get_Units_At_Site();
    }

    function get_userCompany()//function that returns the users company as set in the sql database
    {
        return $this->userCompany;
    }

    function get_Registered_Company()//function that returns the users company as set in the sql database - not sure if these are redundant, they look it
    {
                    
                $find =  DirectoryFetchSQLColumnData("oid", $this->userOid, "extension_Company");
                return $find;
    }

    function get_Registered_Site()//function that returns the users main site as set in the sql database
    {
                    
                $find =  DirectoryFetchSQLColumnData("oid", $this->userOid, "extension_Site");
                    
                return $find;
    }

    function get_Admin_Status() //function that returns the users admin status as set in the sql database
    {
               
            $isAdmin =  DirectoryFetchSQLColumnData("oid", $this->userOid, "iconadmin");
                
        if ($isAdmin =="yes") {
            $output = "";
        } else {
            $output = "mode=kiosk&hidetoolbar";
        };
                    
                return $output;
    }

    function get_Units_At_Site() //howmany units at site? this is used whilst building the drop downs.
    {


        $find = FetchSqlColumnData("extension_site", $this->userPrimarySite, "numberOfUnits", "sites");

        return $find;


    }

    function get_customerSitesAllowance() //is the user allowed to see all of his companies sites or just his own one - not sure this is implemented yet
    {
               
            $find =  DirectoryFetchSQLColumnData("oid", $this->userOid, "all_customer_sites");
            return $find;
    }


    //function to start building the drop downs. It checks to see if the users company is EELT. If it is then it gives all screens
    //if the users company is not EELT then it just gives a drop down for their registered company screes. 
function internalAllScreensList(){
    $lowerCaseCompany = strtolower($this->userCompany);

    switch ($lowerCaseCompany){
            case "eelt"://is this user EELT

                $allCustomersQuerry = "SELECT DISTINCT extension_Company FROM screens"; //if so get an array of all the distinct companies in the screens table via sql querry
                $customerListAnswer = passTheQuerry($allCustomersQuerry, 'no');
              

                foreach($customerListAnswer as $siteToCall){ //for each company retrned by sql get the dropdown string for each site

                    //make the top level of the drop down list
                    echo '<li class="dropdown-submenu"><a tabindex="-1" href="/">'.$siteToCall['extension_Company'].'</a><ul class="dropdown-menu">';
                    //go build the string for the companies dropdown
                    echo self::customerSiteString($siteToCall['extension_Company']);
                    //close out the list
                    echo '</ul></li>';

                }

            break;
            default:
                //if the user is just a normal customer and so only gets to see their sites - go build the access string for those sites. 
               echo self::customerSiteString($this->userCompany);
    }


}

// Customer Site String is the level above siteUnitString as it is going to make sure if we have a customer with multiple sites bthey can see
//all the screens if they are allowed to. 
    function customerSiteString($customerCompany)
    {
        
                $customerSitesQuerry = "SELECT DISTINCT extension_site FROM screens WHERE extension_Company = '".$customerCompany."'";
                //the sql query string, gets past the customer company and finds all the different sites for that company
     
        
        
        $allSitesTest = self::get_customerSitesAllowance();//check if they can see all sites - NEEDS TESTING

        $customerSitesAnswer = passTheQuerry($customerSitesQuerry, 'no');//go get the different sites for the customer from sql. 

        $customerSiteLevelString ="";//this will end up being the output

        if ($allSitesTest == 'yes' && count($customerSitesAnswer) >= 2) {//check and see if they are allowed to view all sites. 
                            
        //if they are then we will go stgart to build the list string for each site                    
            foreach ($customerSitesAnswer as $activeSite) {
                    //first of all the level for the site
                $customerSiteLevelString = $customerSiteLevelString.'<li class="dropdown-submenu"><a tabindex="-1" href="/">'.$activeSite['extension_site'].'</a><ul class="dropdown-menu">';
                    //then the site units strings
                $siteString =  self::siteUnitsString($activeSite['extension_site']);
                    //close out the site level drop down
                $customerSiteLevelString = $customerSiteLevelString.$siteString.'</ul></li>';
            }
                
        } else {
            //if they are only allowed their site then we will just use the site they are allowed
            $customerSiteLevelString =  self::siteUnitsString($customerSitesAnswer[0]['extension_site']);
        }
            //now return the string that is the drop downs for this customer.
        return $customerSiteLevelString;
    }


// siteUnitsString is here to make a strip for the dropdown on the header for each screen, for each unit at a siteUnitsString
//site unit string handles the units on the site, it asks screenListString to sort out the unit screens

    function siteUnitsString($activeSite)
    {
    
                    //go get the distinct units for this site from the screens table via SQL querry
                $sqlQuerry = "SELECT DISTINCT site_unit_index FROM screens WHERE  extension_site = '".$activeSite."'";
                $siteUnitsAnswer = passTheQuerry($sqlQuerry, 'no');

                    //this will be the final answer passed back to the customer level
                $masterScreenListString ="";

        foreach ($siteUnitsAnswer as $unitName) {
                //so for each individual unit (and home section) lets get the screens
            $unitQuerry = "SELECT DISTINCT * FROM screens WHERE extension_site = '".$activeSite."' AND site_unit_index = '".$unitName['site_unit_index']."'";
                        
            $unitScreens = passTheQuerry($unitQuerry, 'no');//fetch the screens for this site and unit from sql

                //start to build the final screen urlfor use. the $this->admin adds a kiosk mnode to the string if they arent an admin
            $unitScreenUrl = 'https://'.$unitScreens[0]['screen_url'].$this->userAdmin.'&redirect=false';
            $_SESSION[$unitScreens[0]['unit_name']] = $unitScreenUrl;
            
                //unit level of the drop down build out
            $level1DropDown = '<li class="dropdown-submenu"><a tabindex="-1" href="/?screenID='.$unitScreens[0]['unit_name'].'">'.$unitScreens[0]['unit_name'].'</a><ul class="dropdown-menu">';
                //bolt the string together
            $masterScreenListString = $masterScreenListString.$level1DropDown;



                                    //now for each screen for the unit add the link at the base level
                                foreach ($unitScreens as $screen) {
                                
                                                                    
                                    $currentScreen = ($screen['id']);

                                        //get the string for the final level
                                    $stringScreen = self::screenListString($currentScreen);
                                    
                                        //add them together
                                    $masterScreenListString = $masterScreenListString.$stringScreen;
                                    
                                }
            
                            //close out the drop down level
                        $masterScreenListString = $masterScreenListString.'</ul></li>';
                          
        }
        

                    //send the site string back up
                return $masterScreenListString;
    }

    function screenListString($idscreens)//build the string for the screen as requested
    {
        
        $screenQuerry = "SELECT  * FROM screens WHERE id = '".$idscreens."'";//string to fetch the details from sql
        $activeScreen = passTheQuerry($screenQuerry, 'no')[0];//now fetch the details from sql
       
        $screenURL = 'https://'.$activeScreen['screen_url'].$this->userAdmin.'&redirect=false';//build the screen url up 
        $_SESSION[$activeScreen['screen_name']] = $screenURL;//store the screen url
        $level2DropDown = '<li><a  href="/?screenID='.$activeScreen['screen_name'].'">'.$activeScreen['screen_name'].'</a></li>';//build the drop down string
            //send it back up along
        return $level2DropDown;
    }
}

class customer //no idea maybe an orphan of an idea. might re use for the reports/docuents section
{
    var $customerSites;
}
?>