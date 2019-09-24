<?php
$country = do_shortcode('[geoip_detect2 property="country"]');
$country_iso_code = do_shortcode('[geoip_detect2 property="country.isoCode"]');

function theme_name_scripts() {

	global $country, $wp_query;

	$theme_version = et_get_theme_version();

	// Get last modified timestamp of CSS file in /css/style.css
    $style_path = get_stylesheet_directory_uri() . '/style.css';
    $style_real_path = get_stylesheet_directory().'/style.css';
    
    $css_time = filemtime($style_real_path);
    
    wp_register_style( 'childstyle', $style_path, array(), $css_time );
    wp_enqueue_style( 'childstyle' );

	// Get last modified timestamp of javascript file in /js/main.js
    $js_path = get_stylesheet_directory_uri() . '/js/custom_scripts.js';
    $js_real_path = get_stylesheet_directory().'/js/custom_scripts.js';
    
    $js_time = filemtime($js_real_path);

    wp_enqueue_script( 
			'acstarter-blocks', 
			get_stylesheet_directory_uri() . '/assets/js/vendors.js', 
			array(), '20120206', 
			true 
		);

	// wp_enqueue_script( 
	// 		'acstarter-custom', 
	// 		get_stylesheet_directory_uri() . '/assets/js/custom.js', 
	// 		array(), '20120206', 
	// 		true 
	// 	);
	

    wp_register_script( 'customScripts', $js_path, array('jquery'), $js_time, $in_footer = true  );
    wp_enqueue_script( 'customScripts' );
    wp_localize_script('customScripts', 'myData', array( 'template_url' => get_stylesheet_directory_uri(), 'is_front_page' => is_front_page(), 'is_single' => is_single(), 'page_id' => get_the_ID(), 'is_page_template' => is_page_template(), 'country_of_origin' => $country ) );

    if ( is_post_type_archive('vacancies') || is_post_type_archive('consultants') ) {
    	
    	// we have to calculate the max number of pages
    	$published_posts = $wp_query->found_posts;
    	$posts_per_page = get_option('posts_per_page');
    	$page_number_max = ceil($published_posts / $posts_per_page);
    	
    	// Get last modified timestamp of javascript file in /js/ajax_scripts.js
	    $ajax_path = get_stylesheet_directory_uri() . '/js/ajax_scripts.js';
	    $ajax_real_path = get_stylesheet_directory().'/js/ajax_scripts.js';
	    
	    $ajax_time = filemtime($ajax_real_path);

	    wp_register_script( 'ajaxScripts', $ajax_path, array('jquery'), $ajax_time, $in_footer = true  );
	    wp_localize_script('ajaxScripts', 'ajaxData', array( 
	    	'ajaxurl'  => site_url() . '/wp-admin/admin-ajax.php',
	    	'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
			'current_page' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
			'max_page' => $page_number_max,
			'default_ppp' => get_option( 'posts_per_page' ),
			'found_posts' => $wp_query->found_posts
	    ) );
	    wp_enqueue_script( 'ajaxScripts' );
    }

    wp_register_script('linkedIn', '//platform.linkedin.com/in.js');
    wp_enqueue_script('linkedIn');

    wp_register_script('matchHeight', '//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js', array('jquery'), $in_footer = true );
    wp_enqueue_script('matchHeight');

    wp_register_script('addToAny', 'https://static.addtoany.com/menu/page.js');
    wp_enqueue_script('addToAny');

}
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

function my_async_scripts( $tag, $handle, $src ) {
    // the handles of the enqueued scripts we want to async
    $async_scripts = array( 'addToAny' );

    if ( in_array( $handle, $async_scripts ) ) {
        return '<script type="text/javascript" src="' . $src . '" async="async"></script>' . "\n";
    }

    return $tag;
}
add_filter( 'script_loader_tag', 'my_async_scripts', 10, 3 );

function theme_admin_scripts() {
	$theme_version = et_get_theme_version();
	// load custom js file for admin screens
	
	// Get last modified timestamp of CSS file in /css/admin-screens.css
    // $admin_style_path = get_stylesheet_directory_uri() . '/css/admin-screens.css';
    // $admin_style_real_path = get_stylesheet_directory().'/css/admin-screens.css';
    
    // $admin_css_time = filemtime($admin_style_real_path);
    
    // wp_register_style( 'adminScreens', $admin_style_path, array(), $admin_css_time );
    // wp_enqueue_style( 'adminScreens' );

    // Get last modified timestamp of JS file in /js/admin-screens.js
    $admin_js_path = get_stylesheet_directory_uri() . '/js/admin_scripts.js';
    $admin_js_real_path = get_stylesheet_directory().'/js/admin_scripts.js';
    
    $admin_js_time = filemtime($admin_js_real_path);
    
    wp_register_script( 'adminScripts', $admin_js_path, array(), $admin_js_time );
    wp_enqueue_script( 'adminScripts' );

}
add_action( 'admin_enqueue_scripts', 'theme_admin_scripts' );

/*
* Remove the stylesheet style.css Divi enqueues in the theme 
* since we added it with a timestamp in the above enqueue function
*/
function dequeue_my_css() { 
  wp_dequeue_style( 'divi-style' );
  wp_deregister_style( 'divi-style' );
}
add_action('wp_enqueue_scripts','dequeue_my_css',100);

function add_pagetitle__body_class( $classes ) {
	global $post;

	$post_slug=$post->post_name;
	$post_slug = strtolower($post_slug);
	$post_slug = str_replace('-', '', $post_slug);

	$classes[] = 'title-class-'.$post_slug;

	return $classes;
}
add_filter( 'body_class','add_pagetitle__body_class' );


/**
 * Loads theme settings
 *
 */
