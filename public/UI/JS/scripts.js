/*!
 * Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2022 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener("click", (event) => {
            event.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
            localStorage.setItem(
                "sb|sidebar-toggle",
                document.body.classList.contains("sb-sidenav-toggled")
            );
        });
    }
});

//==============================['FUNCTION JAM DI PRODUCTION WEB']==============================//
function showTime() {
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "WIB";

    h = h < 10 ? "0" + h : h;
    m = m < 10 ? "0" + m : m;
    s = s < 10 ? "0" + s : s;

    var time = h + " : " + m + " : " + s + "\xa0" + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    setTimeout(showTime, 1000);
}
showTime();

//==============================['SeePassword']==============================//
function SeePassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    var x = document.getElementById("password1");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

//==============================['Disabled Buttom Submit']==============================//
function DisabledButtomSubmit() {
    document.getElementById("submit").disabled = true;
}

//==============================['Convert SAP INGOT']==============================//

function ConvertSAPINGOT(data) {
    switch (data) {
        case "UBPURE-AC2B000006":
            data = "AC2B";
            break;
        case "UBPURE-AC2B000007":
            data = "AC2BF";
            break;
        case "UBPURE-AC4B000014":
            data = "AC4B";
            break;
        case "UBPURE-AC4CH00015":
            data = "AC4CH";
            break;
        case "UBPURE-ADC1200001":
            data = "ADC 12";
            break;
        case "UBPURE-ADC1200NKI":
            data = "ADC 12 NK";
            break;
        case "UBPURE-HD20000003":
            data = "HD-2";
            break;
        case "UBPURE-HD40000004":
            data = "HD-4";
            break;
        case "UBPURE-YH3R000003":
            data = "YH3R";
            break;
        case "UBPURE-YMTL0BMHD2":
            data = "BM HD-2";
            break;
        // more cases can be added here
        default:
            data = "MATERIAL BELUM TERDAFTAR";
    }
    return data;
}

//==============================['Convert DD.MM.YYYY to YYYY-MM-DD']==============================//

function convertToYMD(tanggalan) {
    // tanggal dalam format dd.MM.YYYY
    var dateString = tanggalan;

    // memisahkan tanggal menjadi day, month, dan year
    var dateParts = dateString.split(".");

    // membuat variabel baru dengan format YYYY-MM-DD
    var newDate = new Date(
        dateParts[2],
        parseInt(dateParts[1]) - 1,
        dateParts[0]
    );
    var year = newDate.getFullYear();
    var month = newDate.getMonth() + 1;
    var day = newDate.getDate();

    // menggabungkan variabel baru menjadi format YYYY-MM-DD
    var ymdDate =
        year +
        "-" +
        (month < 10 ? "0" : "") +
        month +
        "-" +
        (day < 10 ? "0" : "") +
        day;

    return ymdDate;
}
