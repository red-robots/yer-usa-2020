/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
	/*
	*
	*	Current Page Active
	*
	------------------------------------*/
	$("[href]").each(function() {
    if (this.href == window.location.href) {
        $(this).addClass("active");
        }
	});

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
        FAQ dropdowns
	__________________________________________
	*/
	$('.question').click(function() {
	 
	    $(this).next('.answer').slideToggle(500);
	    $(this).toggleClass('close');
	    $(this).find('.plus-minus-toggle').toggleClass('collapsed');
	    $(this).parent().toggleClass('active');
	 
	});

	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	var $all_oembed_videos = $("iframe[src*='youtube']");
	
	$all_oembed_videos.each(function() {
	
		$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 	});
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.flexslider').flexslider({
		animation: "slide",
	}); // end register flexslider
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});
	
	/*
	*
	*	Isotope with Images Loaded
	*
	------------------------------------*/
	var $container = $('#container').imagesLoaded( function() {
  	$container.isotope({
    // options
	 itemSelector: '.item',
		  masonry: {
			gutter: 15
			}
 		 });
	});

	/*
	*
	*	Smooth Scroll to Anchor
	*
	------------------------------------*/
	 $('a').click(function(){
	    $('html, body').animate({
	        scrollTop: $('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top
	    }, 500);
	    return false;
	});

	
	
	
	/*
	*
	*	Equal Heights Divs
	*
	------------------------------------*/
	$('.js-blocks').matchHeight();




	/*
	*
	*	Equal Heights Divs
	*
	------------------------------------*/
	
	var $sidebar = $('#sidebar');
	
	// Set the sidebar post count
	// $sidebar.html( $('#main-posts').find('article').length + ' Results');
	$sidebar.html( ajaxData.found_posts + ' Results');

	// get URL Params
  	function getUrlParameter(name) {
	    
	    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
	    
	    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
	    
	    var results = regex.exec(location.search);
	    
	    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
	
	};

	// looking for a search param
	var searchQuery = getUrlParameter('s');

	// grab the url
	var uri = window.location.toString();

	// if search param is found add it to the search field and cleanup the URL
	if(searchQuery) {
		$('input#keyword').val(searchQuery);
		
		if (uri.indexOf("?") > 0) {
		    var clean_uri = uri.substring(0, uri.indexOf("?"));
		    window.history.replaceState({}, document.title, clean_uri);
		}

	}

	/*
	 * Vacancies Load More
	 */
	$('#vacancies_loadmore').click(function(){
 
 		$.ajax({
			url : ajaxData.ajaxurl, // AJAX handler
			data : {
				'action': 'loadmore', // the parameter for admin-ajax.php
				'query': ajaxData.posts, // loop parameters passed by wp_localize_script()
				'page' : ajaxData.current_page, // current page
				'keyword' : $('#keyword').val(),
				'position' : $('#vposition').val(),
				'position-function' : $('#vposition-function').val(),
				'location' : $('#vlocation').val(),
				'consultant' : $('#vconsultant').val()
			},
			type : 'POST',
			beforeSend : function ( xhr ) {
				$('#vacancies_loadmore').text('Loading...'); // some type of preloader
			},
			success : function( data ){
				if( data ) {
 	
 					$('#vacancies_loadmore').text( 'Load More Positions' );
					$('#main-posts').append(data); // insert new posts
					ajaxData.current_page++;
 
					if ( ajaxData.current_page == ajaxData.max_page ) 
						$('#vacancies_loadmore').hide(); // if last page, HIDE the button

					// NO need to update the sidebar post count from here
					// $sidebar.html( $('#main-posts').find('article').length + ' Results');
					// $sidebar.html( ajaxData.found_posts + ' Results');
 
				} else {
					$('#vacancies_loadmore').hide(); // if no data, HIDE the button as well
				}
			}
		});
		return false;
	});
 var ajaxData;
	/*
	 * Vacancies Filter
	 */
	$('select.vacancies-select, #keyword').bind("keyup change", function(){
		
		$.ajax({
			url : ajaxData.ajaxurl,
			data : $('#vacancies-filters').serialize(), // form data
			dataType : 'json', // this data type allows us to receive objects from the server
			type : 'POST',
			beforeSend : function(xhr){
				$('#vacancies-filters').find('button').text('Filtering...');
			},
			success:function(data){

				// when filter applied:
				// set the current page to 1
				ajaxData.current_page = 1;
 
				// set the new query parameters
				ajaxData.posts = data.posts;
 
				// set the new max page parameter
				ajaxData.max_page = data.max_page;
 
				// change the button label back
				$('#vacancies-filters').find('button').text('Apply filter');
 
				// insert the posts to the container
				$('#main-posts').html(data.content);
 
				// hide load more button, if there are not enough posts for the second page
				if ( data.max_page < 2 ) {
					$('#vacancies_loadmore').hide();
				} else {
					$('#vacancies_loadmore').show();
				}

				// update the sidebar post count
				//$sidebar.html( $('#main-posts').find('article').length + ' Results');
				$sidebar.html( data.found_posts + ' Results');

				if(data.found_posts == 0) {
					$('#main-posts').html('<h2>No posts found</h2>');
				}
			},
			error : function(error){ 
				console.log('vacancies-filters error - ',error) 
			}
		});
 
		// do not submit the form
		return false;
 
	});

	/*
	 * Consultants Filter
	 */
	$('select.consultants-select').bind("change", function(){

		$.ajax({
			url : ajaxData.ajaxurl,
			data : $('#consultants-filters').serialize(), // form data
			dataType : 'json', // this data type allows us to receive objects from the server
			type : 'POST',
			success:function(data){
				
				// when filter applied:
				// set the current page to 1
				ajaxData.current_page = 1;
 
				// set the new query parameters
				ajaxData.posts = data.posts;
 
				// set the new max page parameter
				ajaxData.max_page = data.max_page;
 
				// insert the posts to the container
				$('#main-posts').html(data.content);

				if(data.found_posts > 0) {

					// call function to determine the first and last rows
					flexrow();

					// readjust the hieghts of the images
					$.fn.matchHeight._apply('.consultants-archive #main-posts article .consultant-profile-image img');

				} else {

					$('#main-posts').html('<h2>No posts found</h2>');
				
				}
 
			},
			error : function(error){ 
				console.log('consultants-filters error - ',error) 
			}
		});
 
		// do not submit the form
		return false;
 
	});


	/*
	**** Check the rows and determine ***
	**** the first and last rows so *****
	**** you can style accordingly ******
	*/

	// call function on poage load
	flexrow();

	// call function on resize
	$(window).resize(flexrow).trigger('resize');

	// call function on drop down select change
	$('select#consultants-locations').bind("change", function(){
		flexrow();
	});

	function flexrow() {
		
		$('#main-posts > article').removeClass('firstinrow lastinrow firstrow lastrow');
		var prevtop = -1;
		var firsttop = $('#main-posts article:first').position().top;
		var lasttop = $('#main-posts article:last').position().top;
		
		$.each($('#main-posts > article'), function(i, elem) {
			
			var currtop = $(elem).position().top;
			
			if (currtop != prevtop)
			  $(elem).addClass('firstinrow');
			
			if (currtop == firsttop)
			  $(elem).addClass('firstrow');
			
			if (currtop == lasttop)
			  $(elem).addClass('lastrow');
			
			prevtop = currtop;
		});

		$('#main-posts article.firstinrow').prev().addClass('lastinrow');
		$('#main-posts article:last').addClass('lastinrow');
	}

	$('.noEnterSubmit').keypress(function(e){
	    if ( e.which == 13 ) return false;
	    //or...
	    if ( e.which == 13 ) e.preventDefault();
	});

	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();

});// END #####################################    END