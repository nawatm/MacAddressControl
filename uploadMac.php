<?php
  include("LoginChk.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge; IE=9; IE=8; IE=7; IE=11;" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="Content/bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="Content/Site.css" rel="stylesheet" type="text/css" />
  <link href="Content/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
  <link href="Content/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  <link href="Content/Custom.css" rel="stylesheet" type="text/css" /> 
  <!-- <link href="Content/theme-default.min.css" rel="stylesheet" type="text/css" />   -->

 <script src="js/es6-promise.auto.min.js"></script> 
 <script src="js/jquery-1.11.1.min.js"></script>
 <script src="js/jquery.validate.min.js"></script>
 <script src="js/additional-methods.min.js"></script>

  <script type="text/javascript" src="Scripts/bootstrap.js"></script>
  <script type="text/javascript" src="Scripts/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="Scripts/bootstrap-datepicker.th.min.js"></script>

  <script src="js/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="css/sweetalert2.css">


  <title>IT-Admin MAC Address Management - Upload MAC Address to DHCP Server</title>
</head>


<body>
  <?php include("header.php"); ?>

  <br/>
  <br/>
  
  <form action="uploadMac.php" method="post">
    <div id="Content" style="margin-bottom:60px;" class="container-fluid">
      <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <h2>Upload MAC Address</h2>
            </div>
        </div>
      <div class="row form-group">
        <div class="col-md-1"></div>
        <div class="col-md-5"><h4>อัพโหลด MAC Address จากฐานข้อมูล ไปยัง DHCP Server ต้นทาง</h4></div> 
      </div>
        
      <div class="row form-group">
        <div class="col-md-1"></div>
        <div class="col-md-2">
            <select class="form-control" name="companyList">
              <option value="NULL" selected>กรุณาเลือกบริษัท</option>
              <option value="ATFB_ATA-BPK">ATFB | ATA-BPK</option>
              <option value="NIC">NIC</option>
              <option value="SATI">SATI</option>  
              <option value="SNF">SNF</option>
              <option value="TEP">TEP | ATA-NVK</option>
            </select>  
        </div>
        <div class="col-md-1">
          <button type="submit" class="btn btn-primary" id="btnSubmit" name="submitbtn">Update MAC</button>
        </div>
      </div> 

    </div>
  </form>

  <div class='row' id='progressNotice'><div class='col-md-1'></div><div class='col-md-8'><h2>ระบบกำลังอัพเดท MAC Address ห้ามปิดหน้าต่างนี้...</h2></div></div>

<script type="text/javascript">
$("#progressNotice").hide();
  
  $("#btnSubmit").click(function() {
    $("#progressNotice").show();
  });
  
</script>


<?php
    include("config.php");
    //set_include_path('../N์et/'); 
    include("Net/SSH2.php");
    include("Net/SCP.php");
    require("MacAddressCtrl.class.php");

    $MacWeb_CONN = $GLOBALS['db_server'];

    $MacWeb_DB = $GLOBALS['db_name'];
    $MacWeb_USER = $GLOBALS['db_user'];
    $MacWeb_PASS = $GLOBALS['db_pwd'];  
    $MacWeb_MacList_Path = $GLOBALS['MacList_Path']; 


    $completeCount = 0;
    $errorCount = 0;
    $resultFlag = TRUE;
    $errorRecord = array();

    function setUploadLog($company,$actor,$status)
    {
        $MacObj = new MacAddressCtrl;
        if($MacObj->connectDB($GLOBALS['db_server'],$GLOBALS['db_user'],$GLOBALS['db_pwd'],$GLOBALS['db_name']))
        {
          $cmdSql = "insert into [dbo].[MacControlLog] values('".$company."',CURRENT_TIMESTAMP,'".$actor."','".$status."');";
          if($MacObj->execNonQuery($cmdSql))
          {
            $MacObj->disconnectDB();
            return TRUE; 
          }
          else
          {
            $MacObj->disconnectDB();
            return FALSE;     
          }
        }
    }

    function getServerList($company)
    {
        // Connect to 10.20.2.12  MSSQL
        global $MacWeb_CONN,$MacWeb_USER,$MacWeb_PASS;
        $link = mssql_connect($MacWeb_CONN,$MacWeb_USER,$MacWeb_PASS);
        
        if (!$link || !mssql_select_db($GLOBALS['db_name'], $link)) 
        {
            //displayMsg("alert-danger","<b>Error</b> : Unable to connect or select database!"); 
            return NULL;
        }
        
        $server = mssql_query("select * from [dbo].[IPMAC_SERVER] where Server_Site ='". $company. "';");
        $row = mssql_fetch_array($server);
        
        // Clean up
        mssql_free_result($server);
        return $row;
    }
    function getMacList()
    {
      global $MacWeb_CONN,$MacWeb_USER,$MacWeb_PASS;
      $link = mssql_connect($MacWeb_CONN,$MacWeb_USER,$MacWeb_PASS);
        
        if (!$link || !mssql_select_db($GLOBALS['db_name'], $link)) {
            displayMsg("alert-danger","<b>Error</b> : Unable to connect or select database!");
            return NULL;
        }
        
        $arrMacList = array();
        $queryCmd = mssql_query("select * from [dbo].[viewMacList];");
        if(mssql_num_rows($queryCmd) > 1)
        {
          while($rowMacList = mssql_fetch_assoc($queryCmd))
          {
            $arrMacList[] = $rowMacList; 
          }
        }
        else
          return NULL;
        
        
        // Clean up
        mssql_free_result($queryCmd);        
        return $arrMacList;
    }
    function createMacList($arrMac)
    {
        global $completeCount,$errorCount,$errorRecord;

        if(is_null($arrMac))
          return FALSE;

        
        $MacCompleteCount = 0;
        $MacErrorCount = 0;
        $MacPattern = "/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/";

        if(count($arrMac) > 1)
        {
            for($i = 0;$i < count($arrMac);$i++)
            {
              if(preg_match($MacPattern,trim($arrMac[$i]['MAC'])))
              {
                    //echo $textMacList ."host ".$arrMac[$i]['ID']." { hardware ethernet ".trim($arrMac[$i]['MAC'])."; }\n";
                    $textMacList =  $textMacList ."host ".$arrMac[$i]['ID']." { hardware ethernet ".$arrMac[$i]['MAC']."; }\n";
                    $MacCompleteCount++;
              }
              else
              {
                    $errorRecord[$MacErrorCount] = "Mac Address error : ".$arrMac[$i]['ID']."  MAC : ".$arrMac[$i]['MAC'];
                    $MacErrorCount++;
              }
            }
            $completeCount = $MacCompleteCount;
            $errorCount = $MacErrorCount;

            /* ------ Create Local MacList fromDB -------- */
            $MacWeb_MacList_Path = getenv("DOCUMENT_ROOT") . "/MAC/MacList/MacList.txt";
            $myfile = fopen($MacWeb_MacList_Path, "w+") or die("Unable to open file!");
            fwrite($myfile, $textMacList);
            fclose($myfile);
            return TRUE;
        }
    }
    function deployMacList($arrServerConfig)
    {
      //global $MacWeb_MacList_Path;
      $MacWeb_MacList_Path = getenv("DOCUMENT_ROOT") . "/MAC/MacList/MacList.txt";

      if(is_null($arrServerConfig))
        return FALSE;

      $connection = ssh2_connect($arrServerConfig[1],22);
      if(ssh2_auth_password($connection, $arrServerConfig[2],$arrServerConfig[3]))
      {
          //echo "connected\n";
          try
          {
            //---------- Transfer file via SCP to select dhcp server ------------------------------
            ssh2_scp_send($connection, $MacWeb_MacList_Path,$arrServerConfig[4]."MacList.txt");

            //------------ Create dhcpd.conf with MAC from Database -------------------------------
            $cmd = "cat ".$arrServerConfig[4]."dhcp_header ".$arrServerConfig[4]."MacList.txt ".$arrServerConfig[4]."dhcp_footer > ".$arrServerConfig[4]."dhcpd.conf";
            ssh2_exec($connection,$cmd);
            return TRUE;
          } 
          catch (Exception $e)
          {
            return FALSE;
          }    
      } 
      else 
          return FALSE;
    }
    function restartRemoteDhcp($arrServerConfig)
    {
        if(is_null($arrServerConfig))
          return FALSE;

        $MacWeb_SSH = new Net_SSH2($arrServerConfig[1]);
        if (!$MacWeb_SSH->login($arrServerConfig[2],$arrServerConfig[3])) 
            return FALSE;
        else
        {
	    if(trim($arrServerConfig[5]) == "systemctl")
	    {
                $MacWeb_SSH->exec($arrServerConfig[5]." force-reload isc-dhcp-server");
                $result =  $MacWeb_SSH->exec($arrServerConfig[5]." is-active isc-dhcp-server");
	    }
	    else
            {
            	$MacWeb_SSH->exec($arrServerConfig[5]." force-reload");
            	//$result =  $MacWeb_SSH->exec($arrServerConfig[5]." status");
		$result =  $MacWeb_SSH->exec("pidof dhcpd >/dev/null && echo 'Status of ISC DHCP server: dhcpd is running.' || echo 'DHCP not running'");
	    }

	if(trim($result) == "Status of ISC DHCP server: dhcpd is running.")
              return TRUE;
	else if(trim($result) == "active")
              return TRUE;
        else
              return FALSE;
        }
          
    }
    function displayMsg($className,$txtMsg)
    {
        $htmlMsg = "<div class='row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-5'>
                          <div class='alert ".$className."' role='alert'>".$txtMsg."</div>
                        </div>
                      </div>";
          echo $htmlMsg;  
    }



    /* ----------- Upload Button Cliek ----------------*/
    if(isset($_POST['companyList']))
    {
        $companyList = $_POST['companyList'];
        
        
        //-----    Load DHCP server config ---------
        echo "<div class='row'><div class='col-md-1'></div><div class='col-md-3'>Load DHCP server config...   </div>";
        $serverInfo = getServerList($companyList); 
        if(!is_null($serverInfo))
        {
            echo "<div class='col-md-1' style='color:green;'>[ OK ]</div></div></div>";

            //------ Load MAC Address list from database ---------
            echo "<div class='row'><div class='col-md-1'></div><div class='col-md-3'>Load MAC Address list from database...   </div>";
            if(createMacList(getMacList()))
            {
              echo "<div class='col-md-1' style='color:green;'>[ OK ]</div></div></div>";

              //----------- Upload Mac address list to remote server ---------------
              echo "<div class='row'><div class='col-md-1'></div><div class='col-md-3'>Upload Mac address list to remote server...   </div>";
              if(deployMacList($serverInfo))
              {
                  echo "<div class='col-md-1' style='color:green;'>[ OK ]</div></div></div>";


                  //------------- Remote restart dhcp server -----------------------
                  
                  echo "<div class='row'><div class='col-md-1'></div><div class='col-md-3'>Remote restart dhcp server...   </div>";
                  if(restartRemoteDhcp($serverInfo))
                  {
                      echo "<div class='col-md-1' style='color:green;'>[ OK ]</div></div></div><br />";
                  }
                  else
                  {
                      echo "<div class = 'col-md-1' style='color:red;'>[ FAIL ]</div></div><div></div>";
                      $resultFlag = FALSE;
                  }
                  
              }
              else
              {
                  echo "<div class = 'col-md-1' style='color:red;'>[ FAIL ]</div></div></div>";
                  $resultFlag = FALSE;  
              }
              
            }
            else
            {
                echo "<div class = 'col-md-1' style='color:red;'>[ FAIL ]</div></div><div></div>";
                $resultFlag = FALSE;  
            }
        }
        else
        {
            echo "<div class = 'col-md-1' style='color:red;'>[ FAIL ]</div></div><div></div>";
            $resultFlag = FALSE; 
        }



        echo "<br />";
        if($resultFlag)
        {
          displayMsg("alert-success","<b>Upload Complete</b> : Complete ".$completeCount." records, <span style='color:red;'>Error ".$errorCount." records.</span>");
          setUploadLog($companyList,$_SESSION['user'],"Complete ".$completeCount." records");
          if($errorCount > 0)
          {
              echo "<div class='row'><div class='col-md-1'></div><div class='col-md-5'><div class='alert alert-warning' role='alert'>";
              echo "<b>Warning</b> MAC Address type mismatch <br />";
              setUploadLog($companyList,$_SESSION['user'],"Error : MAC Address type mismatch");

              for($i = 0; $i < $errorCount; $i++)
              {
                echo $errorRecord[$i]."<br />";
              }

              echo "</div></div></div>";
          }    
        }
        else
        {
          displayMsg("alert-danger","<b>Upload MAC Address Error.</b>");
          setUploadLog($companyList,$_SESSION['user'],"Upload MAC Address Error.");
        }

      echo "</div>";   
      
    }
    
/*
    displayMsg("alert-danger","test a");
    displayMsg("alert-success","test b");
    displayMsg("alert-info","test c");
*/
    
?>
  
</body>

</html>
