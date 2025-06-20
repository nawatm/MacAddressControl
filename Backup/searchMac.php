<?php //include("LoginChk.php"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <!-- <meta charset="utf-8" /> -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge; IE=9; IE=8; IE=7; IE=11;" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  
  <!-- <link href="Content/bootstrap.css" rel="stylesheet" type="text/css" /> -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="Content/Site.css" rel="stylesheet" type="text/css" />
  <link href="Content/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
  <link href="Content/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
  <link href="Content/Custom.css" rel="stylesheet" type="text/css" /> 
  <link href="Content/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />  
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

 <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-promise/4.0.5/es6-promise.auto.min.js"></script> 
 <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
 <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
 <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
   



  <!-- <script type="text/javascript" src="Scripts/bootstrap.js"></script> -->
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="Scripts/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="Scripts/bootstrap-datepicker.th.min.js"></script>

  <script src="https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.js"></script>


<!-- 
<script src="jquery.dynatable.js"></script>
<style src="jquery.dynatable.css"></style> -->


  <title>IT-Admin MAC Address Management - Search MAC Address</title>
</head>


<body>
  <?php include("header.php");
?>

<br />
<br />
<div class="container-fluid"> 
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10"><h2>Search Mac Address</h2></div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10"><h4>ค้นหาข้อมูล MAC Address ในฐานข้อมูลของ ATTG</h4></div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10"> <br />
            <div>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-1" role="tab" data-toggle="tab"><i class="fa fa-desktop" aria-hidden="true"></i><b>  Mobile Device / Customer PC</b></a></li>
                    <li><a href="#tab-2" role="tab" data-toggle="tab"><i class="fa fa-mobile fa-lg" aria-hidden="true"></i><b>  PC/Notebook</b></a></li>
                </ul>
                <div class="tab-content">
                    <!--    Tab Menu 1 :   Mobile Device / Customer PC   -->
                    <div class="tab-pane active well" role="tabpanel" id="tab-1">
                        <form id="formSearchMobile">
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label for="Company2">Company</label>
                                <select class="form-control" id="Company2" name="Company2" >
                                    <option value="" selected>เลือกบริษัท</option>
                                    <option value="ATA">ATA</option>
                                    <option value="ATFB">ATFB</option>
                                    <option value="NIC">NIC</option>
                                    <option value="SATI">SATI</option>
                                    <option value="SNF">SNF</option>
                                    <option value="TEP">TEP</option>
                                </select>
                            </div> 
                            <div class="col-md-2">
                                <label for="DeviceType">Device Type</label>
                                <select class="form-control" id="DeviceType" name="DeviceType" >
                                    <option value="" selected>ประเภทอุปกรณ์</option>
                                    <option value="MOB">Mobile</option>
                                    <option value="COM">PC</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="DeviceOwner">Computer Owner</label>
                                <input id="DeviceOwner" name="DeviceOwner" type="text" class="form-control" placeholder="ชื่อผู้ใช้เครื่อง"/>
                            </div>  
                            <div class="col-md-3">
                                <label for="Mac">MAC Address</label>
                                <input id="Mac2" name="Mac2" type="text" maxlength="17" class="form-control" placeholder="Mac Address"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <!-- <input id="btnAddMac" type="button" value=" Search " class="btn btn-primary submit" > -->
                                <button id="btnSearchMobile" type="button" class="btn btn-primary submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                            </div>
                        </div>
                        </form>
                        

                    </div>

                    <!--    Tab Menu 2 :  PC/Notebook   -->
                    <div class="tab-pane well" role="tabpanel" id="tab-2">

                        <form id="formSearchComputer">
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label for="Company1">Company</label>
                                <select class="form-control" id="Company1" name="Company1" >
                                    <option value="" selected>เลือกบริษัท</option>
                                    <option value="ATA">ATA</option>
                                    <option value="ATFB">ATFB</option>
                                    <option value="NIC">NIC</option>
                                    <option value="SATI">SATI</option>
                                    <option value="SNF">SNF</option>
                                    <option value="TEP">TEP</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="ComputerName">Computer Name</label>
                                <input id="ComputerName" name="ComputerName" type="text" class="form-control" placeholder="ชื่อเครื่องคอมพิวเตอร์" />
                            </div>
                            <div class="col-md-3">
                                <label for="Mac">MAC Address</label>
                                <input id="Mac" name="Mac" type="text" maxlength="17" class="form-control" placeholder="Mac Address" />
                            </div>
                            <div class="col-md-3">
                                <label for="ComputerOwner">Computer Owner</label>
                                <input id="ComputerOwner" name="ComputerOwner" type="text" class="form-control" placeholder="ชื่อผู้ใช้เครื่อง"/>
                            </div>  
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <!-- <input id="btnAddMac" type="button" value=" Search " class="btn btn-primary submit" > -->
                                <button id="btnSearchComputer" name="btnSearchComputer"  type="button" class="btn btn-primary submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                            </div>
                        </div>
                        </form>

                    </div>
                </div>

        <div>
        <br />
        <!-- ComputerName,IpAddress,ComputerOwner,Model,MAC_Lan,MAC_Wireless,Last_Update -->

        <button data-toggle='modal' data-target='#edit-item' class='btn btn-primary edit-item'><span class='glyphicon glyphicon-list-alt' ></span> แก้ไข  </button>

        <table id="searchTable" class="display table table-striped" cellspacing="0" width="100%" > 
        </table>
    </div>



            </div>   
        </div>
    </div>
    
