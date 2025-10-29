jQuery(document).ready(function(){

  jQuery('.c_testimonials__track').slick({
    //autoplay: true,
    arrows: true,
    centerMode: true,
    slidesToShow: 1,
    variableWidth: true,
    mobileFirst: true,
    responsive: [
    	{
    		breakpoint: 1024,
    		settings:  {
	    		autoplay: true,
	    		slidesToShow: 2,
	    		arrows: false,
	    	}
    	}
    ]

  });


  jQuery('.c_testimonials__pause-btn').click(function(e) {

  		let button = e.currentTarget;
  		let paused = jQuery('.c_testimonials__track').slick('getSlick').paused;

  		if(paused) {
			jQuery('.c_testimonials__track').slick('slickPlay');
			
			jQuery('.fa-pause', button).removeClass('hidden');
			jQuery('.fa-play', button).addClass('hidden');
  		}

  		else {
  			jQuery('.c_testimonials__track').slick('slickPause');
  			
  			jQuery('.fa-play', button).removeClass('hidden');
  			jQuery('.fa-pause', button).addClass('hidden');
  		}

  });

});
