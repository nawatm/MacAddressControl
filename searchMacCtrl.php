<?php
    //header('Content-type: application/json');
    require("MacAddressCtrl.class.php");
    if($_POST)
    {
        $MacObj = new MacAddressCtrl;
        if($MacObj->connectDB("10.20.2.12\MSSQLSERVER","compinventory","@ttg@dm!n$","CR"))
        {
            // Check Exist Mac Address
            /*
            select ComputerName,IpAddress,ComputerOwner,Model,MAC_Lan,MAC_Wireless,Last_Update
            from [dbo].[ComputerInfo] 
            where Comp = 'SATI' and ComputerName like '%SATI-%'
            and MAC_Lan like '%78:45:C4:3F:64:9C%' or MAC_Wireless like '%78:45:C4:3F:64:9C%'
            and ComputerOwner like '%S%'   */



            //$cmdSql = "select ComputerName,IpAddress,ComputerOwner,Model,MAC_Lan,MAC_Wireless,Last_Update from [dbo].[ComputerInfo]";
            $cmdSql = "select CompList.* from (select ROW_NUMBER() Over (Order By ComputerName) As RowID,";
            $cmdSql = $cmdSql . "ComputerName,IpAddress,ComputerOwner,Model,MAC_Lan,MAC_Wireless,Last_Update from [dbo].[ComputerInfo]";
            
            if($_POST['Company1'])
                $cmdSql = $cmdSql." where Comp like '%".$_POST['Company1']."%'";
            if($_POST['ComputerName'])
                $cmdSql = $cmdSql." and ComputerName like '%".$_POST['ComputerName']."%'";
            if($_POST['Mac'])
                $cmdSql = $cmdSql." and MAC_Lan like '%".$_POST['Mac']."%' or MAC_Wireless like '%".$_POST['Mac']."%'";
            if($_POST['ComputerOwner'])
                $cmdSql = $cmdSql." and ComputerOwner like '%".$_POST['ComputerOwner']."%'";

            $cmdSql = $cmdSql . ") AS CompList where RowID > 0 and RowID < 20";        


            $MacData = array();
            $MacData = $MacObj->execQueryArray($cmdSql);
            //print_r($MacData);
            //echo $cmdSql;
            //print_r(json_encode($MacData));
            echo json_encode($MacData); 
        }
    }
    
?>