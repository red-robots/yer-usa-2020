<?php

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

$position_status = get_post_meta( get_the_ID() , 'position_status' , true );
$job_location = get_post_meta( get_the_ID() , 'job_location' , true );
$job_client = get_post_meta( get_the_ID() , 'job_client' , true );
$hide_job_client = get_post_meta( get_the_ID() , 'hide_job_client' , true );
$assignment_number = get_post_meta( get_the_ID() , 'assignment_number' , true );

$show_job_client = $hide_job_client == 1 ? '' : $job_client;
$position_status = $position_status == 1 ? 'Open Position' : 'This Position is Closed';
$seperator = strlen($show_job_client) > 0 && strlen($show_job_client) > 0 ? ' - ' : '';

$post_object = get_field('consultant');
if( $post_object ): 
	// override $post
	$post = $post_object;
	setup_postdata( $post ); 
// var_dump($post);
$consultant_display_name = get_the_title(); //get_the_author_meta( 'display_name' );
$consultant_email = get_field('consultant_email'); //get_the_author_meta( 'user_email' );
$consultant_gravatar = get_the_post_thumbnail( $post_object, 'full' ); //get_avatar( get_the_author_meta('ID') , 512);
$consultant_linkedin = get_field('linkedin_url'); //get_the_author_meta( 'linkedin' );
$consultant_title = get_field('job_title'); //get_the_author_meta( 'job_title' );
$consultant_mobile = get_field('phone_mobile'); //get_the_author_meta( 'user_mobile' );
$consultant_phone = get_field('phone_land'); //get_the_author_meta( 'user_phone' );
$consultant_url = get_permalink($postobject->ID); //get_author_posts_url( get_the_author_meta('ID') );
wp_reset_postdata();
endif;

// if( !empty($linkedin) ) {
// 	$social .= '<span class="et-social-icon et-social-linkedin"><a href="'.$linkedin.'" class="icon"><span>LinkedIn</span></a></span>'; 
// }

?>

<div id="main-content" class="single-vacancies">
	<?php
		if ( et_builder_is_product_tour_enabled() ):
			// load fullwidth page in Product Tour mode
			while ( have_posts() ): the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
					<?php
						the_content();
					?>
					</div> <!-- .entry-content -->

				</article> <!-- .et_pb_post -->

		<?php endwhile;
		else:
	?>
	<div class="hero-wrapper" style="background-image: url('<?php echo $thumb; ?>');">
		<span class="regular-font"><h4 class="position-status"><?php print $position_status; ?></h4></span>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <span class="regular-font"><h2 class="client-location"><?php print $show_job_client . $seperator . $job_location; ?></h2></span>
	</div>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (et_get_option('divi_integration_single_top') <> '' && et_get_option('divi_integrate_singletop_enable') == 'on') echo(et_get_option('divi_integration_single_top')); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
					
					<div class="entry-content regular-font">
					<?php
						do_action( 'et_before_content' );

						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->
					<div class="et_post_meta_wrapper">
					<?php
					if ( et_get_option('divi_468_enable') == 'on' ){
						echo '<div class="et-single-post-ad">';
						if ( et_get_option('divi_468_adsense') <> '' ) echo( et_get_option('divi_468_adsense') );
						else { ?>
							<a href="<?php echo esc_url(et_get_option('divi_468_url')); ?>"><img src="<?php echo esc_attr(et_get_option('divi_468_image')); ?>" alt="468" class="foursixeight" /></a>
				<?php 	}
						echo '</div> <!-- .et-single-post-ad -->';
					}
				?>

					<?php if (et_get_option('divi_integration_single_bottom') <> '' && et_get_option('divi_integrate_singlebottom_enable') == 'on') echo(et_get_option('divi_integration_single_bottom')); ?>

					<?php
						if ( ( comments_open() || get_comments_number() ) && 'on' == et_get_option( 'divi_show_postcomments', 'on' ) ) {
							comments_template( '', true );
						}
					?>
					</div> <!-- .et_post_meta_wrapper -->
				</article> <!-- .et_pb_post -->

				<a href="#" class="apply-link">Apply Now</a>
				
				<div id="position-apply-form" class="apply-form" 
					data-assignment-number="<?php echo $assignment_number; ?>" 
					data-consultant-email="<?php echo $consultant_email; ?>" 
					data-consultant-name="<?php echo $consultant_display_name; ?>" 
					data-job-title="<?php echo get_the_title(); ?>" 
					data-job-client="<?php echo $job_client; ?>"
					style="display: none;">
						<?php echo do_shortcode('[contact-form-7 id="1136" title="Apply For This Position"]'); ?> <a href="#" class="close-position-apply-form">Never Mind</a>
				</div>

			<?php endwhile; ?>
			</div> <!-- #left-area -->

			<?php //get_sidebar(); ?>
			<div id="sidebar">
				<h2 class="share-title hide-on-submit">Share This Position</h2>
				<div class="share-container hide-on-submit"><?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?></div>
				<h2 class="consultant-title hide-on-submit">Meet Your Consultant</h2>
				<div class="consultant-container">
					<div class="consultant-profile-img"><?php echo $consultant_gravatar; ?></div>
					<div class="consultant-name"><?php echo $consultant_display_name; ?></div>
					<div class="consultant-title"><?php echo $consultant_title; ?></div>
					<div class="consultant-contact-info">
						<div class="cci"><span class="label">M</span> <span class="cci-val"><?php echo $consultant_mobile; ?></span></div>
						<div class="cci"><span class="label">T</span> <span class="cci-val"><?php echo $consultant_phone; ?></span></div>
						<div class="cci"><span class="label">E</span> <span class="cci-val"><?php echo $consultant_email; ?></span></div>
					</div>
					<a href="<?php echo $consultant_url; ?>" class="btn yer-btn hide-on-submit">View Profile</a>
				</div>
			</div>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
	<?php endif; ?>
</div> <!-- #main-content -->

<?php

get_footer();
