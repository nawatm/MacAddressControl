$("#ExpirePeriod").change(function() {
    if ($("#ExpirePeriod").val() == "0") {
        $("#ExpireDate").removeAttr("disabled");
    } else {
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




$("#Mac").keypress(function(event) {
    //var tmpMac = this.value.trim().toUpperCase().replace(/([~!#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '').replace(/^(-)+|(-)+$/g, '');
    var tmpMac = this.value.trim().toUpperCase();
    if (
        (tmpMac.length == 2) || (tmpMac.length == 5) || (tmpMac.length == 8) || (tmpMac.length == 11) || (tmpMac.length == 14)
    ) {
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
        ExpireDate: {
            required: "<span style='color: red;'>กรุณากำหนดวันหมดอายุ</span>"
        },
        Mac: {
            required: "<span style='color: red;'>กรุณากรอก MAC Address</span>",
            regex: "<span style='color: red;'>รูปแบบของ MAC Address ไม่ถูกต้อง</span>"
        }
    }
});

//------ Add MAC Address -----------------------
$("#btnAddMac").click(function() {
    if ($("#formAddMac").valid()) {
        //var data = $('#formAddMac').serializeArray();
        $.ajax({
            url: 'addMacCtrl.php',
            type: 'POST',
            dataType: 'html',
            data: $('#formAddMac').serialize(),
            success: function(data) {
                //alert(data);
                //$("#response").html(data);
                if (data == "COMPLETE") {
                    //$("#response").html(data);

                    $("#formAddMac")[0].reset();
                    swal("Insert Complete", "MAC Address ได้เพิ่มลงในฐานข้อมูลเรียบร้อยแล้ว", "success");
                } else if (data == "EXIST") {
                    swal("Insert Error", "MAC Address ดังกล่าวมีอยู่ในระบบแล้ว", "error");
                } else {
                    swal("Insert Error", "เกิดปัญหาในการเชื่อมต่อฐานข้อมูล", "error");
                }
            }
        });
    }


});
