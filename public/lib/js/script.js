
$(document).ready(function(){

    $("#section1 .headerBot i").click(function(e) {
        e.preventDefault();
        $("html, body").animate({
            scrollTop: $("#section3").offset().top
        }, 2000)
    });
    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }
});