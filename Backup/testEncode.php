<?php header("Content-type: text/html; charset=utf-8"); ?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Test Encode</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-promise/4.0.5/es6-promise.auto.min.js"></script> 
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
   


</head>

<body>
    <?php
    /*
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



        require("MacAddressCtrl.class.php");
        $MacObj = new MacAddressCtrl;

         if($MacObj->connectDB("10.20.2.12\MSSQLSERVER","compinventory","@ttg@dm!n$","CompInventoryDB"))
            {
                   $cmdSql = "select PC_NAME,TMP_NAME from [dbo].[IPMAC_TMPINFO] where PC_NAME = 'TMP_NIC_L_26125510085'";
                   $MacData = array();
                   $MacData = $MacObj->execQueryArray($cmdSql);
				   
                   //$xData = json_encode(js_thai_encode($MacData));
                   $xData = json_decode(json_encode(js_thai_encode($MacData)));

                   
                   print_r($xData);
                   
                   echo "<br /><br />";
                   echo "TMP_NAME". $MacData[0]["TMP_NAME"];

                   echo "<br /><br />";
                   print_r($MacData);
            }
    */
    ?>

    <br />

    <form id="formSearchMobile">
        <select class="form-control" id="Company" name="Company" >
                <option value="" selected>กรุณาเลือกบริษัท</option>
                <option value="ATA">ATA</option>
                <option value="NIC">NIC</option>
                <option value="SATI">SATI</option>
                <option value="SNF">SNF</option>
        </select>
        <br />
        <!-- <input id="btnAddMac" type="button" value="Add Mac" class="btn btn-primary submit" > -->
        <button id="btnAddMac" type="button" class="btn btn-primary submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
    </form>

    <script type="text/javascript">

        $("#btnAddMac").click(function(){
            //$('select[id="Company"]').find("option[value='ATA']").attr("selected",true);
            //$("select#Company option").each(function() { this.selected = (this.text == "ATA"); });
            //$("#Company option[value=ATA]").attr('selected','selected');
            $("select[id='Company']").val("ATA").change();
            
        });

    </script>

</body>

</html> 