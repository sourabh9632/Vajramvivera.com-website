const slider = $(".prjdetsl");
const slider2 = $(".prjslider");

const slider11 = $(".prjdetsl1");
const slider12 = $(".prjslider1");

const slider21 = $(".prjdetsl2");
const slider22 = $(".prjslider2");




const slider3 = $(".blogslider");
// Animation
$('.slider').on('init', function(e, slick) {
  var $firstAnimatingElements = $('div.slick-slide:first-child').find('[data-animation]');
  doAnimations($firstAnimatingElements);    
});
$('.slider').on('beforeChange', function(e, slick, currentSlide, nextSlide) {
  var $animatingElements = $('div.slick-slide[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
  doAnimations($animatingElements); 
});

// Slider Main Settings
slider
  .slick({
    dots: false,
    arrows: true,
    vertical: true,
    infinite: false,
    adaptiveHeight: true
  });

  slider2
  .slick({
    dots: false,
    arrows: true,
    fade: true,
      infinite: false,
    adaptiveHeight: true
  });

  slider11
  .slick({
    dots: false,
    arrows: true,
    vertical: true,
      infinite: false,
    adaptiveHeight: true
  });

  slider12
  .slick({
    dots: false,
    arrows: true,
    fade: true,
      infinite: false,
    adaptiveHeight: true
  });

  slider21
  .slick({
    dots: false,
    arrows: true,
    vertical: true,
      infinite: false,
    adaptiveHeight: true
  });

  slider22
  .slick({
    dots: false,
    arrows: true,
    fade: true,
      infinite: false,
    adaptiveHeight: true
  });


// Vertical Mouse Scroll
slider.on('wheel', (function(e) {
  e.preventDefault();

  if (e.originalEvent.deltaY < 0) {//alert('hi');
     // $('.prjdetsl button.slick-next').trigger('click');
     // $('.prjslider button.slick-next').trigger('click');
    $(this).slick('slickNext');
    $(slider2).slick('slickNext');
  } else {
    $(this).slick('slickPrev');
    $(slider2).slick('slickPrev');
     // $('.prjdetsl button.slick-prev').trigger('click');
    //  $('.prjslider button.slick-prev').trigger('click');
  }
}));

slider11.on('wheel', (function(e) {
  e.preventDefault();

  if (e.originalEvent.deltaY < 0) {
    $(this).slick('slickNext');
    $(slider12).slick('slickNext');
  } else {
    $(this).slick('slickPrev');
    $(slider12).slick('slickPrev');
  }
}));

slider21.on('wheel', (function(e) {
  e.preventDefault();

  if (e.originalEvent.deltaY < 0) {
    $(this).slick('slickNext');
    $(slider22).slick('slickNext');
  } else {
    $(this).slick('slickPrev');
    $(slider22).slick('slickPrev');
  }
}));

slider3.slick({
  dots: false,
  infinite: true,
  slidesToShow: 4,
  speed: 2000,
  slidesToScroll: 4,
     arrows: true
  });

// slider3.on('wheel', (function(e) {
//   e.preventDefault();
//   if (e.originalEvent.deltaY < 0) {
//     $(this).slick('slickNext');
//   } else {
//     $(this).slick('slickPrev');
//   }
// }));

/*slider3.on('wheel', (function(e) {
  e.preventDefault();

  if (e.originalEvent.deltaX < 0) {
    $(this).slick('slickNext');
  } else {
    $(this).slick('slickPrev');
  }

}));*/
/*const scrollContainer = document.querySelector(".blogspt");
scrollContainer.addEventListener('wheel',(e)=> {
    e.preventDefault();
 var left =  scrollContainer.scrollLeft += e.deltaX;
    var top =  scrollContainer.scrollTop += e.deltaY;//alert(top);
    var hght = ($('#section0').height() + $('#section1').height() + $('#section2').height()+ $('#section3').height()+ $('#section7').height()+ $('#section4').height());//alert(hght);
    var hght1 = ($('#section0').height() + $('#section1').height() + $('#section2').height()+ $('#section3').height());
    if (left > 0) {$('.blogslider').slick('slickNext');}
    else if(left < 0) {$('.blogslider').slick('slickPrev');}
    else if(top > 0){window.scrollTo({top: hght,
  behavior: 'smooth',});}
    //else if(top > 0){$('.blogspt').scrollTop(100);}
   // else if(top > 0){$('.slkslk').trigger('click');}
    else if(top < 0){window.scrollTo({top: hght1,
  behavior: 'smooth',});}
});
//rrsignature
const scrollContainer1 = document.querySelector(".blogspt1");
scrollContainer1.addEventListener('wheel',(e)=> {
    e.preventDefault();
 var left1 =  scrollContainer1.scrollLeft += e.deltaX;
    var top1 =  scrollContainer1.scrollTop += e.deltaY;//alert(top);
    var hght2 = ($('#pegasus7').height() + $('#maximized7').height()+ $('#urhome7').height()+ $('#floor-plan7').height()+ $('#location7').height()+ $('#eyeview7').height()+ $('#amenities7').height()+ $('#blogs').height());//alert(hght);
    var hght3 = ($('#pegasus7').height() + $('#maximized7').height()+ $('#urhome7').height()+ $('#floor-plan7').height()+ $('#location7').height()+ $('#eyeview7').height());
    if (left1 > 0) {$('.blogslider').slick('slickNext');}
    else if(left1 < 0) {$('.blogslider').slick('slickPrev');}
    else if(top1 > 0){window.scrollTo({top: hght2,
  behavior: 'smooth',});}
    //else if(top > 0){$('.blogspt').scrollTop(100);}
   // else if(top > 0){$('.slkslk').trigger('click');}
    else if(top1 < 0){window.scrollTo({top: hght3,
  behavior: 'smooth',});}
});*/

 /*$(function() {
     $('.slkslk').click(function(e) {
                e.preventDefault();
                var stOff = Number($($(this).attr('href')).offset().top) - (($('.head').height()) - 40);
                $('html, body').animate({
                    scrollTop: stOff
                }, 1000);

            });
   
       $('.slkslk1').click(function(e) {
                e.preventDefault();
         var stOff = Number($($(this).attr('href')).offset().top) - (($('.head').height()) - 40);
                $('html, body').animate({
                    scrollTop: stOff
                }, 1000);
     });
 });
 $(function() {
     $('.slkslk').click(function(e) {
                e.preventDefault();
                document.getElementById("content").style.transform="translateY(-250px)";
                document.getElementById("content").style.transition=" all 1s"; 

            });
   
       $('.slkslk1').click(function(e) {
                e.preventDefault();
        document.getElementById("content").style.transform="translateY(250px)";
        document.getElementById("content").style.transition=" all 1s"; 
     });
 });*/

// Animation
function doAnimations(elements) {
  var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
  elements.each(function() {
    var $this = $(this);
    var $animationDelay = $this.data('delay');
    var $animationType = 'animated ' + $this.data('animation');
    $this.css({
      'animation-delay': $animationDelay,
      '-webkit-animation-delay': $animationDelay
    });
    $this.addClass($animationType).one(animationEndEvents, function() {
      $this.removeClass($animationType);
    });
  });
};
