<?php
    require("MacAddressCtrl.class.php");
    ini_set("display_errors", 0); // Not Show Error
 

    if($_POST)
    {
        $MacObj = new MacAddressCtrl;
        //$MacObj->connectDB("10.20.2.12\MSSQLSERVER","compinventory","@ttg@dm!n$","compinventoryDB");
        //if($MacObj->connectDB("10.0.91.30\LOCALDB","sa","@ttg@dm!n$","CR"))
        if($MacObj->connectDB("10.20.2.12\MSSQLSERVER","compinventory","@ttg@dm!n$","CR"))
        {
           // Check Exist Mac Address
            //$cmdSql = "select Mac from [dbo].[MobileInfo] where Mac like '%".strtoupper($_POST['Mac'])."%';";
            $cmdSql = "select MAC from [dbo].[viewMacList] where MAC like '%".strtoupper($_POST['Mac'])."%';";
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
        }
    }

?>