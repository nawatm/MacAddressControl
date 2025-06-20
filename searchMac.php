<?php include("LoginChk.php"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <!-- <meta charset="utf-8" /> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge; IE=9; IE=8; IE=7; IE=11;" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- <link href="Content/bootstrap.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="Content/Site.css" rel="stylesheet" type="text/css" />
    <link href="Content/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
    <link href="Content/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="Content/Custom.css" rel="stylesheet" type="text/css" />
    
    <!-- <link href="Content/bootstrap-theme.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="css/font-awesome.min.css">

    <script src="js/es6-promise.auto.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/additional-methods.min.js"></script>

    
    <!-- <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script type="text/javascript" src="Scripts/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="Scripts/bootstrap-datepicker.th.min.js"></script>

    <script src="js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.css">

    <link rel="stylesheet" type="text/css" href="css/datatables.min.css" />
    <script type="text/javascript" src="js/datatables.min.js"></script>


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
            <div class="col-md-10">
                <h2>Search Mac Address</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <h4>ค้นหาข้อมูล MAC Address ในฐานข้อมูลของ ATTG</h4>
            </div>  
            <div class="col-md-5">
                <div class=" pull-right">
                <button id="btnAddMac" name="btnAddMac" type="button" class="btn btn-info"  onClick="location.href='addMac.php'"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Add MAC</button> 
                <button id="btnUploadMac" name="btnUploadMac" type="button" class="btn btn-success submit"onClick="location.href='uploadMac.php'"><i class="glyphicon glyphicon-refresh" aria-hidden="true"></i> Upload MAC</button> 
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>


            <div class="col-md-10"> <br />
                <div>
                    <ul class="nav nav-tabs" id="tabMenu">
                        <li class="active"><a href="#tab-1" role="tab" data-toggle="tab"><i class="fa fa-desktop" aria-hidden="true"></i><b>   Mobile Device / Customer PC</b></a></li>
                        <li><a href="#tab-2" role="tab" data-toggle="tab"><i class="fa fa-mobile fa-lg" aria-hidden="true"></i><b>   PC/Notebook</b></a></li>
                    </ul>
                    <div class="tab-content">
                        <!--    Tab Menu 1 :   Mobile Device / Customer PC   -->
                        <div class="tab-pane active well" role="tabpanel" id="tab-1">
                            <form id="formSearchMobile">
                                <div class="row form-group">
                                    <div class="col-md-2">
                                        <label for="Company2">Company</label> 
                                        <select class="form-control" id="Company2" name="Company2">
                                    <option value="ALL" selected>ทั้งหมด</option> <!-- <option value="" selected>เลือกบริษัท</option> -->
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
                                        <select class="form-control" id="DeviceType" name="DeviceType">
                                    <option value="" selected>ประเภทอุปกรณ์</option>
                                    <option value="MOB">Mobile</option>
                                    <option value="COM">PC</option>
  				    <option value="TAB">Tablet Device</option>
  				    <option value="AGV">AGV</option>
  				    <option value="IOT">IoT Device</option>
                                </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="DeviceOwner">Computer Owner</label>
                                        <input id="DeviceOwner" name="DeviceOwner" type="text" class="form-control" placeholder="ชื่อผู้ใช้เครื่อง" />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="Mac2">MAC Address</label>
                                        <input id="Mac2" name="Mac2" type="text" maxlength="17" class="form-control" placeholder="Mac Address" />
                                        
                                    </div>
                                    <div class="col-md-1">
                                        <!-- <input id="btnAddMac" type="button" value=" Search " class="btn btn-primary submit" > -->
                                        <!-- <label for="btnSearchMobile"> sss </label> --><br />
                                        <div style="vertical-align:text-baseline;"><button id="btnSearchMobile" type="button" class="btn btn-primary submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button></div>
                                    </div>
                                </div>
                            </form>


                        </div>

                        <!--    Tab Menu 2 :  PC/Notebook   -->
                        <div class="tab-pane well" role="tabpanel" id="tab-2">
                            <form id="formSearchComputer">
                                <div class="row form-group">
                                    <div class="col-md-2">
                                        <label for="ComputerCompany">Company</label>
                                        <select class="form-control" id="ComputerCompany" name="ComputerCompany">
                                    <option value="ALL" selected>ทั้งหมด</option><!-- <option value="" selected>เลือกบริษัท</option> -->
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
                                    <div class="col-md-2">
                                        <label for="ComputerMac">MAC Address</label>
                                        <input id="ComputerMac" name="ComputerMac" type="text" maxlength="17" class="form-control" placeholder="Mac Address" />
                                    </div>
                                    <div class="col-md-3">
                                        <label for="ComputerOwner">Computer Owner</label>
                                        <input id="ComputerOwner" name="ComputerOwner" type="text" class="form-control" placeholder="ชื่อผู้ใช้เครื่อง" />
                                    </div>
                                    <div class="col-md-1">
                                        <br />
                                        <button id="btnSearchComputer" name="btnSearchComputer" type="button" class="btn btn-primary submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                    </div>
                                </div>
                              
                            </form>

                        </div>
                    </div>

                    <div>
                        <br />
                        <div id="searchMobilePanel"><table id="searchTable" class="display table table-striped" cellspacing="0" width="100%"></table></div>
                        <div id="searchComputerPanel"><table id="searchComputerTable" class="display table table-striped" cellspacing="0" width="100%"></table></div>
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
                <!-- <form id="formModalEdit" data-toggle="validator" action="api/updateMac.php" method="put"> -->
                <form id="formModalEdit">
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
                                    <select class="form-control" id="Company" name="Company">
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
                                <select class="form-control" id="ExpirePeriod" name="ExpirePeriod">
                                            <option value="" selected>วันหมดอายุ</option>
                                            <option value="7">1 Week</option>
                                            <option value="31">1 Month</option>
                                            <option value="186">6 Months</option>
                                            <option value="365">1 Year</option>
                                            <option value="1095">3 Years</option>
                                            <option value="0">กำหนดเอง</option>
                                        </select>

                                <div class="input-group date">
                                    <label for="ExpiredDate"></label>
                                    <input type='text' class="form-control" id="ExpiredDate" name="ExpiredDate" disabled/>
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
                                <label for="MacEdit">MAC Address</label>
                                <!-- <label id="MacEdit" name="MacEdit" class="form-control"/> -->
                                <input id="MacEdit" name="MacEdit" type="text" maxlength="17" class="form-control" readonly/> 
                            </div>
                        </div>  

                    </div>
                    <!-- end modl-body -->

                    <div class="modal-footer">
                         <!-- <input id="btnSubmitMac" type="button" value="Add Mac" class="btn btn-primary submit">  -->

                        <div class="pull-left">
                            <button id='btnDeleteMac' type="button" class='btn btn-danger'><span class='glyphicon glyphicon-remove' ></span> Delete Mac  </button>
                        </div>

                        <button id='btnSubmitMac' type="button" class='btn btn-success submit'><span class='glyphicon glyphicon-ok' ></span> Update Mac  </button>
                        <button id='btnCancelMac' type="button" class='btn btn-default' data-dismiss="modal" aria-label="Close"><span class='glyphicon glyphicon-remove' ></span> Cancel  </button> 
                        

                        <!-- <span class='glyphicon glyphicon-list-alt' ></span><input id="btnDeleteMac" type="button" value=" Delete Mac" class="btn btn-primary submit"> -->
                        <!-- <button id="btnOtherDevice" type="button" class="btn btn-primary submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button> -->
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function openLink() {
            window.open("http://www.attg.co.th/CR/index.php", "_blank");
        }
    </script>

    <script type="text/javascript" charset="TIS-620" src="js/search-mac.js"></script>
    <script src="js/update-mac_modal.js"></script>
</body>
</html>
