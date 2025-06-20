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
  <?php include("header.php");
?>
  <br />
  <br />
  <div class="container-fluid"> 
  <div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10"><h2>Add MAC Address for Mobile and other devices.</h2>
  </div>        
  </div>
  <div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10"><h4>กรอกข้อมูลทั่วไปของอุปกรณ์ และ MAC Address เพื่อขอสิทธิ์การใช้งานเครือข่ายบริษัท ATTG</h4></div>
  </div>
  <br />
  
  <form id="formAddMac">
  <div class="row form-group">
  <div class="col-md-1"></div>
  <div class="col-md-3">
  <label for="DeviceType">Device Type</label>
  <select class="form-control" id="DeviceType" name="DeviceType">
  <option value="" selected>กรุณาเลือกประเภทอุปกรณ์</option>
  <option value="MOB">Mobile Device</option>
  <option value="COM">Computer Notebook</option>
  <option value="TAB">Tablet Device</option>
  <option value="AGV">AGV</option>
  <option value="IOT">IoT Device</option>

  </select>
  </div>
  </div>

  <div class="row form-group validText">
  <div class="col-md-1"></div>
  <div class="col-md-2">
  <label for="DeviceBrand">Device Brand</label>
  <input id="DeviceBrand" name="DeviceBrand" type="text" class="form-control" placeholder="ยี่ห้ออุปกรณ์" />
  </div>
  <div class="col-md-2">
  <label for="DeviceModel">Device Model</label>
  <input id="DeviceModel" name="DeviceModel" type="text" class="form-control" placeholder="รุ่นของอุปกรณ์" />
  </div>
  <div class="col-md-8"></div>
  </div>

  <div class="row form-group">
  <div class="col-md-1"></div>
  <div class="col-md-2">
  <label for="UserName">Firstname - Lastname</label>
  <input id="UserName" name="UserName" type="text" class="form-control" placeholder="ชื่อ-สกุล ผู้ขอใช้งาน" />
  </div>
  <div class="col-md-2">
  <label for="Company">Company</label>
  <div class="form-group">
  <select class="form-control" id="Company" name="Company" >
  <option value="" selected>กรุณาเลือกบริษัท</option>
  <option value="ATA">ATA</option>
  <option value="ATFB">ATFB</option>
  <option value="NIC">NIC</option>
  <option value="SATI">SATI</option>
  <option value="SNF">SNF</option>
  <option value="TEP">TEP</option>
  </select>
  </div>
  </div>               
  <div class="col-md-3">
  <label for="DeptName">Department</label>
  <input id="DeptName" name="DeptName" type="text" class="form-control" placeholder="หน่วยงานผู้ขอใช้งาน" />
  </div>                       
  </div>

  <div class="row form-group">
    <div class="col-md-1"></div>
    <!-- Subject -->
    <div class="col-md-2">
      <label for="Subject">Subject</label>
      <textarea id="Subject" name="Subject" class="form-control" placeholder="วัตถุประสงค์การขอใช้งาน" rows="4"></textarea>
    </div>
  
  <div class="col-md-2">
    <label for="ExpirePeriod">Expire On</label>
    <select class="form-control" id="ExpirePeriod" name="ExpirePeriod" >
      <option value="" selected>วันหมดอายุ</option>
      <option value="7">1 Week</option>
      <option value="31">1 Month</option>
      <option value="186">6 Months</option>
      <option value="365">1 Year</option>
      <option value="1095">3 Years</option>
      <option value="0">กำหนดเอง</option>
    </select>
    
    <div class="input-group date">
      <label for="ExpireDate"></label>
      <input type='text' class="form-control" id="ExpireDate" name="ExpireDate" disabled/>
      <span class="input-group-addon">
      <span class="glyphicon glyphicon-calendar"></span>
      </span>
    </div>

  </div>

  <div class="col-md-2">
    
  </div>


  </div>

  <!-- MAC Address txtbox -->
  <div class="row form-group">
  <div class="col-md-1"></div>
  <div class="col-md-3">
  <label for="Mac">MAC Address</label>
  <input id="Mac" name="Mac" type="text" maxlength="17" class="form-control" />
  </div>
  </div>

  <div class="row">
  <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
  <!-- <button type="submit" class="btn btn-primary" id="btnSubmit" value="AddMac" >  Save  </button> -->
  <input id="btnAddMac" type="button" value="Add Mac" class="btn btn-primary submit" >
  </div>
  </div>   
  </form>
  
  </div>
  <div id="response"></div>

    <script src="js/mac_control.js"></script>
    
</body>
</html>
