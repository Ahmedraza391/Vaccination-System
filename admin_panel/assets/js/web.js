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
// for notification read jquery code
$(document).ready(function() {
    $(document).on("click", "#notification_dropdown", function() {
        var p_id = $("#notification_dropdown").val();
        // alert(p_id);
        $.ajax({
            url: "read_notification.php",
            type: "POST",
            data: {
                id: p_id
            },
            success: function(data) {
                $("#notification_menu").html(data.notification);
                $("#noti_badge").html("0");
            }
        })
    })
})
// for calling print ()
var btn = document.querySelector("#report_btn")
btn.addEventListener("click",function(){
    print();
})