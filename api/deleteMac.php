<?php
    include("../config.php");
    require("../MacAddressCtrl.class.php");
    ini_set("display_errors", 0); // Not Show Error

    if($_POST)
    {    
        //echo $_POST['Mac']." / ".$_POST['DeviceBrand'] ."/".$_POST['DeviceModel'];
        
        $MacObj = new MacAddressCtrl;
        if($MacObj->connectDB($GLOBALS['db_server'],$GLOBALS['db_user'],$GLOBALS['db_pwd'],$GLOBALS['db_name']))
        {
            if($_POST['MacEdit'])
            { 
                // Check Exist Mac Address
                $cmdSql = "delete [dbo].[MobileInfo] where Mac like '%".strtoupper($_POST['MacEdit'])."%';";
                if($MacObj->execNonQuery($cmdSql))
                    echo "TRUE";  
                else
                    echo "FALSE";     
                
            }
            else
                echo "FALSE";      
        }
        
    }      

?>