if ( ! function_exists( 'et_load_core_options' ) ) {

	function et_load_core_options() {

		global $shortname, $$themename;
		require_once get_template_directory() . esc_attr( "/options_{$shortname}.php" );
		$newOptions = [];
		
		if($options) :
		
			foreach ($options as $i => $optionArray) {
				$newOptions[] = $optionArray;
				if (isset($optionArray['id']) && $optionArray['id'] == 'divi_show_google_icon') {

					$showOptions = array( 
						"name" =>esc_html__( "Show Instagram Icon", $themename ),
	                   	"id" => $shortname."_show_instagram_icon",
	                   	"type" => "checkbox2",
	                   	"std" => "on",
	                   	"desc" =>esc_html__( "Here you can choose to display the Instagram Icon. ", $themename ) );

					$newOptions[] = $showOptions;

					$showOptions2 = array( 
						"name" =>esc_html__( "Show Youtube Icon", $themename ),
	                   	"id" => $shortname."_show_youtube_icon",
	                   	"type" => "checkbox2",
	                   	"std" => "on",
	                   	"desc" =>esc_html__( "Here you can choose to display the Youtube Icon. ", $themename ) );

					
					$newOptions[] = $showOptions2;

					$showOptions3 = array( 
						"name" =>esc_html__( "Show LinkedIn Icon", $themename ),
	                   	"id" => $shortname."_show_linkedin_icon",
	                   	"type" => "checkbox2",
	                   	"std" => "on",
	                   	"desc" =>esc_html__( "Here you can choose to display the LinkedIn Icon. ", $themename ) );

					
					$newOptions[] = $showOptions3;
				}

				if (isset($optionArray['id']) && $optionArray['id'] == 'divi_google_url') {

					$urlOptions = array( "name" =>esc_html__( "Instagram Profile Url", $themename ),
			                   "id" => $shortname."_instagram_url",
			                   "std" => "#",
			                   "type" => "text",
			                   "validation_type" => "url",
							   "desc" =>esc_html__( "Enter the URL of your Instagram Profile. ", $themename ) );

					$urlOptions2 = array( "name" =>esc_html__( "Youtube Url", $themename ),
			                   "id" => $shortname."_youtube_url",
			                   "std" => "#",
			                   "type" => "text",
			                   "validation_type" => "url",
							   "desc" =>esc_html__( "Enter the URL of your Youtube Channel. ", $themename ) );

					$urlOptions3 = array( "name" =>esc_html__( "LinkedIn Url", $themename ),
			                   "id" => $shortname."_linkedin_url",
			                   "std" => "#",
			                   "type" => "text",
			                   "validation_type" => "url",
							   "desc" =>esc_html__( "Enter the URL of your LinkedIn Profile. ", $themename ) );

					$newOptions[] = $urlOptions;
					
					$newOptions[] = $urlOptions2;

					$newOptions[] = $urlOptions3;
				}
			}

		endif;

		$options = $newOptions;
		
	}

}

function vacancies_search_form( $form ) {
 	//<input type="hidden" name="post_type" value="vacancies">
    $form = '<form role="vsearch" method="get" id="vacancies-searchform" action="' . home_url( '/vacancies' ) . '" >
    <div class="search">
    <span>
    <span class="fa fa-search"></span>
    <input type="text" placeholder="Search Open Positions" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </span>
    </div>
    </form>';
 
    return $form;
}
 
add_shortcode('vacancies-search', 'vacancies_search_form');

function get_social_icons($atts, $content = null) {

	extract(shortcode_atts(array( 'target' => '_self' ), $atts));

	$social_icons .= '<ul class="shortcode-social">';

	if ( 'on' === et_get_option( 'divi_show_facebook_icon', 'on' ) ) :
		$social_icons .= '<li class="menu-item et-social-icon et-social-facebook">
			<a href="'.esc_url( et_get_option( 'divi_facebook_url', '#' ) ).'" class="icon" target="'.$target.'">
			</a>
		</li>';
	endif;
	if ( 'on' === et_get_option( 'divi_show_twitter_icon', 'on' ) ) :
		$social_icons .= '<li class="menu-item et-social-icon et-social-twitter">
			<a href="'.esc_url( et_get_option( 'divi_twitter_url', '#' ) ).'" class="icon" target="'.$target.'">
			</a>
		</li>';
	endif;
	if ( 'on' === et_get_option( 'divi_show_instagram_icon', 'on' ) ) :
		$social_icons .= '<li class="menu-item et-social-icon et-social-instagram">
			<a href="'.esc_url( et_get_option( 'divi_instagram_url', '#' ) ).'" class="icon" target="'.$target.'">
			</a>
		</li>';
	endif;
	if ( 'on' === et_get_option( 'divi_show_youtube_icon', 'on' ) ) :
		$social_icons .= '<li class="menu-item et-social-icon et-social-youtube">
			<a href="'.esc_url( et_get_option( 'divi_youtube_url', '#' ) ).'" class="icon" target="'.$target.'">
			</a>
		</li>';
	endif;
	if ( 'on' === et_get_option( 'divi_show_google_icon', 'on' ) ) :
		$social_icons .= '<li class="menu-item et-social-icon et-social-google-plus">
			<a href="'.esc_url( et_get_option( 'divi_google_url', '#' ) ).'" class="icon" target="'.$target.'">
			</a>
		</li>';
	endif;
	if ( 'on' === et_get_option( 'divi_show_linkedin_icon', 'on' ) ) :
		$social_icons .= '<li class="menu-item et-social-icon et-social-linkedin">
			<a href="'.esc_url( et_get_option( 'divi_linkedin_url', '#' ) ).'" class="icon" target="'.$target.'">
			</a>
		</li>';
	endif;

	if ( 'on' === et_get_option( 'divi_show_rss_icon', 'on' ) ) :
	
		$et_rss_url = '' !== et_get_option( 'divi_rss_url' )
			? et_get_option( 'divi_rss_url' )
			: get_bloginfo( 'rss2_url' );
	
		$social_icons .= '<li class="menu-item et-social-icon et-social-rss">
			<a href="'.esc_url( $et_rss_url ).'" class="icon" target="'.$target.'">
			</a>
		</li>';
	endif;

	$social_icons .= '</ul>';

	return $social_icons;
}
// shortcode to get the social links
add_shortcode( 'social-icons', 'get_social_icons' );

