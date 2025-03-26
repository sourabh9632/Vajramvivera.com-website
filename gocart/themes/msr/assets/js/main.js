// common scripts //
var window_width = 0;
var window_height = 0;
var banner_width = 2880;
var banner_height = 1622;
var menuEasing = [500, 20];
var menuInSpeed = 1200;
var menuOutSpeed = 800;
var menuLayDelay = 100;
var mainMenuEasing = 'ease-out';
var mainMenuInSpeed = 1000;
var mainMenuOutSpeed = 200;
var mainMenuHeight = 200;

var init = function () {
    trace('DOM init');

    // re-arrange content //
    reArrangeContent();
    // for the first time only //

}

var reArrangeContent = function () {
        // window inner width & height //
        window_width = $(window).innerWidth();
        window_height = $(window).innerHeight();

        // calc the banner height //
        banner_height = Number((window_width * banner_height) / banner_width);
        banner_width = window_width;


        // for ref use only //
        $('#dispcon').html(window_width + 'x' + window_height);

        // height adjust for video //
        //    $('.videoitm iframe').height($('.videoitm').height());

        // height for the map //
        $('#map-canvas').height($('.mapholder').height());

    }
// trace script //
var trace = function (parm) {
    if (window.console) {
        console.log(parm);
    }
}

// *************************************** app ready *************************************** //
$(function () {

    // resize event handler //
    $(window).resize(function () {
        reArrangeContent();
    });
   
    // window load call to wait for images to load //
    $(window).load(function () {
        // window content loaded //
        trace('page loaded');
//        hoverNav($('#head-nav li.active'));
        $('#preldr').fadeOut(500);
        
        setInterval(function() {
            setTimeout(function(){
                $(".slider2next").trigger('click');
            }, 1000)
            setTimeout(function(){
                $(".slider3next").trigger('click');
            }, 2000)
            $(".slider1next").trigger('click');
        }, 4000);
        
        setTimeout(function(){
            $('.main').addClass('anmstrt');
            }, 300);
        
        setTimeout(function(){
            $('.signs').addClass('pley');
            }, 100);

// scroll to map //
       if (window.location.hash) {
           $('html, body').animate({
               scrollTop: Number($(window.location.hash).offset().top - 90)
           }, 1000);
       }
        $(window).trigger('scroll');
    });
    
    $('.mainmenu > a').on('click', function (e) {
               e.preventDefault();
               $(this).toggleClass('active');
                 $('.opts',$(this).parent()).slideToggle();
             });
    
     $('.moblnk').on('click', function (e) {
        e.preventDefault();
         $(this).toggleClass("lnkss");
       $('.sldmnu').toggleClass("rnews");
         $('.header').toggleClass('hdesd');
         $(".content").toggleClass("ftod");
    });
    $('.submny > a').on('click', function (e) {
               e.preventDefault();
               $(this).parent().toggleClass('active');
                 $('.subhed',$(this).parent()).slideToggle();
             });
    $('.submnys > a').on('click', function (e) {
               e.preventDefault();
               $(this).parent().toggleClass('active');
                 $('.subhed',$(this).parent()).slideToggle();
             });
//    $('.ovlay').on('click', function (e) {
//        e.preventDefault();
//         $(".moblnk").removeClass("lnkss");
//       $('.sldmnu').removeClass("rnews");
//         $('.header').removeClass('hdesd');
//          $(".ovlay").fadeOut()
//    });
     //popup form
    $(".popss, .broch, .flrplns").on("click", function(e) {
                 e.preventDefault();
                $('#downflorpl').text($(this).text());
                $('#typeid').val($(this).attr('rel'));
                 $(".downpop").fadeIn();
             })
     $(".clo > a").on("click", function(e) {
                 e.preventDefault();
                 $(".downpop").fadeOut();
             })
             
    $(".txtbox").focus(function(){
       $(this).siblings().addClass("foare");
       $(this).parent().siblings().removeClass("foare");

  })
   
      $(".shd1, .shd2, .shd3, .shd4").each(function (index) {
    var characters = $(this).text().split("");
    
    $this = $(this);
    $this.empty();
    $.each(characters, function (i, el) {
    $this.append("<span>" + el + "</span");
    });
});
      
    // init app on page load //
    init();

   $(window).scroll(function (e) {
        // sticky header //
       e.preventDefault();

        if ($(this).scrollTop() > 170) {
            $('.header').addClass('shead');
            $('#content').addClass('thead');
           
        } else {
            $('.header').removeClass('shead');
            $(".moblnk").removeClass("lnkss");
            $('.sldmnu').removeClass("rnews");
             $('.header').removeClass('hdesd');
             $('#content').removeClass('thead');
              $(".ovlay").fadeOut()
        }
    });
    $(".ongpmed > li > a").on('click', function(e) {
                e.preventDefault();
                $('.sldmnu').removeClass('rnews'); 
                $('.moblnk').removeClass('lnkss');
                $('.header').removeClass('hdesd');
            });
    $(window).trigger('scroll');
   
     // scroll to map //
    $('.conloc').click(function (e) {
        e.preventDefault();
        var stOff = Number($($(this).attr('href')).offset().top) - ($('.header').height()  - 100);
        //        $('.mmolay').trigger('click');
        $('html, body').animate({
            scrollTop: stOff
        }, 2000);

    });
    //scroll to top //
	    $(".totop a").click(function () {
		$('html, body').animate({
		    scrollTop: 0
		}, 2000);
	    });
});

(function( $ ) {

    $.fn.scrollReveal = function() {

        //get viewport size
        var windowHeight = $(window).height(),
            windowWidth = $(window).width(),
            initialScroll = $(window).scrollTop(),
            items = $('.scrlanim'),
            scroll;

        //hide anything not in the viewport
        items.each(function(){
            if($(this).offset().top >= windowHeight){
                $(this).addClass('animtn-started');
            }
        });

        //on scroll
        $(window).scroll(function (event) {
            //get the current scroll position
            scroll = $(window).scrollTop();
            //show anything that is now in view (scroll + windowHeight)
            items.each( function(){
                if($(this).offset().top <= (scroll + windowHeight)){
                    $(this).removeClass('animtn-started');
                }
            });
        });

        return this;
    };
}( jQuery ));

var $animation_elements = $('.htg');
var $animation_elementss = $('.htgg');
var $window = $(window);

function check_if_in_view() {
  var window_height = $window.height();
  var window_top_position = $window.scrollTop();
  var window_bottom_position = (window_top_position + window_height);
 
  $.each($animation_elements, function() {
    var $element = $(this);
    var element_height = $element.outerHeight();
    var element_top_position = $element.offset().top;
    var element_bottom_position = (element_top_position + element_height);
 
    //check to see if this current container is within viewport
    if ((element_bottom_position >= window_top_position) &&
        (element_top_position <= window_bottom_position)) {
      $element.removeClass('in-view');
    } else {
      $element.addClass('in-view');
    }
  });
    
    $.each($animation_elementss, function() {
    var $elements = $(this);
    var element_heights = $elements.outerHeight();
    var element_top_positions = $elements.offset().top;
    var element_bottom_positions = (element_top_positions + element_heights);
 
    //check to see if this current container is within viewport
    if ((element_bottom_positions >= window_top_position) &&
        (element_top_positions <= window_bottom_position)) {
         setTimeout(function(){
      $elements.removeClass('in-views');
             }, 1000);
    } else {
      setTimeout(function(){    
      $elements.addClass('in-views');
          }, 1000);
    }
  });
    
}
$window.on('scroll resize', check_if_in_view);
$window.trigger('scroll');
