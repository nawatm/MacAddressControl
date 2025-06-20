<?php //include("LoginChk.php"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  
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
                    <li class="active"><a href="#tab-1" role="tab" data-toggle="tab"><i class="fa fa-desktop" aria-hidden="true"></i><b> PC/Notebook</b></a></li>
                    <li><a href="#tab-2" role="tab" data-toggle="tab"><i class="fa fa-mobile fa-lg" aria-hidden="true"></i><b> Mobile Device / Customer PC</b></a></li>
                </ul>
                <div class="tab-content">
                    <!--    Tab Menu 1 :   Computer PC   -->
                    <div class="tab-pane active well" role="tabpanel" id="tab-1">
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

                    <!--    Tab Menu 2 :  Mobile Phone   -->
                    <div class="tab-pane well" role="tabpanel" id="tab-2">
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
                </div>

                    <div>
    <br />
    <!-- ComputerName,IpAddress,ComputerOwner,Model,MAC_Lan,MAC_Wireless,Last_Update -->

    <button data-toggle='modal' data-target='#edit-item' class='btn btn-primary edit-item'><span class='glyphicon glyphicon-list-alt' ></span> แก้ไข  </button>

    <table id="searchTable" class="display table table-striped" cellspacing="0" width="100%" > 
    <!--
        <thead>        
                <tr>
                    <th align='center' valign='middle'>RowID</th>
                    <th align='center' valign='middle'>Computer Name</th>
                    <th align='center' valign='middle'>Computer Owner</th>
                    <th>MAC LAN</th>
                    <th>MAC Wireless</th>
                    <th>Last Update</th> 
                    <th>Action</th> 
                </tr>
        </thead> -->
    </table>
</div>



            </div>   
        </div>
    </div>
    
</div>



<div id="response"></div>

<!-- Edit Item Modal -->
		<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล Mac Address</h4>
		      </div>

		      <div class="modal-body">
		      		<form id="formEditMac" data-toggle="validator" action="api/update.php" method="put">
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

                        <div class="row form-group">
                          <!--
							<label class="control-label" for="title">Title:</label>
							<input type="text" name="title" class="form-control" data-error="Please enter title." required />
							
							<label class="control-label" for="title">Description:</label>
							<textarea name="description" class="form-control" data-error="Please enter description." required></textarea>
                            -->
							<button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
						</div>

                        

		      		</form>

		      </div>
		    </div>
		  </div>
		</div>





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