</div>



<div id="response"></div>

<!-- Edit Item Modal -->
		<div class="modal fade bs-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">

                <form id="formModalEdit" data-toggle="validator" action="api/update.php" method="put">    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล Mac Address</h4>
                    </div>

                    <div class="modal-body">
                                <input type="hidden" name="id" class="edit-id">

                                <div class="row form-group">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
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
                                    <div class="col-md-4">
                                        <label for="DeviceBrand">Device Brand</label>
                                        <input id="DeviceBrand" name="DeviceBrand" type="text" class="form-control" placeholder="ยี่ห้ออุปกรณ์" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="DeviceModel">Device Model</label>
                                        <input id="DeviceModel" name="DeviceModel" type="text" class="form-control" placeholder="รุ่นของอุปกรณ์" />
                                    </div>
                                    <!-- <div class="col-md-8"></div> -->
                                </div>
                                
                                <div class="row form-group">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3">
                                        <label for="UserName">Firstname - Lastname</label>
                                        <input id="UserName" name="UserName" type="text" class="form-control" placeholder="ชื่อ-สกุล ผู้ขอใช้งาน" />
                                    </div>
                                    <div class="col-md-3">
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
                                    <div class="col-md-3">
                                        <label for="Subject">Subject</label>
                                        <textarea id="Subject" name="Subject" class="form-control" placeholder="วัตถุประสงค์การขอใช้งาน" rows="4"></textarea>
                                    </div>
                                
                                    <div class="col-md-3">
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
                                    <div class="col-md-2"></div>
                                </div>

                                <!-- MAC Address txtbox -->
                                <div class="row form-group">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3">
                                        <label for="Mac">MAC Address</label>
                                        <input id="MacEdit" name="Mac" type="text" maxlength="17" class="form-control" />
                                    </div>
                                </div>

                    </div> <!-- end modl-body -->
                    
                    <div class="modal-footer">
                        <input id="btnAddMac" type="submit" value="Add Mac" class="btn btn-primary submit" > 
                        <!-- <button id="btnOtherDevice" type="button" class="btn btn-primary submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button> -->
                    </div>

                </form>
		    </div>
		  </div>
		</div>

