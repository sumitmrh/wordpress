jQuery(function() {
    // WOW
    new WOW().init();

    //odometer
    var odo = jQuery(".odometer");
    odo.each(function() {
        jQuery(this).appear(function() {
            var countNumber = jQuery(this).attr("data-count");
            jQuery(this).html(countNumber);
        });
    });
});


/* ---------------------------------------------- /*
	* Scroll top
	/* ---------------------------------------------- */

jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 100) {
        jQuery('.page-scroll-up').fadeIn();
    } else {
        jQuery('.page-scroll-up').fadeOut();
    }
});

jQuery('.page-scroll-up').click(function() {
    jQuery("html, body").animate({
        scrollTop: 0
    }, 700);
    return false;
});

/* ---------------------------------------------- /*
	* Scroll to section
	/* ---------------------------------------------- */

jQuery(document).ready(function() {
    //change the integers below to match the height of your upper div, which I called
    //banner.  Just add a 1 to the last number.  console.log($(window).scrollTop())
    //to figure out what the scroll position is when exactly you want to fix the nav
    //bar or div or whatever.  I stuck in the console.log for you.  Just remove when
    //you know the position.
    jQuery(window).scroll(function () { 
  
      //console.log(jQuery(window).scrollTop());
  
      if (jQuery(window).scrollTop() > 161) {
        jQuery('#webenvo-header-inner').addClass('webenvo-sticky-top');
      }
  
      if (jQuery(window).scrollTop() < 161) {
        jQuery('#webenvo-header-inner').removeClass('webenvo-sticky-top');
      }
    });
  });

/* ---------------------------------------------- /*
	* Loader Animation
	/* ---------------------------------------------- */

    jQuery(window).load(function() {
        jQuery('#webenvo-loading').hide();
      });