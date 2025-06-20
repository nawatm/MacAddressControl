<?php
    /* ========== Active Directory Setting ==========*/
    // Active Directory server
	$ldap_host = "10.123.16.9";

	// Active Directory DN
	$ldap_dn = "OU=IT-IT Promotion,OU=6.ATT,DC=attg,DC=co,DC=th";

	// Active Directory user group
	$ldap_user_group = "Grp-IT Promotion";

	// Active Directory manager group
	$ldap_manager_group = "Grp-IT Promotion";

	// Domain, for purposes of constructing $user
	$ldap_usr_dom = '@attg.co.th';


     /* ========== Database Setting ==========*/
/*
     $db_server = "ATA-IT-NB12\LOCALDB";
     $db_user = "sa";
     $db_pwd = "@ttg@dm!n$";
     $db_name = "CR";
*/
	
     $db_server = "10.44.40.22";
     $db_user = "compinventory";
     $db_pwd = "@ttg@dm!n$";
     $db_name = "CR";
     //$db_name = "CompInventoryDB";
	

?>
