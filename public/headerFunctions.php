<?php

function customerSupportLinks($registered)
{
    //simple function to build up the string for the support dropdown, just nicer than doing it all in the header php file
    
    $customerSupportStringPt1 = '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Support<span class="caret"></span></a><ul class="dropdown-menu">';
    $customerSupportStringPt2 = '<li><a href="/cases.php">Support Request</a></li><li>';
    $customerSupportStringPt3 = '<a href="/solutions.php">Knowledge Base</a></li>';
    $customerSupportStringPt4 = '</ul></li>';

    if($registered == "yes"){
        $customerSupportStringTotal = $customerSupportStringPt1.$customerSupportStringPt2.$customerSupportStringPt3.$customerSupportStringPt4;
    } else {
        $customerSupportStringTotal = $customerSupportStringPt1.$customerSupportStringPt2.$customerSupportStringPt4;
    }
    
    
    return $customerSupportStringTotal;
};

?>
