<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge; IE=9; IE=8; IE=7; IE=11;" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="Content/bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="Content/Custom.css" rel="stylesheet" type="text/css" />
  <link href="Content/Site.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="Scripts/jquery-1.10.2.js"></script>
  <script type="text/javascript" src="Scripts/bootstrap.js"></script>


  <title>IT-Admin MAC Address Management - Upload MAC Address to DHCP Server</title>

  

  <script type="text/javascript">
    function test() {
      $('#myModal').modal('show');
      //alert("Oversize...");
    }
  </script>


</head>

<body>
  <?php include("header.php"); ?>
  <br/>
  <br/>


  <form action="uploadMac.php" method="post">
    <div id="Content" style="margin-bottom:60px;" class="container-fluid">
      <div class="row form-group">
        <div class="col-md-1"></div>
        <div class="col-md-3">
          <label for="companyList">อัพเดทรายการ MAC Address</label>
          <div class="form-group">
            <select class="form-control" name="companyList">
              <option value="NULL" selected>กรุณาเลือกบริษัท</option>
              <option value="ATFB_ATA-BPK">ATFB</option>
              <option value="NIC">NIC</option>
              <option value="SATI">SATI</option>
              <option value="SNF">SNF</option>
              <option value="TEP">TEP</option>
            </select>
          </div>
          <!-- <input type="submit" name="Update MAC" class="btn btn-primary"/> -->
          <button type="submit" class="btn btn-primary" id="btnSubmit" name="submitbtn">Update MAC</button>
        </div> 
      </div>
    </div>
  </form>

<script>
$(function(){
    $('#btnSubmit').click(function(){
      $.ajax({
        url:'rand.php',
        success:function(result)
                { 
                    $('.result').append(result);
                }
      });
    });
});
</script>

<div class="result"></div>

  <?php
    include('Net/SSH2.php');
    include('Net/SCP.php');

    $MacWeb_CONN = "10.20.2.12\MSSQLSERVER";
    $MacWeb_DB = "compinventory";
    $MacWeb_PASS = "@ttg@dm!n$";    
    $MacWeb_MacList_Path = getenv("DOCUMENT_ROOT") . "/MAC/MacList/MacList.txt";


    $completeCount = 0;
    $errorCount = 0;
    $resultFlag = TRUE;
    $errorRecord = array();

   
    function getServerList($company)
    {
        // Connect to 10.20.2.12  MSSQL
        global $MacWeb_CONN,$MacWeb_DB,$MacWeb_PASS;
        $link = mssql_connect($MacWeb_CONN,$MacWeb_DB,$MacWeb_PASS);
        
        if (!$link || !mssql_select_db('compinventoryDB', $link)) 
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
      global $MacWeb_CONN,$MacWeb_DB,$MacWeb_PASS;
      $link = mssql_connect($MacWeb_CONN,$MacWeb_DB,$MacWeb_PASS);
        
        if (!$link || !mssql_select_db('compinventoryDB', $link)) {
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
      global $MacWeb_MacList_Path;

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
          $MacWeb_SSH->exec($arrServerConfig[5]." force-reload");
          $result =  $MacWeb_SSH->exec($arrServerConfig[5]." status");
          if(trim($result) == "Status of ISC DHCP server: dhcpd is running.")
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
    if(isset($_POST['companyListxxxxxxxxxxxx']))
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
          if($errorCount > 0)
          {
              echo "<div class='row'><div class='col-md-1'></div><div class='col-md-5'><div class='alert alert-warning' role='alert'>";
              echo "<b>Warning</b> MAC Address type mismatch <br />";
            
              for($i = 0; $i < $errorCount; $i++)
              {
                echo $errorRecord[$i]."<br />";
              }

              echo "</div></div></div>";
          }    
        }
        else
          displayMsg("alert-danger","<b>Upload MAC Address Error.</b>");

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