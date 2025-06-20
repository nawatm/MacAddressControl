<?php
    include("../config.php");
    require("../MacAddressCtrl.class.php");
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
        //echo $_POST['Mac']." / ".$_POST['DeviceBrand'] ."/".$_POST['DeviceModel'];
        $MacObj = new MacAddressCtrl;
        if($MacObj->connectDB($GLOBALS['db_server'],$GLOBALS['db_user'],$GLOBALS['db_pwd'],$GLOBALS['db_name']))
        {
            $macArr = js_thai_encode($_POST);

           // Check Exist Mac Address
            /*$cmdSql = "update [dbo].[MobileInfo] set DeviceType = '".$_POST['DeviceType']."',DeviceBrand = '".$_POST['DeviceBrand']."',DeviceModel = '".$_POST['DeviceModel']."',UserName ='".$_POST['UserName']."'";
            $cmdSql = $cmdSql . ",Company ='".$_POST['Company']."',Subject='".$_POST['Subject']."',DeptName = '".$_POST['DeptName']."',ExpiredDate = '".$_POST['ExpiredDate']." 23:59:00'";
            $cmdSql = $cmdSql ." where Mac like '%".strtoupper($_POST['MacEdit'])."%';"; */

            $cmdSql = "update [dbo].[MobileInfo] set DeviceType = '".$macArr['DeviceType']."',DeviceBrand = '".$macArr['DeviceBrand']."',DeviceModel = '".$macArr['DeviceModel']."',UserName ='".$_POST['UserName']."'";
            $cmdSql = $cmdSql . ",Company ='".$macArr['Company']."',Subject='".$macArr['Subject']."',DeptName = '".$macArr['DeptName']."',ExpiredDate = '".$macArr['ExpiredDate']." 23:59:00'";
            $cmdSql = $cmdSql ." where Mac like '%".strtoupper($macArr['MacEdit'])."%';";

            //echo js_thai_encode($cmdSql);
            if(($_POST['MacEdit']) && (strlen($_POST['MacEdit']) > 1))
            { 
                //echo js_thai_encode($cmdSql);
                //echo $cmdSql;
                
                if($MacObj->execNonQuery($cmdSql))
                
                    echo "TRUE";  
                else
                    echo "FALSE";     
                
            }
            else
                //echo js_thai_encode($cmdSql);
                echo "FALSE";      
        }
        
    }      

?>