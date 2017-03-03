<?php
  include("LoginChk.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge; IE=9; IE=8; IE=7; IE=11;" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="Content/bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="Content/Site.css" rel="stylesheet" type="text/css" />
  <link href="Content/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
  <link href="Content/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
  <link href="Content/Custom.css" rel="stylesheet" type="text/css" /> 
  <link href="Content/theme-default.min.css" rel="stylesheet" type="text/css" />  
  
 <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-promise/4.0.5/es6-promise.auto.min.js"></script> 
 <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
 <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
 <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
   


  <script type="text/javascript" src="Scripts/bootstrap.js"></script>
  <script type="text/javascript" src="Scripts/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="Scripts/bootstrap-datepicker.th.min.js"></script>



  <script src="https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.css">




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
  <div class="col-md-10"><h2>Add MAC / Device Information</h2>
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
  <option value="MOB">Mobile</option>
  <option value="COM">Computer</option>
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
   


  


  <script type="text/javascript">

  $("#ExpirePeriod").change(function() {
    if($("#ExpirePeriod").val() == "0")
    {
      $("#ExpireDate").removeAttr("disabled");
    }
    else
    {
      $("#ExpireDate").attr("disabled", "disabled");
    }
    
  });

$('.input-group.date').datepicker({
    pickTime: true,
    format: "yyyy-mm-dd",
    todayBtn: true,
    language: "th",
    autoclose: true,
    todayHighlight: true,
    startDate: 'today'
  });
  
   


  $("#Mac").keypress(function (event) {
  //var tmpMac = this.value.trim().toUpperCase().replace(/([~!#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '').replace(/^(-)+|(-)+$/g, '');
  var tmpMac = this.value.trim().toUpperCase();
  if (
    (tmpMac.length == 2) || (tmpMac.length == 5) || (tmpMac.length == 8) || (tmpMac.length == 11) || (tmpMac.length == 14)
    )
  {
    tmpMac =  tmpMac + ":";
  }
  this.value = tmpMac;
  return isNumber(event, this.value.toUpperCase());
  });

  function isNumber(evt, element) 
  {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (
    (charCode < 65 || charCode > 70) && // A-F
    (charCode < 48 || charCode > 57) && // a-f
    (charCode < 97 || charCode > 102)
    ) 
    {
    return false;
    }
  return true;
  }

  $.validator.addMethod("regex",function(value, element, regexp) {
  var check = false;
  return this.optional(element) || regexp.test(value);
  },
  "รูปแบบของ MAC Address ไม่ถูกต้อง"
  );

  $("#formAddMac").validate({
  rules: {
  DeviceBrand: {
  required: true
  },
  DeviceType: {
  required: true
  },  
  DeviceModel: {
  required: true
  },
  UserName: {
  required: true
  },
  DeptName: {
  required: true
  },
  Company: {
  required: true
  },
    ExpirePeriod: {
  required: true
  },
    ExpireDate: {
    //	required: true,
    required: {
      depends: function(element){
          return $("#ExpirePeriod").val() == "0"; 
      }
    }
    },
  Mac: {
  required: true,
  maxlength: 17,
  regex: /^(([A-Fa-f0-9]{2}[:]){5}[A-Fa-f0-9]{2}[,]?)+$/
  }
  },
  messages: {
  DeviceBrand: {
  required: "<span style='color: red;'>กรุณากรอกยี่ห้อของอุปกรณ์</span>"
  },
  DeviceType: {
  required: "<span style='color: red;'>กรุณากรอกประเภทของอุปกรณ์</span>"
  },
  DeviceModel: {
  required: "<span style='color: red;'>กรุณากรอกประเภทของรุ่นอุปกรณ์</span>"
  },
  UserName: {
  required: "<span style='color: red;'>กรุณากรอกชื่อผู้ขอใช้งาน</span>"
  },
  DeptName: {
  required: "<span style='color: red;'>กรุณากรอกแผนกของผู้ใช้งาน</span>"
  },
  Company: {
  required: "<span style='color: red;'>กรุณาเลือกบริษัทฯ</span>"
  },
    ExpirePeriod: {
    required: "<span style='color: red;'>กรุณาเลือกวันหมดอายุ</span>"
    },
    ExpireDate: {
    required: "<span style='color: red;'>กรุณากำหนดวันหมดอายุ</span>"
    },
  Mac: {
  required: "<span style='color: red;'>กรุณากรอก MAC Address</span>",
  regex: "<span style='color: red;'>รูปแบบของ MAC Address ไม่ถูกต้อง</span>"
  }
  }
  });


  $("#btnAddMac").click(function() {
  if($("#formAddMac").valid())
  {
    var data = $('#formAddMac').serializeArray();
    $.ajax({
        url: 'addMacCtrl.php',
        type: 'POST',
        data: data,
        success: function(data)
        {
          //$("#response").html(data);
          if(data =="COMPLETE")
          {
          //$("#response").html(data);
            $("#formAddMac")[0].reset();
            swal("Insert Complete", "MAC Address ได้เพิ่มลงในฐานข้อมูลเรียบร้อยแล้ว", "success");
          }
          else if(data == "EXIST")
          {
              swal("Insert Error", "MAC Address ดังกล่าวมีอยู่ในระบบแล้ว", "error");
          }
          else
          {
            swal("Insert Error", "เกิดปัญหาในการเชื่อมต่อฐานข้อมูล", "error");
          }
        }
    }); 
  }


  });

  </script>
  
</body>
</html>