function print_menu_shortcode($atts, $content = null) {
	
	extract(shortcode_atts(array( 'name' => null, 'class' => null ), $atts));

	return wp_nav_menu( array( 'menu' => $name, 'menu_class' => $class, 'echo' => false ) );

}
// shorcode to grab menus
add_shortcode('menu', 'print_menu_shortcode');

function get_country_icons($atts, $content = '') {

	global $country;
	$result='';
	$count = 1;

	$a = shortcode_atts( [
    	'type'   => false,
    ], $atts );

    if ( $a['type'] ) {
        // Parse type into an array. Whitespace will be stripped.
        $a['type'] = array_map( 'trim', str_getcsv( $a['type'], ',' ) );
    }

    $result .= '<ul id="country-icons-container" class="">';

	$args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1, 'post_status' => 'publish' );
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post();
    
    // get the post id and assign it to a variable
	$post_id = get_the_ID();

	$type_of_testimonial = strtolower( get_post_meta( $post_id , 'type_of_testimonial' , true ) );
	$external_link_url = get_post_meta( $post_id , 'external_link_url' , true );
	$country_name = $country_path = get_post_meta( $post_id , 'country' , true );
    $country_path = strtolower(str_replace(' ', '_', $country_path));
    $country_path = '<img src="'.get_stylesheet_directory_uri().'/img/flags/'.strtolower($country_path).'@2x.png" />';
    $is_el_url_empty = false;
    
    if($type_of_testimonial == 'external link') {
		
		if($external_link_url == '#')
			$is_el_url_empty = true;

		$external_link_url = $external_link_url;

	} else {

		$external_link_url = '#';
	
	}

    if($country_name == 'null') {
    	$country_name = 'No Country Selected';
    	$country_path = '';
    }

	foreach ($a['type'] as $key => $value) {

		$class = '';

		// if(strtolower(str_replace(' ', '-', $country)) == $value) {
		// 	$class = 'active';
		// } elseif($count == 1) {
		// 	$class = 'active';
		// }
		
		if($value == $type_of_testimonial) :

			if(!$is_el_url_empty) {
				$result .= 	'<li id="country--'.strtolower(str_replace(' ', '-', $country_name)).'" class="country-item '.str_replace(' ', '-', $value).' '.$class.'"><a href="'.$external_link_url.'" class="" title="'.$country_name.'" target="_blank">' . $country_path . '</a></li>';
			} else {
				$result .= 	'<li id="country--'.strtolower(str_replace(' ', '-', $country_name)).'" class="country-item '.str_replace(' ', '-', $value).' '.$class.'"><i>' . $country_path . '</i></li>';
			}

		endif;
	}

	$count++;

    endwhile;

    wp_reset_postdata();

    $result .= '</ul>';

    return $result;
}

// shortcode to display country on page
add_shortcode( 'country-of-origin', 'country_of_origin' );
function country_of_origin($atts, $content = '') {

	global $country, $country_iso_code;

	$country_isocodes_array = array(
		array(
			'name' => 'Germany',
			'isocode' => 'DE',
		),
		array(
			'name' => 'Italy',
			'isocode' => 'IT',
		),
		array(
			'name' => 'Netherlands',
			'isocode' => 'NL',
		),
		array(
			'name' => 'Switzerland',
			'isocode' => 'CH',
		),	
		array(
			'name' => 'Belgium',
			'isocode' => 'BE',
		),
		array(
			'name' => 'France',
			'isocode' => 'FR',
		),
		array(
			'name' => 'Denmark',
			'isocode' => 'DK',
		),
		array(
			'name' => 'Sweden',
			'isocode' => 'SE',
		),
		array(
			'name' => 'United Kingdom',
			'isocode' => 'GB',
		),
		array(
			'name' => 'United States',
			'isocode' => 'US',
		)
	);

	foreach ($country_isocodes_array as $key => $value) {
		
		if($value['isocode'] == $country_iso_code && $value['isocode'] != 'US') {
			$country = $value['name'];
		} else {
			$country = 'Europe';
		}
		
	}

    return $country;
}

// shortcode to get the country icons
add_shortcode( 'country-icons', 'get_country_icons' );

function get_testimonials($atts, $content = '') {

	global $country;
	$result='';
	$count = 1;

	$a = shortcode_atts( [
    	'type'   => '',
    ], $atts );

    if ( $a['type'] ) {
        // Parse type into an array. Whitespace will be stripped.
        $a['type'] = array_map( 'trim', str_getcsv( $a['type'], ',' ) );
    }

    $result .= '<ul id="testimonials-container" class="">';

	$args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1, 'post_status' => 'publish');
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post();
    
    // get the post id and assign it to a variable
	$post_id = get_the_ID();

	$thumbnail = get_the_post_thumbnail($post_id);
	$type_of_testimonial = strtolower( get_post_meta( $post_id , 'type_of_testimonial' , true ) );
	$external_link_url = get_post_meta( $post_id , 'external_link_url' , true );
	$country_name = get_post_meta( $post_id , 'country' , true );
    
    if($country_name == 'null') {
    	$country_name = 'No Country Selected';
    	$country_path = '';
    }

    if($type_of_testimonial == 'external link') {
		$content = 'External Link' . '<p>'.$external_link_url = $external_link_url == '#' ? 'No URL' : $external_link_url.'</p>';
	} else {
		$content = get_the_content($post_id);
	}

	foreach ($a['type'] as $key => $value) {

		$class = '';

		// if(strtolower(str_replace(' ', '-', $country)) == $value) {
		// 	$class = 'active';
		// } elseif($count == 1) {
		// 	$class = 'active';
		// }
		
		if($value == $type_of_testimonial) :

			$result .= 	'<li id="testimonial-'.strtolower(str_replace(' ', '-', $country_name)).'" class="testimonial-item '.str_replace(' ', '-', $value).' '.$class.'"> ' .
							'<div class="img-container">'.$thumbnail.'</div>' .
							'<div class="quote"><blockquote><span>'.$content.'</span></blockquote></div>' .
							'<div class="testimonial-meta">' . 
								'<span class="name">'.get_the_title().'</span>' .
								'<span class="position">'.get_post_meta( $post_id , 'position' , true ).'</span>' .
								'<span class="company">'.get_post_meta( $post_id , 'company_name' , true ).'</span>' .
							'</div>' .
						'</li>';

		endif;
	}

	$count++;

    endwhile;

    wp_reset_postdata();

    $result .= '</ul>';

    return $result;
}
// shortcode to get the country icons
add_shortcode( 'testimonials', 'get_testimonials' );

