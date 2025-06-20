<?php

    header("Content-Type: text/javascript; charset=utf-8");
    include("config.php");
    require("MacAddressCtrl.class.php");
    ini_set("display_errors", 0); // Not Show Error
 
    function js_thai_encode($data)
    {
        if(is_array($data))
        {
            foreach($data as $a => $b)
            {
                if(is_array($data[$a]))
                {
                    $data[$a] = js_thai_encode($data[$a]);
                }
                else
                {
                    //$data[$a] = iconv("tis-620","utf-8",$b);
                    $data[$a] = iconv("utf-8","tis-620",$b);
                }
            }
        }
        else
        {
            $data = iconv("utf-8","tis-620",$data);
        }
        return $data;
    }

    if($_POST)
    {
        $MacObj = new MacAddressCtrl;
        //$MacObj->connectDB("10.20.2.12\MSSQLSERVER","compinventory","@ttg@dm!n$","compinventoryDB");
        //if($MacObj->connectDB("10.0.91.30\LOCALDB","sa","@ttg@dm!n$","CR"))
        //if($MacObj->connectDB("10.20.2.12\MSSQLSERVER","compinventory","@ttg@dm!n$","CR"))
        if($MacObj->connectDB($GLOBALS['db_server'],$GLOBALS['db_user'],$GLOBALS['db_pwd'],$GLOBALS['db_name']))
	{
           // Check Exist Mac Address
            //$cmdSql = "select Mac from [dbo].[MobileInfo] where Mac like '%".strtoupper($_POST['Mac'])."%';";
            $cmdSql = "select MAC from [dbo].[viewMacList] where MAC like '%".strtoupper($_POST['Mac'])."%';";

            //echo "Select (Insert) : ".$cmdSql;

	    if($MacObj->execQuery($cmdSql) == null)
            {
                $macArr = js_thai_encode($_POST);

                $cmdSql = "insert into [dbo].[MobileInfo] values('".$macArr['Mac']."','".$macArr['DeviceType']."','".$macArr['DeviceBrand']."','".$macArr['DeviceModel']."','".$macArr['UserName']."','".$macArr['Company']."','".$macArr['Subject']."','".$macArr['DeptName']."',CURRENT_TIMESTAMP,";
                if($macArr['ExpirePeriod'] > 1)
                {
                    $cmdSql = $cmdSql ."DATEADD(DAY,".$macArr['ExpirePeriod'].",CURRENT_TIMESTAMP),";
                }
                else
                {
                    $cmdSql = $cmdSql ."CONVERT(VARCHAR(24),'".$macArr['ExpireDate']." 23:59:00.000',121),";
                }
                $cmdSql = $cmdSql ."'NAWAT.M');";


                //echo "Insert cmd : ".$cmdSql;
                
                if($MacObj->execNonQuery($cmdSql))
                    echo "COMPLETE";  
                else
                    echo "EXIST";      
                

            }
            else
                echo "EXIST";
        }
    }
    else
    { echo "Error Post"; 
    }

?>
