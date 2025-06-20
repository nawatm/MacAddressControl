<?php
    //header("Content-Type: application/json; charset=utf-8");
    header("Content-Type: text/javascript; charset=tis-620");
    //header("Content-Type: text/html; charset=utf-8");
    include("config.php");
    require("MacAddressCtrl.class.php");


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
                $data[$a] = iconv("tis-620","utf-8",$b);
            }
        }
    }
    else
    {
        $data = iconv("tis-620","utf-8",$data);
    }
    return $data;
}



    if($_POST)
    {   
        // Tab 1 ---- Computer Client in ATTG
        if($_GET['type'] == "computer")
        {
            $MacObj = new MacAddressCtrl;
            if($MacObj->connectDB($GLOBALS['db_server'],$GLOBALS['db_user'],$GLOBALS['db_pwd'],$GLOBALS['db_name']))
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
                $cmdSql = $cmdSql . "ComputerName,Comp,ComputerOwner,MAC_Lan,MAC_Wireless,Last_Update from [dbo].[ComputerInfo]";
                
                if($_POST['ComputerCompany'] == "ALL")
                    $cmdSql = $cmdSql." where Comp <> ''";
                else
                    $cmdSql = $cmdSql." where Comp like '%".$_POST['ComputerCompany']."%'";

                if($_POST['ComputerName'])
                    $cmdSql = $cmdSql." and LOWER(ComputerName) like '%".strtolower($_POST['ComputerName'])."%'";
                if($_POST['ComputerMac'])
                    $cmdSql = $cmdSql." and LOWER(MAC_Lan) like '%".strtolower($_POST['ComputerMac'])."%' or LOWER(MAC_Wireless) like '%".strtolower($_POST['ComputerMac'])."%'";
                if($_POST['ComputerOwner'])
                    $cmdSql = $cmdSql." and LOWER(ComputerOwner) like '%".strtolower($_POST['ComputerOwner'])."%'";

                $cmdSql = $cmdSql . ") AS CompList";
                //$cmdSql = $cmdSql . " where RowID > 0 and RowID < 10";        

                //cho $_POST['ComputerMac'] ." => ".$cmdSql."<br\>";
                $MacData = array();
                $MacData = $MacObj->execQueryArray($cmdSql);
                

                if(is_array($MacData))
                {
                    //----------- Return data on HTML --------------
                    $strValue = "";

                    
                    $strValue = "<thead><tr>
                    <th align='center' valign='middle'>RowID</th>
                    <th align='center' valign='middle'>Computer Name</th>
                    <th align='center' valign='middle'>Company</th>
                    <th align='center' valign='middle'>Computer Owner</th>
                    <th>MAC LAN</th>
                    <th>MAC Wireless</th>
                    <th>Last Update</th>    
                    <th>Action</th>
                    </tr></thead>";
                    $strValue .= "<tbody>";
                    

                    foreach($MacData AS $Key => $value)
                    {
                        //$strValue .= "<tr><td>".$value["RowID"]."</td><td>".$value["ComputerName"]."</td><td>".$value["IpAddress"]."</td><td>".iconv('TIS-620','UTF-8',$value["Model"])."</td></tr>";
                        $strValue .= "<tr>
                        <td align='center' valign='middle'>".$value["RowID"].
                        "</td><td>".$value["ComputerName"].
                        "</td><td>".$value["Comp"].
                        "</td><td>".$value["ComputerOwner"].
                        "</td><td>".$value["MAC_Lan"].
                        "</td><td>".$value["MAC_Wireless"].
                        "</td><td>".$value["Last_Update"].
                        "</td><td align='center' valign='middle'><button id='editComputerMac' class='btn btn-primary' onclick='openLink()'>
                        <span class='glyphicon glyphicon-list-alt'></span> Edit </button></td></tr>";
                    }
                    $strValue .= "</tbody>";
                    echo $strValue;
                    
                    //----------- Return data on JSON --------------
                    //header("Content-type:application/json");
                    //echo json_encode(js_thai_encode($MacData)); 
                }
            }
        }// Tab 2 ---- Other Device and Mobile Phone
        else if($_GET['type'] == "mobile")
        {
            $MacObj = new MacAddressCtrl;
            if($MacObj->connectDB($GLOBALS['db_server'],$GLOBALS['db_user'],$GLOBALS['db_pwd'],$GLOBALS['db_name']))
            {
                $cmdSql = "select CompList.* from (select ROW_NUMBER() Over (Order By Mac) As RowID,";
                $cmdSql = $cmdSql . "Company,UserName,DeviceType,Mac,CreatedDate,ExpiredDate from [dbo].[MobileInfo]";
                
                if($_POST['Company2'] == "ALL")
                    $cmdSql = $cmdSql." where Company <> ''";
                else
                    $cmdSql = $cmdSql." where Company like '%".$_POST['Company2']."%'";

                if($_POST['DeviceType'])
                    $cmdSql = $cmdSql." and DeviceType like '%".$_POST['DeviceType']."%'";
                if($_POST['Mac2'])
                    $cmdSql = $cmdSql." and Mac like '%".$_POST['Mac2']."%'";
                if($_POST['DeviceOwner'])
                    $cmdSql = $cmdSql." and LOWER(UserName) like '%".strtolower($_POST['DeviceOwner'])."%'";

                $cmdSql = $cmdSql . ") AS CompList";

                $MacData = array();
                $MacData = $MacObj->execQueryArray($cmdSql);

                if(is_array($MacData))
                {
                    //----------- Return data on HTML --------------
                    $strValue = "";
                
                    $strValue = "<thead><tr>
                    <th align='center' valign='middle'>RowID</th>
                    <th align='center' valign='middle'>Company</th>
                    <th align='center' valign='middle'>Device Owner</th>
                    <th align='center' valign='middle'>DeviceType</th>
                    <th>MAC</th>
                    <th>CreatedDate</th>
                    <th>ExpiredDate</th>
                    <th>Action</th>
                    </tr></thead>";
                    $strValue .= "<tbody>";
                    
                    foreach($MacData AS $Key => $value)
                    {
                        //$strValue .= "<tr><td>".$value["RowID"]."</td><td>".$value["ComputerName"]."</td><td>".$value["IpAddress"]."</td><td>".iconv('TIS-620','UTF-8',$value["Model"])."</td></tr>";
                        $strValue .= "<tr>
                        <td align='center' valign='middle'>".$value["RowID"].
                        "</td><td>".$value["Company"].
                        "</td><td>".$value["UserName"];
                        
                        if(trim($value["DeviceType"]) == "MOB")
                            $strValue .= "</td><td>Mobile";
                        else
                            $strValue .= "</td><td>PC";

                        $strValue .= "</td><td>".$value["Mac"].
                        "</td><td>".$value["CreatedDate"].
                        "</td><td>".$value["ExpiredDate"].
                        "</td><td align='center' valign='middle'><button id='btnEdit' data-toggle='modal' data-target='#editModal' class='btn btn-primary editModal'>
                        <span class='glyphicon glyphicon-list-alt' ></span> Edit  </button></td></tr>";
                    }
                    $strValue .= "</tbody>";
                    echo $strValue;
                }
            }
        }
        else if($_GET['status'] == "edit")
        {
            $MacObj = new MacAddressCtrl;
            if($MacObj->connectDB($GLOBALS['db_server'],$GLOBALS['db_user'],$GLOBALS['db_pwd'],$GLOBALS['db_name']))
            {
                if($_POST['MAC'])
                {
                   $cmdSql = "select Mac,DeviceType,DeviceBrand,DeviceModel,UserName,Company,Subject,DeptName,Convert(varchar(10),CreatedDate,120) as CreatedDate,Convert(varchar(10),ExpiredDate,120) ";
                   $cmdSql = $cmdSql . "as ExpiredDate,Actor from [dbo].[MobileInfo] where lower(Mac) = lower('".$_POST['MAC']."')";
                   $MacData = array();
                   $MacData = $MacObj->execQueryArray($cmdSql);
                   echo json_encode(js_thai_encode($MacData));    
                   //echo json_encode($MacData);    
                }
            }
            
        }
    }
    
?>