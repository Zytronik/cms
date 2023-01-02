$(function() {
    $( window ).scroll(function() {
        fixedheader();
    });

    $( window ).on("resize", function() {
        var header_offset = $("header").offset().top;
        fixedheader();
    });

    var header_offset = $("header").offset().top;

    fixedheader();

    function fixedheader() {
        var window_offset = $(window).scrollTop();
        if(window_offset > header_offset ){
            $("body").addClass("fixedheader");
        }else{
            $("body").removeClass("fixedheader");
        }
    }
    
	$('#nbw').on('click', function () {
        $("#navbtn").toggleClass('open');
        $('header').toggleClass('menu-active');
        if($("header").hasClass("menu-active")){
			$("body").addClass("open-menu");
        }else{
	        $("body").removeClass("open-menu");
        }
    });

    $("header a, footer a, .home-header a").on("click", function() {
        $("body").removeClass("open-menu");
        $("header").removeClass("menu-active");
        var elem = $(this);
        if($(elem.attr('href')).length){
            $([document.documentElement, document.body]).animate({
                scrollTop: $(elem.attr('href')).offset().top - $("header").outerHeight() + 1
            }, 600);
        }
    });

    var hash = window.location.hash;
    if(hash && $(hash).length > 0){
        $([document.documentElement, document.body]).animate({
            scrollTop: $(hash).offset().top - $("header").outerHeight()
        }, 600);
    }
});