<script type="text/javascript">

    //$("body").on("click",".editOtherDevice",function(){
    $("body").on("click",".editModal",function(){

    //$("#btnEdit").click(function(){

        var vMac = $(this).parent("td").prev("td").prev("td").prev("td").text();
        //$("#edit-item").find("input[id='MacEdit']").val(a);
        //alert(vMac);

        $.ajax({
                url: "searchMacCtrl.php?status=edit",
                type: 'POST',
                dataType: 'html',
                //data: $('#formSearchMobile').serialize(),
                data: {MAC : vMac},
                success: function(result)
                { 
                    //var dataObj = JSON.parse(result);
                    var dataObj = jQuery.parseJSON(result);  
                    
                    $("#editModal").find("select[id='DeviceType']").val(dataObj[0].DeviceType.trim());
                    $("#editModal").find("input[id='MacEdit']").val(dataObj[0].Mac.trim());
                    $("#editModal").find("input[id='DeviceBrand']").val(dataObj[0].DeviceBrand.trim());
                    $("#editModal").find("input[id='DeviceModel']").val(dataObj[0].DeviceModel.trim());
                    $("#editModal").find("input[id='UserName']").val(dataObj[0].UserName.trim());
                    $("#editModal").find("select[id='Company']").val(dataObj[0].Company.trim());    
                    $("#editModal").find("input[id='DeptName']").val(dataObj[0].DeptName.trim());    
                    $("#editModal").find("textarea[id='Subject']").val(dataObj[0].Subject.trim());
                    $("#editModal").find("select[id='ExpirePeriod']").val(0);
                    $("#editModal").find("input[id='ExpireDate']").removeAttr('disabled').val(dataObj[0].ExpiredDate.trim());    
                    
                   //$("#editModal").find("select[id='Company']").val('ATA').change();

                   
                }, 
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert('error: ' + textStatus + ': ' + errorThrown);
                }
                
        });
        
    });

    

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

    $("#MacEdit").keypress(function (event) {
        var tmpMac = this.value.trim().toUpperCase();
        if ((tmpMac.length == 2) || (tmpMac.length == 5) || (tmpMac.length == 8) || (tmpMac.length == 11) || (tmpMac.length == 14))
        {
            tmpMac =  tmpMac + ":";
        }
        this.value = tmpMac;
        return isNumber(event, this.value.toUpperCase());
    });

    function isNumber(evt, element) {
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


      $("#formEditMac").validate({
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

</script>




<script type="text/javascript">

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
   
    var validMac = function (event)
    {
        //var tmpMac = macValue.trim().toUpperCase();
        //var tmpMac = document.getElementById('Mac').value.toUpperCase();
        var tmpMac = this.value.trim().toUpperCase();

        if (
            (tmpMac.length == 2) || (tmpMac.length == 5) || (tmpMac.length == 8) || (tmpMac.length == 11) || (tmpMac.length == 14)
            )
        {
            tmpMac =  tmpMac + ":";
        }
        this.value = tmpMac;
        //document.getElementById('Mac').value = tmpMac;

        return isNumber(event, this.value.toUpperCase());    
    }



    $("#Mac").keypress(validMac);
    $("#Mac2").keypress(validMac);


    $("#formSearchComputer").validate({
    rules: {
            Company1: {
            required: true
            }
    },
    messages: {
            Company1: {
            required: "<span style='color: red;'>กรุณาเลือกบริษัท</span>"
            }
    }
    });




    $("#btnSearchComputer").click(function() 
    {
        //var data = $('#formSearchComputer').serializeArray();
        if($("#formSearchComputer").valid())
        {
            $.ajax({
                url: 'searchMacCtrl.php?type=computer',
                type: 'POST',
                dataType: 'html',
                data: $('#formSearchComputer').serialize(),

                // ComputerName,IpAddress,ComputerOwner,Model,MAC_Lan,MAC_Wireless,Last_Update */
                success: function(result)
                { 

                    //$("#searchTable tbody tr").remove();  
                    $("#searchTable thead").remove();  
                    $("#searchTable tbody tr").remove();  

                    /*--- Return by HTML Type ---*/
                    $("#searchTable").append(result); 

                    /*----- Return by JSON Type ----
                    var jsonData = $.parseJSON(result);
                    $.each(jsonData, function(index, value) {
                        
                        //var row = $("<tr><td>" + value.RowID + "</td><td>" + value.ComputerName + "</td><td>" + value.IpAddress + "</td><td>"+ value.ComputerOwner +"</td><td>"+ value.Model +"</td><td>"+ value.MAC_Lan +"</td><td>"+ value.MAC_Wireless +"</td><td>"+ value.Last_Update +"</td></tr>");
                        var row = "<tr><td>" + value.RowID + "</td><td>" + value.ComputerName + "</td><td>" + value.IpAddress + "</td><td>"+ value.ComputerOwner +"</td><td>"+ value.Model +"</td><td>"+ value.MAC_Lan +"</td><td>"+ value.MAC_Wireless +"</td><td>"+ value.Last_Update +"</td></tr>";
                        $("#searchTable").append(row);
                    }); 
                    */

                    $("#searchTable").DataTable();
                    //$("#response").html(result);
                }, 
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert('error: ' + textStatus + ': ' + errorThrown);
                }
                
            }); 
        }
    });

    $("#btnSearchMobile").click(function() 
    {
        if($("#formSearchMobile").valid())
        {
            $.ajax({
                url: 'searchMacCtrl.php?type=mobile',
                type: 'POST',
                dataType: 'html',
                data: $('#formSearchMobile').serialize(),
                success: function(result)
                { 
                    $("#searchTable thead").remove();  
                    $("#searchTable tbody tr").remove();  

                    /*--- Return by HTML Type ---*/
                    $("#searchTable").append(result); 
                    $("#searchTable").DataTable();
                    //$("#response").html(result);
                }, 
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert('error: ' + textStatus + ': ' + errorThrown);
                }
                
            }); 
        }
    });

</script>


</body>
</html>