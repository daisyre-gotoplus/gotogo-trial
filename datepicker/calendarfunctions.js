$(document).ready(function () {
    
    'use strict';

var datetxtDateEndday = new Date();
$(function () {
    var dates = $("#txtDateEnd").datepicker({
            hideIfNoPrevNext: true,
            dayNames: ['', '', '', '', '', '', ''],
            prevText: '',
            nextText: '',
            minDate: datetxtDateEndday,
            showOn: 'buttxtDateEndn',
            buttxtDateEndnText: '',
            buttxtDateEndnImageOnly: true,
            constrainInput: true,
            duration: 'fast',
            buttxtDateEndnImage: '/wp-content/themes/mytheme/images/bg_calendar.jpg',
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 1,
            beforeShow: function () {
                var other = this.id == "txtDateStart" ? "#txtDateEnd" : "#txtDateStart";
                var option = this.id == "txtDateStart" ? "maxDate" : "minDate";
                var selectedDate = $(other).datepicker('getDate');
                $(this).datepicker("option", option, selectedDate);
            }
        }).change(function () {
            var other = this.id == "txtDateStart" ? "#txtDateEnd" : "#txtDateStart";
            if ($('#txtDateStart').datepicker('getDate') > $('#txtDateEnd').datepicker('getDate'))
                $(other).datepicker('setDate', $(this).datepicker('getDate'));
            if (this.id == 'txtDateStart') {
                var dateMin = $('#txtDateStart').datepicker("getDate");
                var rMin = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + 1);
                var rMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + 1);
                $('#txtDateEnd').val($.datepicker.formatDate('yy-mm-dd', new Date(rMax)));
            }
        });
    var dates = $("#txtDateStart").datepicker({
            hideIfNoPrevNext: true,
            dayNames: ['', '', '', '', '', '', ''],
            prevText: '',
            nextText: '',
            minDate: datetxtDateEndday,
            showOn: 'buttxtDateEndn',
            buttxtDateEndnText: '',
            buttxtDateEndnImageOnly: true,
            constrainInput: true,
            duration: 'fast',
            buttxtDateEndnImage: '/wp-content/themes/mytheme/images/bg_calendar.jpg',
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 1,
        }).change(function () {
            var other = this.id == "txtDateStart" ? "#txtDateEnd" : "#txtDateStart";
            if ($('#txtDateStart').datepicker('getDate') > $('#txtDateEnd').datepicker('getDate'))
                $(other).datepicker('setDate', $(this).datepicker('getDate'));
            if (this.id == 'txtDateStart') {
                var dateMin = $('#txtDateStart').datepicker("getDate");
                var rMin = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + 1);
                var rMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + 1);
                $('#txtDateEnd').val($.datepicker.formatDate('yy-mm-dd', new Date(rMax)));
            }
        });
    $('.ui-datepicker-trigger').css({
            'cursor': 'pointer',
            'vertical-align': '2px',
            'margin-left': '2px'
        });
    $('#txtDateStart,#txtDateStartcalicon').click(function () {
        $('#txtDateStart').datepicker('show');
    });
    $('#txtDateEnd').click(function () {
        $('#txtDateEnd').datepicker('show');
    });
   	 
});
});
function setDpart2() {
    if (document.getElementById("txtDateStart").value != "") {
        var date1 = document.getElementById("txtDateStart").value;
        var date2 = document.getElementById("txtDateEnd").value;
        date1 = date1.split("-");
        date2 = date2.split("-");
        var sDate = new Date(date1[0] + "/" + date1[1] + "/" + date1[2]);
        var eDate = new Date(date2[0] + "/" + date2[1] + "/" + date2[2]);
        var daysApart = Math.abs(Math.round((sDate - eDate) / 86400000));
        if (daysApart == 0) {
            daysApart = 1;
        } 
        document.getElementById("txtNights").value = daysApart + " Night(s)";
    } else {
        alert("Select date of arrival first.");
        document.getElementById("txtDateEnd").value = "";
    }
}

