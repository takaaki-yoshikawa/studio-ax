jQuery(function () {
    var e = 0;
    var d = parseInt(jQuery("#slide div").length - 1);
    jQuery("#slide div").css("display", "none");
    jQuery("#slide div").eq(e).css("display", "block");
    function a() {
        jQuery("#slide div").fadeOut(1000);
        jQuery("#slide div").eq(e).fadeIn(1000)
    }
    var c;
    function b() {
        c = setInterval(function () {
            if (e === d) {
                e = 0;
                a()
            } else {
                e++;
                a()
            }
        }, 7000)//切り替わる秒数
    }
    function f() {
        clearInterval(c)
    }
    b()
});
jQuery(function () {
    var e = 0;
    var d = parseInt($("#slide-mobile img").length - 1);
    jQuery("#slide-mobile img").css("display", "none");
    jQuery("#slide-mobile img").eq(e).css("display", "block");
    function a() {
        jQuery("#slide-mobile img").fadeOut(1000);
        jQuery("#slide-mobile img").eq(e).fadeIn(1000)
    }
    var c;
    function b() {
        c = setInterval(function () {
            if (e === d) {
                e = 0;
                a()
            } else {
                e++;
                a()
            }
        }, 7000)
    }
    function f() {
        clearInterval(c)
    }
    b()
});