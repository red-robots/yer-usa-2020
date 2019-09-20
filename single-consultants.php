<?php

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

$name = explode(' ', get_the_title());
$linkedInUrl = get_post_meta( get_the_ID() , 'linkedin_url' , true );

$phone_mobile = get_post_meta( get_the_ID() , 'phone_mobile' , true );
$phone_land = get_post_meta( get_the_ID() , 'phone_land' , true );
$consultant_email = get_post_meta( get_the_ID() , 'consultant_email' , true );
$show_consultant_meta = false;

if($phone_mobile || $phone_land || $consultant_email)
	$show_consultant_meta = true;

?>

<div id="main-content" class="single-consultant">
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
		<span class="regular-font"><h4 class="consultant-location"><?php echo get_post_meta( get_the_ID() , 'consultant_location' , true ); ?></h4></span>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <span class="regular-font"><h2 class="job-title"><?php echo get_post_meta( get_the_ID() , 'job_title' , true ); ?></h2></span>
	</div>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (et_get_option('divi_integration_single_top') <> '' && et_get_option('divi_integrate_singletop_enable') == 'on') echo(et_get_option('divi_integration_single_top')); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
					
					<h2 class="consultant-heading about">About <?php echo $name[0]; ?></h2>
					
					<div class="entry-content regular-font">
					<?php
						do_action( 'et_before_content' );

						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->
					
					<?php if($show_consultant_meta) : ?>
						<h2 class="consultant-heading contact">Contact</h2>
						
						<div class="consultant-contact-info">
							<div class="cci"><span class="label">M</span> <span class="cci-val"><?php echo get_post_meta( get_the_ID() , 'phone_mobile' , true ); ?></span></div>
							<div class="cci"><span class="label">T</span> <span class="cci-val"><?php echo get_post_meta( get_the_ID() , 'phone_land' , true ); ?></span></div>
							<div class="cci"><span class="label">E</span> <span class="cci-val"><a href="mailto:<?php echo $consultant_email; ?>"><?php echo $consultant_email; ?></a></span></div>
						</div>
					<?php endif; ?>
					
					<?php if($linkedInUrl) : ?>
						<div class="add-flex flex-vert-align connect">
							
							<div class="flex-container-1">
							
								<h2 class="consultant-heading">Connect</h2>
							
							</div>
							
							<div class="flex-container-2">
								<a target="_blank" href="<?php echo $linkedInUrl; ?>">
								<img src="/wp-content/themes/divi-child/img/icons/linkedin.png">
								</a>
							</div>

						</div>
						<div class="linkedin-widget-container">
							<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
							<script type="IN/MemberProfile" data-id="<?php echo $linkedInUrl; ?>" data-format="inline" data-related="false"></script>
						</div>
					<?php endif; ?>
					
				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>
			</div> <!-- #left-area -->

			<?php //get_sidebar(); ?>
			<div id="sidebar">
				<?php echo get_the_post_thumbnail(); ?>
			</div>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
	<?php endif; ?>
</div> <!-- #main-content -->

<?php

get_footer();