function latest_vacancies($atts, $content = '') {
	$result='';
	$a = shortcode_atts( [
    	'type'   	=> 'professional level,director/executive level,c-level',
    	'layout' 	=> null,
    	'num-posts' => 4,
    	'client' 	=> null,
    ], $atts );

    if ( $a['type'] ) {
        // Parse type into an array. Whitespace will be stripped.
        $a['type'] = array_map( 'trim', str_getcsv( $a['type'], ',' ) );
    }

    if($a['layout'] == 'compact' || $a['layout'] == null) {
    	$result .= '<ul id="latest-vacancies-container" class="">';
    }

    $args = array( 'post_type' => 'vacancies', 'posts_per_page' => $a['num-posts'], 'post_status' => 'publish');

    // if only client is set
	if($a['client'] != null)
		$args['meta_query'][] = array(
			'key' => 'job_client',
			'value' => urldecode($a['client']),
			'type' => 'text',
			'compare' => '='
		);

    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) : 
    	while ( $loop->have_posts() ) : $loop->the_post();
	    // while ( $loop->have_posts() ) : $loop->the_post();
	    
	    // get the post id and assign it to a variable
		$post_id = get_the_ID();

		$position_level = strtolower( get_post_meta( $post_id , 'position_level' , true ) );

		$job_location = get_post_meta( $post_id , 'job_location' , true );
		$job_client = get_post_meta( $post_id , 'job_client' , true );
		$job_client_logo = get_field('job_client_logo') ? '<img src="'.get_field('job_client_logo').'" />' : '';
		$position_status='';
		$position_status = $position_status == 1 ? 'Open Position' : 'This Position is Closed';
		$seperator = strlen($job_client) > 0 && strlen($job_location) > 0 ? ' - ' : '';

		$classes = join(' ', get_post_class('et_pb_post'));
		
		foreach ($a['type'] as $key => $value) {

			$class = '';

			if ( has_excerpt( get_the_ID() ) ) 
				$excerpt = '<div class="the-excerpt">'.get_the_excerpt().'</div>';
			
			if(strtolower($value) == $position_level) :

				if($a['layout'] == 'compact' || $a['layout'] == null) {
					
					$result .= 	'<li id="" class="vacancy-item '.str_replace(' ', '-', $value).' '.$class.'"> ' .
									'<div class="vacancies-meta">' . 
										'<div class="job-location">'.get_post_meta( $post_id , 'job_location' , true ).'</div>' .
										'<div class="job-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></div>' .
										'<div class="job-excerpt">'.$excerpt.'</div>' .
									'</div>' .
								'</li>';

				}


				if($a['layout'] == 'full') {

					$result .= '<article id="post-'. $post_id .'" class="'.$classes.' regular-font">

							<span class="regular-font"><h2 class="client-location">'.$job_client . $seperator . $job_location.'</h2></span>

							<h2 class="entry-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>
							
							<div class="the-excerpt"><p>'.get_the_excerpt().'</p></div>
							
							<div class="article-post-btn-container">
								
								<div class="truncated-post">'.wp_trim_words( get_the_content(), 26 ).'</div>

								<div class="job-client-logo">'.$job_client_logo.'</div>
							
								<div class="go-to-article-btn">
									<a href="'.get_the_permalink().'"><img src="'.get_bloginfo('stylesheet_directory').'/img/arrow@2x.png"></a>
								</div>

							</div>

						</article>';

				}


			endif;
		}

		endwhile;

	else:

		 $result = '<h2 style="text-align:center;">There are currently no posted openings for YER-USA. Please <a href="/contact"><strong>Contact Us</strong></a> with any further inquiries.</h2>';

	endif;

    wp_reset_postdata();

    if($a['layout'] == 'compact' || $a['layout'] == null) {

    	$result .= '</ul>';

    }

    return $result;
}
// shortcode to get the latest vacancies
add_shortcode( 'latest-vacancies', 'latest_vacancies' );

function modify_contact_methods($contactmethods) {

	// Add new fields
	$contactmethods['twitter'] = 'Twitter Username';
	$contactmethods['facebook'] = 'Facebook URL';
	$contactmethods['linkedin'] = 'Linkedin URL';
	$contactmethods['job_title'] = 'Job Title';
	$contactmethods['user_mobile'] = 'Mobile';
	$contactmethods['user_phone'] = 'Phone';
	unset($contactmethods['googleplus']);

	return $contactmethods;
}
add_filter('user_contactmethods', 'modify_contact_methods');

