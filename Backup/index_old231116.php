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


  <title></title>



  <script type="text/javascript">
    function test() {
      $('#myModal').modal('show');
      //alert("Oversize...");
    }
  </script>


</head>

<body>
  <div class="navbar navbar-default-menu navbar-fixed-top">
    <div class="container-fluid">

      <div class="navbar-header">

        <div class="navbar-brand">
          <p><img src="images/ATTG_White_20px.png" /> : IT-Admin Management Tools</p>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div id="navbar" class="navbar-collapse collapse">

        <ul class="nav navbar-nav navbar-right">
          <li role="presentation"><a href="">Home</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MAC Address Control <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li role="presentation"><a href="">Add MAC</a></li>
              <li><a href="InvoiceHINO.aspx">HINO Invoice Barcode</a></li>
            </ul>
          </li>
          <li role="presentation"><a href="">Logoff</a></li>

        </ul>
        <!-- <p class="navbar-text navbar-right"></p> -->
      </div>

    </div>
  </div>
  <br/>
  <br/>



  <form action="index.php" method="post">
    <div id="Content" style="margin-bottom:60px;margin-left:50px;" class="container-fluid">
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

          <button type="submit" class="btn btn-primary" id="btnSubmit">Update MAC</button>
          <!-- <input type="submit" name="Update MAC" class="btn btn-primary"/> -->
        </div>
      </div>
    </div>
  </form>


  <?php
    include('Net/SSH2.php');
    include('Net/SCP.php');
    
    $MacWeb_USER = "root";
    $MacWeb_PASS = "@ttg@dm!n$";
    $MacWeb_MacList_Path = getenv("DOCUMENT_ROOT") . "/MAC/MacList/MacList.txt";
    

    
    function getServerList($company)
    {
        // Connect to 10.20.2.12  MSSQL
        $link = mssql_connect('10.20.2.12\MSSQLSERVER', 'compinventory', '@ttg@dm!n$');
        
        if (!$link || !mssql_select_db('compinventoryDB', $link)) {
            die('Unable to connect or select database!');
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
      $link = mssql_connect('10.20.2.12\MSSQLSERVER', 'compinventory', '@ttg@dm!n$');
        
        if (!$link || !mssql_select_db('compinventoryDB', $link)) {
            die('Unable to connect or select database!');
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
                    echo "Mac Address error : ".$arrMac[$i]['ID']." MAC : ".$arrMac[$i]['MAC']."<br />";
                    $MacErrorCount++;
              }
            }

            echo "Complete : Update MAC address = ".$MacCompleteCount." records. <br />";
            echo "Error : Update MAC address  = ".$MacErrorCount." records. <br />";

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
      if(is_null($arrServerConfig))
        return FALSE;

      $MacWeb_MacList_Path = getenv("DOCUMENT_ROOT") . "/MAC/MacList/MacList.txt";
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
            echo "Error".$e->getMessage()."<br/>";
            return FALSE;
          }    
      } 
      else 
      {
          echo "connection failed\n";
          return FALSE;
      }
      
      
    }

    function restartRemoteDhcp($arrServerConfig)
    {
        if(is_null($arrServerConfig))
          return FALSE;

        $MacWeb_SSH = new Net_SSH2($arrServerConfig[1]);
        if (!$MacWeb_SSH->login($arrServerConfig[2],$arrServerConfig[3])) 
        {
            echo('Login Failed');
            return FALSE;
        }
        else
        {
          $MacWeb_SSH->exec($arrServerConfig[5]." force-reload");
          $result =  $MacWeb_SSH->exec($arrServerConfig[5]." status");
          if(trim($result) == "Status of ISC DHCP server: dhcpd is running.")
          {
              echo "Update Complete.";
              return TRUE;
          }
          else
          {
              echo "Update Error! : ".$result."<br />";
              return FALSE;
          }
        }
          
    }


    if(isset($_POST['companyList']))
    {
        $companyList = $_POST['companyList'];
        
        $serverInfo = getServerList($companyList); // Get DHCP Server Config from Database 
        $vMacList = getMacList();                  // Get Mac from Center Database

        if(createMacList($vMacList))
        {
          if(deployMacList($serverInfo))
              restartRemoteDhcp($serverInfo);
        }

    }

        /* --- $serverInfo -------
        Server_Site	varchar(50)	Unchecked
        IP_Address	varchar(50)	Unchecked
        Username	varchar(50)	Unchecked
        Password	varchar(50)	Unchecked
        Script_Path	varchar(MAX)	Unchecked
        Service_Path	varchar(MAX)	Unchecked
        Description	varchar(MAX)	Checked
        MAC_TYPE	varchar(50)	Checked
        */
       
       
       /*
        $ssh = new Net_SSH2($serverInfo[1]);
        if (!$ssh->login($serverInfo[2],$serverInfo[3])) 
        {
            exit('Login Failed');
        }
        else
        {
          //$ssh->exec($serverInfo[5].' force-reload');
          $ssh->exec("touch /MacList/maclist.txt");
          $ssh->exec("echo ". $vMacList."> /MacList/maclist.txt");
        }
        */
       
       /* -------- Transfer MAC List to select server --------
        $MacWeb_SSH = new Net_SSH2($arrServerConfig[1]);
        if (!$MacWeb_SSH->login($arrServerConfig[2],$arrServerConfig[3])) 
        {
            exit('Login Failed');
        }
        else
        {
          $MacWeb_SCP = new Net_SCP($MacWeb_SSH);
          if(!$MacWeb_SCP->put("/var/www/mac/MacList/MacList.txt","/MacList/MacList.txt",NET_SCP_LOCAL_FILE))
          {
            echo "Send File Fail";
          }
          
          //$MacWeb_SSH->exec("touch /MacList/maclist.txt");
          //$MacWeb_SSH->exec("echo ".$textMacList." >> /MacList/maclist.txt");

        }
        */


        /* -------- Transfer MAC List to select server --------
        $MacWeb_SSH = new Net_SSH2($arrServerConfig[1]);
        if (!$MacWeb_SSH->login($arrServerConfig[2],$arrServerConfig[3])) 
        {
            exit('Login Failed');
        }
        else
        {
          $MacWeb_SSH->exec("touch /MacList/maclist.txt");
          $MacWeb_SSH->exec("echo ".$textMacList." >> /MacList/maclist.txt");
        }*/

        /*------------ Remote restart dhcp service --------------------------------------------
            $cmd = $arrServerConfig[5]." force-reload";
            ssh2_exec($connection,$cmd);

            $cmd = $arrServerConfig[5]." status";
            $stream = ssh2_exec($connection,$cmd);
            stream_set_blocking($stream, true);
            $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
            
            $result = trim(stream_get_contents($stream_out));
            echo $result."<br />"; 
            if($result == "Status of ISC DHCP server: dhcpd is running.")
            {
               echo "Update Complete.";
            }
            else
            {
              echo "Update Error!";
            }
            */
?>

</body>

</html>