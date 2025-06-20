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
          <li role="presentation"><a href="index.php">Home</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MAC Address Control <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li role="presentation"><a href="addMac.php">Add MAC Address</a></li>
              <li role="presentation"><a href="searchMac.php">Search MAC Address</a></li>
              <li><a href="uploadMac.php">Upload MAC to DHCP</a></li>
            </ul>
          </li>
          
          <li role="presentation"><a href="">Hi! <? echo $_SESSION['user']; ?></a></li>   
          <li role="presentation"><a href="logout.php">Logoff</a></li>
        </ul>
      </div>

    </div>
  </div>