/* add custom profile field */
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { 

	wp_enqueue_media(); 

	$longbio_content = get_the_author_meta( 'longbio', $user->ID ); ?>

    <h3>Extra profile information</h3>

    <table class="form-table">

        <tr>
            <th><label for="longbio">Long Bio</label></th>

            <td>
                <!-- <textarea type="text" name="longbio" id="longbio" class="regular-text use-html"><?php echo esc_attr( $longbio_content ); ?></textarea> -->
                <?php wp_editor( $longbio_content, 'longbio' ); ?>
            </td>
        </tr>

    </table>

<?php }

/* save custom profile field */
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

    update_usermeta( $user_id, 'longbio', $_POST['longbio'] );
}

// create custom post types
add_action( 'init', 'create_post_types' );
function create_post_types() {
	$testimonialsargs = array(
	        'labels' => array(
					    'name' => 'Testimonials',
					    'singular_name' => 'Testimonial',
					    'add_new_item' => 'Add New Testimonial',
					   ),
	        'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'testimonials' ),
			'capability_type'    => 'post',
			'taxonomies'		 => array( 'category' ),
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'			 => 'dashicons-testimonial',
			'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	$vacanciesargs = array(
	        'labels' => array(
					    'name' => 'Vacancies',
					    'singular_name' => 'Vacancy',
					    'add_new_item' => 'Add New Vacancy',
					   ),
	        'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'vacancies' ),
			'capability_type'    => 'post',
			'taxonomies'		 => array( 'category' ),
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'			 => 'dashicons-portfolio',
			'supports'           => array( 'title', 'editor', 'author', 'excerpt' )
	);

	$consultantsargs = array(
	        'labels' => array(
					    'name' => 'Consultants',
					    'singular_name' => 'Consultant',
					    'add_new_item' => 'Add New Consultant',
					   ),
	        'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'consultants' ),
			'capability_type'    => 'post',
			'taxonomies'		 => array( 'category' ),
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'			 => 'dashicons-businessman',
			'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail' )
	);

	register_post_type( 'testimonials', $testimonialsargs );
	register_post_type( 'vacancies', $vacanciesargs );
	register_post_type( 'consultants', $consultantsargs );
}

add_filter( 'manage_vacancies_posts_columns', 'add_vacancies_column' );
add_action( 'manage_vacancies_posts_custom_column' , 'manage_vacancies_column', 10, 2 );

function add_vacancies_column($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'assignment_number' => 'Assignment No.',
        'position_status' => 'Position Status',
        'job_location' => 'Location',
        'job_client' => 'Client',
        'position_level' => 'Level',
        'position_function' => 'Function',
        'consultant' => 'Consultant',
        // 'author' => 'Consultant',
        // 'categories' => 'Categories',
        // 'featured_thumb' => 'Thumbnail',
        // 'date' => 'Date'
    );
    return $columns;
}

function manage_vacancies_column( $column, $post_id ) {
    switch ( $column ) {

    	case 'assignment_number' :
            echo get_post_meta( $post_id , 'assignment_number' , true ); 
            break;

	    case 'position_status' :
            $position_status = get_post_meta( $post_id , 'position_status' , true );
            if($position_status == 1) {
            	$position_status = 'Open';
            } else {
            	$position_status = 'Closed';
            }
            echo $position_status;
            break;
    	
    	case 'job_location' :
            echo get_post_meta( $post_id , 'job_location' , true ); 
            break;

	    case 'job_client' :
	    	$hide_job_client = get_post_meta( $post_id , 'hide_job_client' , true );
	    	if($hide_job_client ==1) {
	    		$job_client = '<span style="opacity:.35">'.get_post_meta( $post_id , 'job_client' , true ).'</span>';
	    	} else {
	    		$job_client = get_post_meta( $post_id , 'job_client' , true );
	    	}
            echo $job_client;
            break;

        case 'position_level' :
        	echo get_post_meta( $post_id , 'position_level' , true ); 
            break;

        case 'position_function' :
        	echo get_post_meta( $post_id , 'position_function' , true ); 
            break;

        case 'consultant' :
        	$post_object = get_field('consultant');
        	echo get_the_title($post_object->ID) . '<br>';
        	echo get_the_post_thumbnail( $post_object, 'admin-list-thumb' );
            break;

        // case 'featured_thumb':
        // 	$post_object = get_field('consultant');
	       //  echo get_the_post_thumbnail( $post_object, 'admin-list-thumb' );
	       //  break;
    }
}

// add the featured image thumbnail to the admin courses column
add_filter( 'manage_testimonials_posts_columns', 'add_testimonials_column' );
add_action( 'manage_testimonials_posts_custom_column' , 'manage_testimonials_column', 10, 2 );

// size the thumbnail
add_image_size( 'admin-list-thumb', 80, 80, false );

function add_testimonials_column($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'type_of_testimonial' => 'Type',
        'country' => 'Country',
        'position' => 'Position',
        'company_name' => 'Company',
        //'categories' => 'Categories',
        'featured_thumb' => 'Thumbnail',
        // 'date' => 'Date'
    );
    return $columns;
}

function manage_testimonials_column( $column, $post_id ) {
    switch ( $column ) {

	    case 'featured_thumb':
	        echo '<a href="' . get_edit_post_link() . '">';
	        echo the_post_thumbnail( 'admin-list-thumb' );
	        echo '</a>';
	        break;

        case 'type_of_testimonial' :
        	$type_of_testimonial = get_post_meta( $post_id , 'type_of_testimonial' , true );
        	$external_link_url = get_post_meta( $post_id , 'external_link_url' , true );
            if($type_of_testimonial == 'External Link') {
            	$result = $type_of_testimonial . '<br>' . $external_link_url;
            } else {
            	$result = $type_of_testimonial;
            }
            echo $result;
            break;
    	
    	case 'company_name' :
            echo get_post_meta( $post_id , 'company_name' , true ); 
            break;

	    case 'country' :
            
            $country_name = $country_path = get_post_meta( $post_id , 'country' , true );

            $country_path = strtolower(str_replace(' ', '_', $country_path));

            $country_path = '<img src="'.get_bloginfo('stylesheet_directory').'/img/flags/'.strtolower($country_path).'.png" style="width:25px;" />';
            
            if($country_name == 'null') {
            	$country_name = 'No Country Selected';
            	$country_path = '';
            }

            	echo $country_name . '<br>' . $country_path;
            break;

        case 'position' :
            echo get_post_meta( $post_id , 'position' , true ); 
            break;
    }
}

