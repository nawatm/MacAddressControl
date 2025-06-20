<?php header("Content-type: text/html; charset=utf-8"); ?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Test Encode</title>
</head>

<body>
    <?php
        
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
                $data[$a] = iconv("utf-8","tis-620",$b);
                //$data[$a] = iconv("windows-874","utf-8",$b);
            }
        }
    }
    else
    {
        $data = iconv("uft-8","tis-620",$data);
    }
    return $data;
}

      
        $MacObj = new MacAddressCtrl;

         if($MacObj->connectDB("10.20.2.12\MSSQLSERVER","compinventory","@ttg@dm!n$","CompInventoryDB"))
            {
                    
                   $cmdSql = "select PC_NAME,TMP_NAME from [dbo].[IPMAC_TMPINFO] where PC_NAME = 'TMP_NIC_L_26125510085'";
                   $MacData = array();
                   //ini_set('mssql.charset', 'UTF-8');
                   $MacData = $MacObj->execQueryArray($cmdSql);
                   $vData = js_thai_encode($MacData);
                   
                   echo "JSON = ". json_encode($MacData);
                   //echo json_encode(js_thai_encode($MacData));
                   
                   

                   echo "<br /><br />";
                   print_r($MacData);
            }
    ?>
</body>

</html>