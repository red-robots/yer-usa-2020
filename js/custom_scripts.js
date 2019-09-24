jQuery(document).ready(function($ ) {

	// set some variables
	var headerHeight;
	var overlay_nav = $('.et_pb_mhmm_menu_0 .menu-overlay, .et_pb_mhmm_menu.menu-style-full nav');
	var isHome = $('body').hasClass('home');

	/*
	*
	*	Mobile Menu
	*
	------------------------------------*/
	$('.burger, .overlay').click(function(){
		$('.burger').toggleClass('clicked');
		$('.overlay').toggleClass('show');
		$('nav').toggleClass('show');
		$('body').toggleClass('overflow');
	});
	
	$('nav.mobilemenu li').click(function() {
		$(this).find('ul.dropdown').toggleClass('active');
	});


	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.flexslider').flexslider({
		animation: "slide",
		'smoothHeight': true
	}); // end register flexslider

	

	// overide default anchor scrolling for any link with class of .anchor
	// we do this in order to account for the fixed header	
	$('body').on('click', '.anchor', function(event) {

		event.preventDefault();
		
		var hash = $(this).attr('id').substring(1);

		// Prevent default scroll to anchor by hiding the target element
	    var target = $('#'+hash);
	    $(target).css('display','none');

	    $(target).css('display','block');

        var distance = ( 'undefined' !== typeof( target.offset().top ) ) ? target.offset().top : 0,
			speed = ( distance > 4000 ) ? 1600 : 800;

	    // After a short delay, display the element and scroll to it
	    // setTimeout(function(){
	        
	        $('html, body').animate({

		        scrollTop: $(target).offset().top-138
		    
		    }, speed, 'swing', function(){
		    
		        //complete callback
			
			});

			setTimeout( function() {
				
				$('html, body').animate({
			
			        scrollTop: $(target).offset().top-138
			
			    }, 150, 'linear', function(){
			
			        //complete callback
				});
			
			}, speed + 25 );
	        
	    // }, 700);

	});

	// Store the window width
    var windowWidth = $(window).width();
	
	function getHeaderHeight() {

		var header_height = $('header').outerHeight();

		return header_height;
	}

	// get the height of the header
	$(window).bind("load", function() {

		if(isHome) {
	   		// subtract the height of the tab controls
	   		headerHeight = getHeaderHeight() - 35;
	   	
	   	} else {
	   	
	   		headerHeight = getHeaderHeight();
	   	
	   	}
	   
	   	// set the 'top' attribute to the height of the header
		$(overlay_nav).css('top',headerHeight);
	});
	

	// on resize recalculate the header
	$(window).resize(function() {

		if(isHome) {
	   		// subtract the height of the tab controls
	   		headerHeight = getHeaderHeight() - 35;
	   	
	   	} else {
	   		
	   		headerHeight = getHeaderHeight();
	   	
	   	}
		
		// set the 'top' attribute to the height of the header
  		$(overlay_nav).css('top',headerHeight);

  	});

  	$('body').on('click', '.tabs-nav-controls li', function(e) {

  		/*****************************************************
  		* Important! must hide the static layer and then fade it back in
  		* for Slider Revolution because the home page is importing two different
  		* pages both with sliders. 
  		******************************************************/
  		
  		// hide the static layer
  		$('.tp-static-layer').hide();
  		
  		// redraw both sliders
  		if ( typeof revapi1 !== 'undefined' )
			revapi1.revredraw();

  		if ( typeof revapi2 !== 'undefined' )
  			revapi2.revredraw();
  		
  		// fade back in the static layer
  		$('.tp-static-layer').fadeIn('slow');

  		/******************************************************/

  		e.preventDefault();
  		
  		// get the id of the tab to open
  		var attr = $(this).data('tab');
  		
  		handleHash(attr);

  		// resize the container when a tab is clicked
  		getMaxHeight('#' + attr + '-testimonials ul#testimonials-container');

  		// scroll user back to top of page
  		$("html, body").animate({ scrollTop: 0 }, 500);
  	
  	});

  	function handleHash(urlHash) {
  		
  		// clear the 'active' class from the tabs and controls
  		$('.tabs-nav-controls li, .home-page-content-containers div').removeClass('active');

  		// add the 'active' class to the appropriate tab control
  		$('li[data-tab='+urlHash+']').addClass('active');
  		
  		// add the 'active' class to the appropriate tab
  		$('#' + urlHash + '-container').addClass('active');

  		// clear the hash from the URL
  		window.location.hash = '';
  		
  		// clear the # from the URL
  		removeHash();
  		
  	}

  	// get the URL hash
  	var urlHash = window.location.hash.substring(1);

  	// if there is a has, open the appropriate tab on page load
  	if(urlHash) {
  		handleHash(urlHash);
  	}

  	// if the tab links are clicked from the main menu
  	$('body').on('click', '#menu-main-menu li a, #menu-main-menu-1 li a', function(e) {
  		// console.log('clicked');

  		/*****************************************************
  		* Important! must hide the static layer and then fade it back in
  		* for Slider Revolution because the home page is importing two different
  		* pages both with sliders. 
  		******************************************************/
  		
  		// hide the static layer
  		$('.tp-static-layer').hide();
  		
  		// redraw both sliders
  		if ( typeof revapi1 !== 'undefined' )
			revapi1.revredraw();

  		if ( typeof revapi2 !== 'undefined' )
  			revapi2.revredraw();
  		
  		// fade back in the static layer
  		$('.tp-static-layer').fadeIn('slow');

  		/******************************************************/
  		
  		if ( window.location.pathname == '/' ){
		    // Index (home) page
		    
		    var parent_has_class = $(this).parent().hasClass('tab-links');
		    // console.log('has class ', parent_has_class);
		    
		    if(parent_has_class) {
		    	e.preventDefault();
		    	var urlHash = $(this).attr("href").substring(2);
		    
		    	handleHash(urlHash);
		  		
		    }

		    // scroll user back to top of page
		    $("html, body").animate({ scrollTop: 0 }, 500);
		   
		} else {
		    // Other page
		    // console.log(window.location.pathname);
		}
  		
  	});

  	// clear the hash from the URL
  	function removeHash() { 
  		history.replaceState("", document.title, window.location.pathname + window.location.search);
	}

	// get the user's country
	var usersCountry = myData.country_of_origin;
	var hasCountry = '';
	var httc = '#hire-top-talent-testimonials';
	var lfjc = '#look-for-jobs-testimonials';

	// hire-top-talent-container testimonials slider
	$.each( $(httc + ' ul#country-icons-container li'), function( index, value ){
	 
	 	var icon_id = $(this).attr('id');
		var country = icon_id.split('--')[1];

		if(country == usersCountry) {
			hasCountry = country;
		}
		
	}).promise().done( function(){ 
		
		if(hasCountry.length > 0) {
			$(httc + ' ul#testimonials-container li#testimonial-'+hasCountry).addClass('active');
			$(httc + ' ul#country-icons-container li#country--'+hasCountry).addClass('active');
		} else {
			$(httc + ' ul#testimonials-container li').first().addClass('active');
			$(httc + ' ul#country-icons-container li').first().addClass('active');
		}

	});

	// look-for-jobs-container testimonials slider
	$.each( $(lfjc + ' ul#country-icons-container li'), function( index, value ){
	 
	 	var icon_id = $(this).attr('id');
		var country = icon_id.split('--')[1];

		if(country == usersCountry) {
			hasCountry = country;
		}
		
	}).promise().done( function(){ 
		
		if(hasCountry.length > 0) {
			$(lfjc + ' ul#testimonials-container li#testimonial-'+hasCountry).addClass('active');
			$(lfjc + ' ul#country-icons-container li#country--'+hasCountry).addClass('active');
		} else {
			$(lfjc + ' ul#testimonials-container li').first().addClass('active');
			$(lfjc + ' ul#country-icons-container li').first().addClass('active');
		}

	});


	// automate the testimonial slider
	function updateClass() {

		var icon_id,
			country;

		let active_testimonial = $(".client.active");

		if (active_testimonial.length != 0){
			icon_id = active_testimonial.attr('id');
			country = icon_id.split('-')[1];
		}

		active_testimonial.removeClass("active");
		$(httc + ' ul#country-icons-container li#country--'+country).removeClass("active");

		active_testimonial = active_testimonial.next(".client");
		
		if (active_testimonial.length == 0)
			active_testimonial = $(".client").first();

		if (active_testimonial.length != 0){
			icon_id = active_testimonial.attr('id');
			country = icon_id.split('-')[1];
		}

		active_testimonial.addClass("active");
		$(httc + ' ul#country-icons-container li#country--'+country).addClass("active");

	}

	// detect when element is in view port
	function inViewport($el) {
	    var elH = $el.outerHeight(),
	        H   = $(window).height(),
	        r   = $el[0].getBoundingClientRect(), t=r.top, b=r.bottom;
	    return Math.max(0, t>0? Math.min(elH, H-t) : Math.min(b, H));
	}

	// flag set to only run once within view port
	var hasBeenTrigged = false;
	var handle;

	// if slider is in view port start automation
	$(window).on("scroll resize", function(){

		// if the div exists on the page
		if( !$('#testimonials-container').length == 0 ) {
			
			// if the slider is in the view port
			if( inViewport($('#testimonials-container')) > 0 && !hasBeenTrigged ) {

				handle = setInterval(function() {
					
					updateClass();
				
				}, 10000);

				hasBeenTrigged = true;
			} 

			// if the slider has moved out of the view port
			if( inViewport($('#testimonials-container')) == 0) {
				
				if(handle)
					clearInterval(handle);
				hasBeenTrigged = false;
			
			}
		}
		
	  // console.log( inViewport($('#testimonials-container')) ); // n px in viewport
	});

	// if the user is hovering over the country icons
	// stop the animation otherwise resume
	$("#country-icons-container").on({
	    mouseenter: function () {
	        
	        clearInterval(handle);
	    
	    },
	    mouseleave: function () {
	        
	        handle = setInterval(function() {

				updateClass();
			
			}, 10000);

	    }
	});

	// country icons
	$('body').on('click', httc + ' ul#country-icons-container li a', function(e) {

		// get the id of the selected element
		var icon_id = $(this).parent().attr('id');

		// get the href of clicked element
		var href = $(this).attr('href');

		// pull out the country from the id
		var country = icon_id.split('--')[1];

		// if not an external link disable the href
		if( !$(this).parent().hasClass('external-link') || href == '#' ) {
			e.preventDefault();
		}

		// remove class from all list items
		$(httc + ' ul#country-icons-container li').removeClass('active');
		$(httc + ' ul#testimonials-container li').removeClass('active');

		// add class to specific list items
		$(httc + ' ul#testimonials-container li#testimonial-'+country).addClass('active');
		$(this).parent().addClass('active');
	
	});

	function getMaxHeight(selector) {
		var heights = new Array();

		// Loop to get all element heights
		$(selector+' li').each(function() {
			// Then add size (no units) to array
	 		heights.push($(this).height());
		});

		// Find max height of all elements
		var max = Math.max.apply( Math, heights );

		// Need to let sizes be whatever they want so no overflow on resize
		$(selector).css('min-height', '0');
		$(selector).css('max-height', 'none');
		$(selector).css('height', 'auto');

		// Set height to max height
		$(selector).css('height', max);
	}

	// Set height of container on page load
	getMaxHeight('ul#testimonials-container');

	$(window).resize(function() {
		
		// Check window width has actually changed and it's not just iOS triggering a resize event on scroll
        if ($(window).width() != windowWidth) {

            // Update the window width for next time
            windowWidth = $(window).width();

            // Needs to be a timeout function so it doesn't fire every ms of resize
			setTimeout(function() {
				getMaxHeight('ul#testimonials-container');
			}, 120);

        }
		
	});

	$('.consultants-archive #main-posts article .consultant-profile-image img').matchHeight();

	// Apply Form
	$('body').on('click', '.apply-link', function(e) {
		
		e.preventDefault();
		
		$(this).fadeOut('fast');
		
		//$('.single-vacancies article, .hide-on-submit').fadeOut('fast');
		$('.single-vacancies article').fadeOut('fast');
		
		$('#position-apply-form').fadeIn( "slow", function() {
		    // Animation complete
		    var assignmentNumber = $(this).data('assignment-number');
		    var consultantEmail = $(this).data('consultant-email');
		    var consultantName = $(this).data('consultant-name');
		    var jobTitle = $(this).data('job-title');
		    var jobClient = $(this).data('job-client');
		    $(this).find('#assignment-number').val(assignmentNumber);
		    $(this).find('#consultant-email').val(consultantEmail);
		    $(this).find('#consultant-name').val(consultantName);
		    $(this).find('#job-title').val(jobTitle);
		    $(this).find('#job-client').val(jobClient);
		    // console.log(assignmentNumber, consultantEmail, consultantName, jobTitle);
		});

		$('.application-submitted').remove();
		$('.wpcf7-display-none').hide();

	});

	// Close Apply Form
	$('body').on('click', '.close-position-apply-form', function(e) {
		
		e.preventDefault();

		$('form')[0].reset();
		$('.wpcf7-not-valid-tip').remove();

		$('#position-apply-form').fadeOut( "fast", function() {
		    // Animation complete
		    // $('.apply-link, .single-vacancies article, .hide-on-submit').fadeIn('slow');
		    $('.apply-link, .single-vacancies article').fadeIn('slow');

		});

	});

	/*Brought click function of fileupload button when text field is clicked*/
	$('body').on('click', '#uploadtextfield', function() {
		$('#fileuploadfield').click()
	});

	/*Brought click function of fileupload button when browse button is clicked*/
	$('body').on('click', '#uploadbrowsebutton', function() {
		$('#fileuploadfield').click()
	});

	/*To bring the selected file value in text field*/	
	$('body').on('change', '#fileuploadfield', function() {
		$('#uploadtextfield').val($(this).val());
	});

	// contact form 7 Apply Form on Submit Callback
	document.addEventListener( 'wpcf7mailsent', function( event ) {
	    if ( '1136' == event.detail.contactFormId ) {
	        
	        // do something productive
	        $('#position-apply-form').fadeOut( "fast", function() {
			    // Animation complete
			    // $('.apply-link, .single-vacancies article, .hide-on-submit').fadeIn('slow');
			    $('.apply-link, .single-vacancies article').fadeIn('slow');

			    $('.single-vacancies article').prepend('<div class="application-submitted wpcf7-response-output wpcf7-display-none wpcf7-mail-sent-ok" style="display: block;" role="alert">Success!! We have received your application. Someone will get back with you shortly.</div>')
			});
	    }
	}, false );

	// on submit button click check if file input has anything
	// if not remove the file input for IOS Safari
	$('body').on('click', '.wpcf7-submit', function(e){
		
		$("input[type=file]").each(function() {
		   if($(this).val() === "") {
		     $(this).remove();
		   }
		});
		
	});

	document.addEventListener( 'wpcf7invalid', function( event ) {

		if ( '1284' == event.detail.contactFormId  || '1136' == event.detail.contactFormId ) {
	    
	    	if( $(".fileuploadfield").parents(".applicants-resume").length == 1 ) {
		    	// we have a file 
		    } else {
		    	$('.applicants-resume').append('<input type="file" name="applicants-resume" size="40" class="wpcf7-form-control wpcf7-file wpcf7-validates-as-required fileuploadfield" id="fileuploadfield" accept=".pdf,.doc,.docx" aria-required="true" aria-invalid="false">');
		    }

		}

	}, false );


});