add_filter( 'manage_consultants_posts_columns', 'add_consultants_column' );
add_action( 'manage_consultants_posts_custom_column' , 'manage_consultants_column', 10, 2 );

function add_consultants_column($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'consultant_location' => 'Country',
        'job_title' => 'Position',
        'personnel_type' => 'Personnel Type',
        // 'linkedin_url' => 'LinkedIN',
        'phone_mobile' => 'Mobile',
        'consultant_email' => 'Email',
        // 'categories' => 'Categories',
        'featured_thumb' => 'Thumbnail',
        // 'date' => 'Date'
    );
    return $columns;
}

function manage_consultants_column( $column, $post_id ) {
    switch ( $column ) {

	    case 'job_title' :
            echo get_post_meta( $post_id , 'job_title' , true ); 
            break;

	    // case 'linkedin_url' :
     //        echo get_post_meta( $post_id , 'linkedin_url' , true ); 
     //        break;

        case 'personnel_type' :
            echo get_post_meta( $post_id , 'personnel_type' , true ); 
            break;

        case 'phone_mobile' :
            echo get_post_meta( $post_id , 'phone_mobile' , true ); 
            break;

        case 'consultant_email' :
            echo get_post_meta( $post_id , 'consultant_email' , true ); 
            break;

        case 'consultant_location' :
            echo get_post_meta( $post_id , 'consultant_location' , true ); 
            break;

        case 'featured_thumb':
	        echo '<a href="' . get_edit_post_link() . '">';
	        echo the_post_thumbnail( 'admin-list-thumb' );
	        echo '</a>';
	        break;
    }
}




if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}





function pagi_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}














function my_wpcf7_form_elements($html) {
$text = 'State';
$html = str_replace('---', '' . $text . '', $html);
return $html;
}
add_filter('wpcf7_form_elements', 'my_wpcf7_form_elements');

add_shortcode('drop-down-select', 'drop_down_select');
function drop_down_select($atts){
    //merge the passed attributes with defaults
    extract(
        shortcode_atts(
            array(
                'post_type'         	=> null,
                'post_status'       	=> 'publish',
                'posts_per_page'    	=> -1,
                'ignore_sticky_posts' 	=> 1,
                'field'					=> null
            ),
            $atts
        )
    );

    //now create a seperate agruments array for wp_query using the values from above(extracted variables)
    $args = array(
        'post_type'         => $post_type,
        'post_status'       => $post_status,
        'posts_per_page'    => $posts_per_page,
    );

    $output = array();
    $author = false;
    $consultant = false;

    $my_query = new WP_Query( $args );
    if( $my_query->have_posts() ) {
        
	    while ($my_query->have_posts()) : $my_query->the_post();

	    	switch($field) {
	    		
	    		case 'title':
	    		$output[] = get_the_title();
	    		$label = 'All Positions';
	    		break;

	    		case 'consultant':
	    		$post_object = get_field('consultant');
				if( $post_object ): 
					// $output[] = get_the_title($post_object->ID);
					$output[] = $post_object->ID;
	    		endif;
	    		$consultant = true;
	    		$label = 'All Consultants';
	    		break;

	    		case 'location':
	    		if($post_type == 'consultants') {
	    			$output[] = get_field('consultant_location');
	    			$label = 'All Countries';
	    		} else {
	    			$output[] = get_field('job_location');
	    			$label = 'All Locations';
	    		}
	    		break;

	    		case 'position_function':
	    		$output[] = get_field('position_function');
	    		$label = 'All Functions';
	    		break;

	    		case 'position_level':
	    		$output[] = get_field('position_level');
	    		$label = 'All Levels';
	    		break;

	    		case 'personnel_type':
	    		$output[] = get_field('personnel_type');
	    		$label = 'All Types';
	    		break;

	    	}

	    endwhile;

	    $output = array_values(array_unique(array_filter($output)));
	    asort($output);

	    $results .= '<option value="0">'.$label.'</option>';

	    foreach ($output as $key => $value) {
	    	if($author)
	    		$results .= '<option value="'.$value.'">'.get_the_author_meta('display_name', $value).'</option>';
	    	elseif($consultant)
	    		$results .= '<option value="'.$value.'">'.get_the_title($value).'</option>';
	    	else
	    		$results .= '<option value="'.$value.'">'.$value.'</option>';

	    }
         
    }
    wp_reset_query();//reset the global variable related to post loop
    
    return $results;
}

// add vacancies custom post type to query
add_action( 'pre_get_posts', 'add_cpt_to_query', 1000 );
function add_cpt_to_query( $query ) {
	if ( is_admin() ) {
        return;
    }
	if ( $query->is_archive() && is_post_type_archive('vacancies') && $query->is_main_query() ) {
	// if ( $query->is_archive() && $query->is_main_query() ) {
		$query->set( 'post_type', array( 'vacancies' ) );
	}

	if ( $query->is_archive() && is_post_type_archive('consultants') && $query->is_main_query() ) {
		$query->set('posts_per_page', -1);
		// $query->set('order', 'ASC');
		// $query->set('orderby','menu_order');
		// $query->set( 'post_type', array( 'consultants' ) );
	}
    
	return $query;
}

