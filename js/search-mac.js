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


function openLink() {
    window.open("http://www.attg.co.th/CR/index.php", "_blank");
}


var validMac = function(event) {
    var tmpMac = this.value.trim().toUpperCase();

    if (
        (tmpMac.length == 2) || (tmpMac.length == 5) || (tmpMac.length == 8) || (tmpMac.length == 11) || (tmpMac.length == 14)
    ) {
        tmpMac = tmpMac + ":";
    }
    this.value = tmpMac;
    //document.getElementById('Mac').value = tmpMac;

    return isNumber(event, this.value.toUpperCase());
}


$("#Mac2").keypress(validMac);
$("#ComputerMac").keypress(validMac);


$("#formSearchMobile").validate({
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

$("#formSearchComputer").validate({
    rules: {
        ComputerCompany: {
            required: true
        }
    },
    messages: {
        ComputerCompany: {
            required: "<span style='color: red;'>กรุณาเลือกบริษัท</span>"
        }
    }
});

/*
$("#editComputerMac").click(function() {
    window.open("http://www.attg.co.th/CR/AdminHome.php", "_blank");

});
*/

//-------------- Search Mobile MAC Address list
function SearchMobileMac() {
    if ($("#formSearchMobile").valid()) {
        $.ajax({
            url: 'searchMacCtrl.php?type=mobile',
            type: 'POST',
            dataType: 'html',
            data: $('#formSearchMobile').serialize(),
            success: function(result) {

                $("#searchTable tbody").remove();

                //--- Return by HTML Type ---/
                $("#searchTable").append(result);

                var table = $("#searchTable").DataTable({
                    "sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
                    "bLengthChange": true, // แสดงจำนวน record ที่จะแสดงในตาราง
                    "iDisplayLength": 20, // กำหนดค่า default ของจำนวน record 
                    "bFilter": true, // แสดง search box
                    "sScrollY": "800px", // กำหนดความสูงของ ตาราง  
                    "bDestroy": true,
                    "oTableTools": {
                        "sRowSelect": "single" // คลิกที่ record มีแถบสีขึ้น

                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('error: ' + textStatus + ': ' + errorThrown);
            }

        });
    }
}

//-------------- Search Computer MAC Address list
function SearchComputerMac() {
    if ($("#formSearchComputer").valid()) {
        $.ajax({
            url: 'searchMacCtrl.php?type=computer',
            type: 'POST',
            dataType: 'html',
            data: $('#formSearchComputer').serialize(),
            success: function(result) {
                $("#searchComputerTable tbody").remove();

                //--- Return by HTML Type ---/
                $("#searchComputerTable").append(result);

                var table2 = $("#searchComputerTable").DataTable({
                    "sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
                    "bLengthChange": true, // แสดงจำนวน record ที่จะแสดงในตาราง
                    "iDisplayLength": 20, // กำหนดค่า default ของจำนวน record 
                    "bFilter": true, // แสดง search box
                    "sScrollY": "800px", // กำหนดความสูงของ ตาราง  
                    "bDestroy": true,
                    "oTableTools": {
                        "sRowSelect": "single" // คลิกที่ record มีแถบสีขึ้น

                    }
                });

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('error: ' + textStatus + ': ' + errorThrown);
            }

        });
    }
}

//--- Tab1: Search Button Click ------
$("#btnSearchMobile").click(function() {
    SearchMobileMac();
});

//--- Tab2: Search Button Click ------
$("#btnSearchComputer").click(function() {
    SearchComputerMac();
});


//---- Tab1: Mobile Mac Address Click -----
$("#tabMenu a[href='#tab-1']").click(function() {
    $("#searchMobilePanel").show();
    $("#searchComputerPanel").hide();
});

//---- Tab2: PC Mac Address Click ---------
$("#tabMenu a[href='#tab-2']").click(function() {
    $("#searchMobilePanel").hide();
    $("#searchComputerPanel").show();
});