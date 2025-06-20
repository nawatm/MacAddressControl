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

           // Check Exist Mac Address
            $cmdSql = "update [dbo].[MobileInfo] set DeviceType = '".$_POST['DeviceType']."',DeviceBrand = '".$_POST['DeviceBrand']."',DeviceModel = '".$_POST['DeviceModel']."',UserName ='".$_POST['UserName']."'";
            $cmdSql = $cmdSql . ",Company ='".$_POST['Company']."',Subject='".$_POST['Subject']."',DeptName = '".$_POST['DeptName']."',ExpiredDate = '".$_POST['ExpiredDate']." 23:59:00'";
            $cmdSql = $cmdSql ." where Mac like '%".strtoupper($_POST['MacEdit'])."%';";

            if($_POST['MacEdit'])
            { 
                //echo $cmdSql;
                
                //if($MacObj->execNonQuery($cmdSql))
                    echo "TRUE";  
                //else
                //    echo "FALSE";     
            }
            else
                echo "FALSE";      


            /*
            if($MacObj->execQuery($cmdSql) == null)
            {
                $cmdSql = "insert into [dbo].[MobileInfo] values('".$_POST['Mac']."','".$_POST['DeviceType']."','".$_POST['DeviceBrand']."','".$_POST['DeviceModel']."','".$_POST['UserName']."','".$_POST['Company']."','".$_POST['Subject']."','".$_POST['DeptName']."',CURRENT_TIMESTAMP,";
                
                if($_POST['ExpirePeriod'] > 1)
                {
                    $cmdSql = $cmdSql ."DATEADD(DAY,".$_POST['ExpirePeriod'].",CURRENT_TIMESTAMP),";
                }
                else
                {
                    $cmdSql = $cmdSql ."CONVERT(VARCHAR(24),'".$_POST['ExpireDate']." 23:59:00.000',121),";
                }
                $cmdSql = $cmdSql ."'NAWAT.M');";
                
                if($MacObj->execNonQuery($cmdSql))
                    echo "COMPLETE";  
                else
                    echo "COMPLETE";      

            }
            else
                echo "EXIST";
            */
        }
        
    }      

?>