add_action('wp_ajax_loadmore', 'vacancies_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'vacancies_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

function vacancies_loadmore_ajax_handler(){

	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );

	if( isset( $_POST['keyword'] ) && $_POST['keyword'] ) 
		$s = $_POST['keyword'];

	$args = array(
		'paged' => $_POST['page'] + 1,
		'posts_per_page' => get_option( 'posts_per_page' ),
		'post_type' => 'vacancies',
		'post_status' => 'publish',
		's' => $s
	);

	// create $args['meta_query'] array if one of the following fields is filled
	if( isset( $_POST['location'] ) && $_POST['location'] || isset( $_POST['position'] ) && $_POST['position'] || isset( $_POST['consultant'] ) && $_POST['consultant'] || isset( $_POST['position-function'] ) && $_POST['position-function'] )
		$args['meta_query'] = array( 'relation'=>'AND' ); // AND means that all conditions of meta_query should be true
 
	
	// if only location is set
	if( isset( $_POST['location'] ) && $_POST['location'] )
		$args['meta_query'][] = array(
			'key' => 'job_location',
			'value' => urldecode($_POST['location']),
			'type' => 'text',
			'compare' => '='
		);

	// if only position is set
	if( isset( $_POST['position'] ) && $_POST['position'] )
		$args['meta_query'][] = array(
			'key' => 'position_level',
			'value' => urldecode($_POST['position']),
			'type' => 'text',
			'compare' => '='
		);

	// if only location is set
	if( isset( $_POST['consultant'] ) && $_POST['consultant'] )
		$args['meta_query'][] = array(
			'key' => 'consultant',
			'value' => urldecode($_POST['consultant']),
			'type' => 'text',
			'compare' => '='
		);
	
	// if only position function is set
	if( isset( $_POST['position-function'] ) && $_POST['position-function'] )
		$args['meta_query'][] = array(
			'key' => 'position_function',
			'value' => urldecode($_POST['position-function']),
			'type' => 'text',
			'compare' => '='
		);


	// it is always better to use WP_Query but not here
	query_posts( $args );

	if( have_posts() ) :

		// run the loop
		while( have_posts() ): the_post();

			$count++;
					
			$job_location = get_post_meta( get_the_ID() , 'job_location' , true );
			$job_client = get_post_meta( get_the_ID() , 'job_client' , true );
			$hide_job_client = get_post_meta( get_the_ID() , 'hide_job_client' , true );
			$job_client_logo = get_field('job_client_logo') ? '<img src="'.get_field('job_client_logo').'" />' : '';

			$show_job_client = $hide_job_client == 1 ? '' : $job_client;
			$position_status = $position_status == 1 ? 'Open Position' : 'This Position is Closed';
			$seperator = strlen($show_job_client) > 0 && strlen($show_job_client) > 0 ? ' - ' : '';

			$classes = join(' ', get_post_class('et_pb_post'));

			echo '<article id="post-'. get_the_ID() .'" class="'.$classes.'">

					<span class="regular-font"><h2 class="client-location">'.$show_job_client . $seperator . $job_location.'</h2></span>

					<h2 class="entry-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>
					
					<div class="the-excerpt">'.get_the_excerpt().'</div>
					
					<div class="article-post-btn-container">
						
						<div class="truncated-post">'.wp_trim_words( get_the_content(), 26 ).'</div>

						<div class="job-client-logo">'.$job_client_logo.'</div>
					
						<div class="go-to-article-btn">
							<a href="'.get_the_permalink().'"><img src="'.get_bloginfo('stylesheet_directory').'/img/arrow@2x.png"></a>
						</div>

					</div>

				</article>';

		endwhile;

	endif;

	wp_reset_postdata();

	die; // here we exit the script and even no wp_reset_query() required!
}



add_action('wp_ajax_vacanciesfilter', 'vacancies_filter_function');
add_action('wp_ajax_nopriv_vacanciesfilter', 'vacancies_filter_function');

function vacancies_filter_function(){

	if( isset( $_POST['keyword'] ) && $_POST['keyword'] ) 
		$s = $_POST['keyword'];

	$args = array(
		'posts_per_page' => get_option( 'posts_per_page' ),
		'post_type' => 'vacancies',
		'post_status' => 'publish',
		's' => $s
	);

	// create $args['meta_query'] array if one of the following fields is filled
	if( isset( $_POST['location'] ) && $_POST['location'] || isset( $_POST['position'] ) && $_POST['position'] || isset( $_POST['consultant'] ) && $_POST['consultant'] || isset( $_POST['position-function'] ) && $_POST['position-function'] )
		$args['meta_query'] = array( 'relation'=>'AND' ); // AND means that all conditions of meta_query should be true
 
	
	// if only location is set
	if( isset( $_POST['location'] ) && $_POST['location'] )
		$args['meta_query'][] = array(
			'key' => 'job_location',
			'value' => urldecode($_POST['location']),
			'type' => 'text',
			'compare' => '='
		);

	// if only position is set
	if( isset( $_POST['position'] ) && $_POST['position'] )
		$args['meta_query'][] = array(
			'key' => 'position_level',
			'value' => urldecode($_POST['position']),
			'type' => 'text',
			'compare' => '='
		);

	// if only consultant is set
	if( isset( $_POST['consultant'] ) && $_POST['consultant'] )
		$args['meta_query'][] = array(
			'key' => 'consultant',
			'value' => urldecode($_POST['consultant']),
			'type' => 'text',
			'compare' => '='
		);
	
	// if only position function is set
	if( isset( $_POST['position-function'] ) && $_POST['position-function'] )
		$args['meta_query'][] = array(
			'key' => 'position_function',
			'value' => urldecode($_POST['position-function']),
			'type' => 'text',
			'compare' => '='
		);


	query_posts( $args );

	global $wp_query;

	if( have_posts() ) :

 		// ob_start(); // start buffering because we do not need to print the posts now

		while( have_posts() ): the_post();

			$count++;
					
			$job_location = get_post_meta( get_the_ID() , 'job_location' , true );
			$job_client = get_post_meta( get_the_ID() , 'job_client' , true );
			$hide_job_client = get_post_meta( get_the_ID() , 'hide_job_client' , true );
			$job_client_logo = get_field('job_client_logo') ? '<img src="'.get_field('job_client_logo').'" />' : '';

			$show_job_client = $hide_job_client == 1 ? '' : $job_client;
			$position_status = $position_status == 1 ? 'Open Position' : 'This Position is Closed';
			$seperator = strlen($show_job_client) > 0 && strlen($show_job_client) > 0 ? ' - ' : '';

			$classes = join(' ', get_post_class('et_pb_post'));

			$content .= '<article id="post-'. get_the_ID() .'" class="'.$classes.'">

					<span class="regular-font"><h2 class="client-location">'.$show_job_client . $seperator . $job_location.'</h2></span>

					<h2 class="entry-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>
					
					<div class="the-excerpt">'.get_the_excerpt().'</div>
					
					<div class="article-post-btn-container">
						
						<div class="truncated-post">'.wp_trim_words( get_the_content(), 26 ).'</div>

						<div class="job-client-logo">'.$job_client_logo.'</div>
					
						<div class="go-to-article-btn">
							<a href="'.get_the_permalink().'"><img src="'.get_bloginfo('stylesheet_directory').'/img/arrow@2x.png"></a>
						</div>

					</div>

				</article>';

		endwhile;

 		// $content = ob_get_contents(); // we pass the posts to variable
   		// ob_end_clean(); // clear the buffer

	endif;

	// no wp_reset_query() required

 	echo json_encode( array(
		'posts' => serialize( $wp_query->query_vars ),
		'max_page' => $wp_query->max_num_pages,
		'found_posts' => $wp_query->found_posts,
		'content' => $content
	) );

	die();
}