function adjustDep() {
    var date1 = document.getElementById("txtDateStart").value;
    var date2 = document.getElementById("txtDateEnd").value;
    if (date2 == "") {
        date2 = "0000-00-00";
    }
    date1 = date1.split("-");
    date2 = date2.split("-");
    var sDate = date1[0] + date1[1] + date1[2];
    var eDate = date2[0] + date2[1] + date2[2];
    var dateVal1 = parseInt(sDate);
    var dateVal2 = parseInt(eDate);
    if (dateVal1 >= dateVal2) {
        var currentDate = new Date(date1[0] + "/" + date1[1] + "/" + date1[2]);
        var valueofcurrentDate = currentDate.valueOf() + (24 * 60 * 60 * 1000);
        var newDate = new Date(valueofcurrentDate);
        var wer = newDate.txtDateEndLocaleDateString();
        var nxtDate = new Date(wer);
        var day = nxtDate.getDate();
        var month = nxtDate.getMonth() + 1;
        var year = nxtDate.getFullYear();
        month = (month < 10) ? "0" + month : month;
        day = (day < 10) ? "0" + day : day;
        document.getElementById("txtDateEnd").value = year + "-" + month + "-" + day;
    }
}

function setDpart() {
    if (document.getElementById("txtNights").value <= 0) {
        document.getElementById("txtNights").value = 1;
    }
    if (document.getElementById("txtNights").value > 31) {
        document.getElementById("txtNights").value = 31;
    }
    if (document.getElementById("txtDateStart").value == "") {
        document.getElementById("txtNights").value = "";
    } else {
        var datestart = document.getElementById("txtDateStart").value;
        var nights = document.getElementById("txtNights").value;
        var dateStartBits = datestart.split('-');
        var dateStart1 = dateStartBits[2];
        var dateStart2 = dateStartBits[1];
        var dateStart3 = dateStartBits[0];
        var a = parseInt((dateStart1 - 0) + (nights - 0));
        var b = dateStart2;
        var c = parseInt(dateStart3);
        if (dateStart2 == "01") {
            if (a > 31) {
                a = a - 31;
                b = "02";
            }
        } else if (dateStart2 == "02") {
            if (a > 28) {
                a = a - 28;
                b = "03";
            }
        } else if (dateStart2 == "03") {
            if (a > 31) {
                a = a - 31;
                b = "04";
            }
        } else if (dateStart2 == "04") {
            if (a > 30) {
                a = a - 30;
                b = "05";
            }
        } else if (dateStart2 == "05") {
            if (a > 31) {
                a = a - 31;
                b = "06";
            }
        } else if (dateStart2 == "06") {
            if (a > 30) {
                a = a - 30;
                b = "07";
            }
        } else if (dateStart2 == "07") {
            if (a > 31) {
                a = a - 31;
                b = "08";
            }
        } else if (dateStart2 == "08") {
            if (a > 31) {
                a = a - 31;
                b = "09";
            }
        } else if (dateStart2 == "09") {
            if (a > 30) {
                a = a - 30;
                b = 10;
            }
        } else if (dateStart2 == "10") {
            if (a > 31) {
                a = a - 31;
                b = 11;
            }
        } else if (dateStart2 == "11") {
            if (a > 30) {
                a = a - 30;
                b = 12;
            }
        } else if (dateStart2 == "12") {
            if (a > 31) {
                a = a - 31;
                b = "01";
                c = c + 1;
            }
        }
        a = (a < 10) ? "0" + a : a;
        document.getElementById("txtDateEnd").value = c + "-" + b + "-" + a;
    }
}

function IsNumeric(sText, vName) {
    var ValidChars = "0123456789.";
    var Char;
    for (i = 0; i < sText.length; i++) {
        Char = sText.charAt(i);
        if (ValidChars.indexOf(Char) == -1) {
            document.getElementById(vName).value = 0;
            setDpart();
            i = sText.length;
        }
    }
    IsNumeric2(sText, vName)
}

function IsNumeric2(sText, vName) {
    if (document.getElementById(vName).value > 31) {
        document.getElementById(vName).value = 31
    }
}


