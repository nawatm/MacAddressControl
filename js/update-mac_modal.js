//  --------- Date Picker Config ---------------
$("#ExpirePeriod").change(function() {
    if ($("#ExpirePeriod").val() == "0") {
        $("#ExpiredDate").removeAttr("disabled");
    } else {
        $("#ExpiredDate").attr("disabled", "disabled");
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
//  -------- Date Picker Config ---------------


$("#MacEdit").keypress(function(event) {
    var tmpMac = this.value.trim().toUpperCase();
    if ((tmpMac.length == 2) || (tmpMac.length == 5) || (tmpMac.length == 8) || (tmpMac.length == 11) || (tmpMac.length == 14)) {
        tmpMac = tmpMac + ":";
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
    ) {
        return false;
    }
    return true;
}

$.validator.addMethod("regex", function(value, element, regexp) {
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
        ExpiredDate: {
            //	required: true,
            required: {
                depends: function(element) {
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
        ExpiredDate: {
            required: "<span style='color: red;'>กรุณากำหนดวันหมดอายุ</span>"
        },
        Mac: {
            required: "<span style='color: red;'>กรุณากรอก MAC Address</span>",
            regex: "<span style='color: red;'>รูปแบบของ MAC Address ไม่ถูกต้อง</span>"
        }
    }
});

//---   Show edit MAC Address on Modal
$("body").on("click", ".editModal", function() {
    //$("#btnEdit").click(function(){
    var vMac = $(this).parent("td").prev("td").prev("td").prev("td").text();

    $.ajax({
        url: "searchMacCtrl.php?status=edit",
        type: 'POST',
        dataType: 'html',
        //data: $('#formSearchMobile').serialize(),
        data: {
            MAC: vMac
        },
        success: function(result) {
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
            $("#editModal").find("input[id='ExpiredDate']").removeAttr('disabled').val(dataObj[0].ExpiredDate.trim());

            //$("#editModal").find("select[id='Company']").val('ATA').change();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('error: ' + textStatus + ': ' + errorThrown);
        }

    });
});


//---   Update MAC Address on Modal
$("#btnSubmitMac").click(function() {
    if ($("#formModalEdit").valid()) {
        $.ajax({
            url: 'api/updateMac.php',
            type: 'POST',
            data: $('#formModalEdit').serialize(),
            dataType: "text",
            success: function(result) {
                if (result == "TRUE") {
                    //$("#response").html(data);
                    swal("Update Complete", "แก้ไขข้อมูลในฐานข้อมูลเรียบร้อยแล้ว", "success");
                    $("#editModal").modal('hide');
                } else {
                    swal("Update Error", "เกิดข้อผิดพลาด ไม่สามารถแก้ไขข้อมูลในฐานข้อมูลได้", "error");
                }

            }
        });
    }
});

//---   Delete MAC Address on Modal
$("#btnDeleteMac").click(function() {
    swal({
        title: "Delete Confirm",
        text: "คุณต้องการลบ MAC Address ที่เลือกหรือไม่?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "ตกลง",
        cancelButtonText: "ยกเลิก",
        confirmButtonClass: "btn-danger"
    }).then(function() {
        $.ajax({
            url: "api/deleteMac.php",
            type: 'POST',
            dataType: 'html',
            data: $('#formModalEdit').serialize(),
            success: function(result) {
                if (result == "TRUE") {
                    swal("Update Complete", "ลบข้อมูล MAC Address ในฐานข้อมูลเรียบร้อยแล้ว", "success");
                    $("#editModal").modal('hide');
                    SearcMobileMac();
                } else {
                    swal("Update Error", "เกิดข้อผิดพลาด ไม่สามารถแก้ไขข้อมูลในฐานข้อมูลได้", "error");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('error: ' + textStatus + ': ' + errorThrown);
            }
        });

    });
});