add_action('wp_ajax_consultantsfilter', 'consultants_filter_function');
add_action('wp_ajax_nopriv_consultantsfilter', 'consultants_filter_function');

function consultants_filter_function(){

	$args = array(
		'orderby' => 'menu_order',
		'order'	=> 'ASC', // ASC или DESC,
		'posts_per_page' => -1,
		'post_type' => 'consultants',
		'post_status' => 'publish'
	);

	// create $args['meta_query'] array if one of the following fields is filled
	if( isset( $_POST['location'] ) && $_POST['location'] || isset( $_POST['personnel-type'] ) && $_POST['personnel-type'] )
		$args['meta_query'] = array( 'relation'=>'AND' ); // AND means that all conditions of meta_query should be true

	// if only location is set
	if( isset( $_POST['location'] ) && $_POST['location'] )
		$args['meta_query'][] = array(
			'key' => 'consultant_location',
			'value' => urldecode($_POST['location']),
			'type' => 'text',
			'compare' => '='
		);

	// if only location is set
	if( isset( $_POST['personnel-type'] ) && $_POST['personnel-type'] )
		$args['meta_query'][] = array(
			'key' => 'personnel_type',
			'value' => urldecode($_POST['personnel-type']),
			'type' => 'text',
			'compare' => '='
		);


	query_posts( $args );

	global $wp_query;

	if( have_posts() ) :

 		// ob_start(); // start buffering because we do not need to print the posts now

		while( have_posts() ): the_post();

			$classes = join(' ', get_post_class('et_pb_post'));

			$content .= '<article id="post-'. get_the_ID() .'" class="'.$classes.'">

							<div class="content-wrapper">

								<div class="consultant-profile-image"><a href="'.get_the_permalink().'">'.get_the_post_thumbnail( $post_id, 'full').'</a></div>

								<div class="entry-title consultant-name"><a href="'.get_the_permalink().'">'.get_the_title().'</a></div>

								<div class="consultant-title">'.get_field('job_title').'</div>';
						
								if ( has_excerpt( get_the_ID() ) ) 
									$content .= '<div class="the-excerpt">'.get_the_excerpt().'</div>';

			$content .= 	'</div>

						</article>';

		endwhile;

 		// $content = ob_get_contents(); // we pass the posts to variable
   		// ob_end_clean(); // clear the buffer

	endif;

	// no wp_reset_query() required

 	echo json_encode( array(
		'posts' => serialize( $wp_query->query_vars ),
		'max_page' => $wp_query->max_num_pages,
		'found_posts' => $wp_query->found_posts,
		'content' => $content
	) );

	die();
}

/*
* Extend the admin search functionality for Vacancies *
*/
add_filter( 'posts_join', 'vacancies_search_join' );
function vacancies_search_join ( $join ) {
    global $pagenow, $wpdb;

    // I want the filter only when performing a search on edit page of Custom Post Type named "vacancies".
    if ( is_admin() && 'edit.php' === $pagenow && 'vacancies' === $_GET['post_type'] && ! empty( $_GET['s'] ) ) {    
        $join .= 'LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    return $join;
}

add_filter( 'posts_where', 'vacancies_search_where' );
function vacancies_search_where( $where ) {
    global $pagenow, $wpdb;

    // I want the filter only when performing a search on edit page of Custom Post Type named "vacancies".
    if ( is_admin() && 'edit.php' === $pagenow && 'vacancies' === $_GET['post_type'] && ! empty( $_GET['s'] ) ) {
        $where = preg_replace(
            "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where );
    }
    return $where;
}
function vacancies_search_distinct( $where ){
    global $pagenow, $wpdb;

    if ( is_admin() && $pagenow=='edit.php' && $_GET['post_type']=='vacancies' && $_GET['s'] != '') {
    return "DISTINCT";

    }
    return $where;
}
add_filter( 'posts_distinct', 'vacancies_search_distinct' );
/*-------------------------------------
  Move Yoast to the Bottom
---------------------------------------*/
function yoasttobottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');
?>