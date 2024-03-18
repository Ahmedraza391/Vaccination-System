// for navbar scrolled
document.addEventListener('scroll', () => {
    const header = document.getElementById('header');
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});
// for sidebar open
var btns = document.querySelectorAll(".sidebar_btn");
var sidebar = document.querySelector("#sidebar");
var main_container = document.querySelector("#main");
var check = 0;
btns.forEach(function(btn) {
    btn.addEventListener("click", function() {
        if (check == 0) {
            sidebar.style.left = "0";
            check = 1;
        } else {
            sidebar.style.left = "-300px";
            check = 0;
        }
    });
});
// for calling print ()
var btn = document.querySelector("#report_btn")
btn.addEventListener("click",function(){
    print();
})
// for previous date disabled
document.addEventListener("DOMContentLoaded", function() {
    // for previous date disabled
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1; // Month is zero-based
    var year = date.getFullYear();

    // Prefix single digit days and months with a '0'
    if (day < 10) {
        day = '0' + day;
    }
    if (month < 10) {
        month = '0' + month;
    }

    var pattern = year + '-' + month + '-' + day;
    var datePicker = document.getElementById("datePicker");
    datePicker.setAttribute('min', pattern);
});