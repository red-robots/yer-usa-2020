<?php 

get_header(); 

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content" class="consultants-archive">

	<div class="hero-wrapper" style="background-image: url('<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url(12, 'full'); ?>');">
		<h1 class="entry-title">Our Team</h1>
		<!-- <span class="regular-font"><p class=""><?php the_field('hero_subtitle'); ?></p></span> -->
	</div>

	<div id="consultants-filter-bar">
		<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="consultants-filters">
			
			<div id="cfb-position" class="styled-select">
				<label for="location">Country:</label>
				<span class="wrapper dwn-arrow">
					<select id="consultants-locations" name="location" class="consultants-select"><?php echo do_shortcode('[drop-down-select post_type="consultants" field="location"]');?></select>
				</span>
			</div>

			<div id="cfb-personnel-type" class="styled-select">
				<label for="personnel-type">Function:</label>
				<span class="wrapper dwn-arrow">
					<select id="vpersonnel-type" name="personnel-type" class="consultants-select"><?php echo do_shortcode('[drop-down-select post_type="consultants" field="personnel_type"]');?></select>
				</span>
			</div>
			
			<input type="hidden" name="action" value="consultantsfilter">
		
		</form>
	</div>
	
	<div class="container">
		<div id="content-area" class="clearfix regular-font">
			<div id="left-area">

				<?php

					$args = array_merge( $wp_query->query_vars, array() );
					query_posts( $args );

					if ( have_posts() ) :
				?>
				
				<div id="main-posts" class="ajax_posts">
					
					<?php
						
						while ( have_posts() ) : the_post();

							?>
				
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
								
								<div class="content-wrapper">
								
									<div class="consultant-profile-image">
										<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $post_id, 'full'); ?></a>
									</div>

									<div class="entry-title consultant-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
									<div class="consultant-title"><?php echo get_field('job_title'); ?></div>
									<?php if ( has_excerpt( $post->ID ) ) : ?>
										<div class="the-excerpt"><?php the_excerpt(); ?></div>
									<?php endif; ?>

								</div>
						
							</article> <!-- .et_pb_post -->
					<?php
						endwhile;

						wp_reset_postdata();
					?>
					
				</div>

				<?php

			else:

				echo 'No results';

			endif;
			?>
			
			</div> <!-- #left-area -->

			<!-- <div id="sidebar"></div> -->
			
		</div> <!-- #content-area -->
	
	</div> <!-- .container -->

</div> <!-- #main-content -->

<?php

get_footer();
