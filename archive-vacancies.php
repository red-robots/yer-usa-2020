<?php 

get_header(); 

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

// if(get_query_var('s') !== '') {
	
// }

// var_dump( get_query_var( 's' ) );

?>

<div id="main-content" class="vacancies-archive">

	<div class="hero-wrapper" style="background-image: url('<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url(11, 'full'); ?>');">
		<h1 class="entry-title">Vacancies</h1>
		<!-- <span class="regular-font"><p class=""><?php the_field('hero_subtitle'); ?></p></span> -->
	</div>

	<div id="vacancies-filter-bar">
		<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="vacancies-filters">
			
			<div id="vfb-search-form">
				<label for="keyword">Search:</label>
				<input type="text" name="keyword" id="keyword" class="noEnterSubmit" placeholder="Search Keyword" value="">
			</div>
			
			<div id="vfb-position" class="styled-select">
				<label for="position">Position Level:</label>
				<span class="wrapper dwn-arrow">
					<select name="position" id="vposition" class="vacancies-select"><?php echo do_shortcode('[drop-down-select post_type="vacancies" field="position_level"]');?></select>
				</span>
			</div>
			
			<div id="vfb-position" class="styled-select">
				<label for="position-function">Position Function:</label>
				<span class="wrapper dwn-arrow">
					<select name="position-function" id="vposition-function" class="vacancies-select"><?php echo do_shortcode('[drop-down-select post_type="vacancies" field="position_function"]');?></select>
				</span>
			</div>
			
			<div id="vfb-location" class="styled-select">
				<label for="location">Location:</label>
				<span class="wrapper dwn-arrow">
					<select name="location" id="vlocation" class="vacancies-select"><?php echo do_shortcode('[drop-down-select post_type="vacancies" field="location"]');?></select>
				</span>
			</div>

			<div id="vfb-consultant" class="styled-select">
				<label for="consultant">Consultant:</label>
				<span class="wrapper dwn-arrow">
					<select name="consultant" id="vconsultant" class="vacancies-select"><?php echo do_shortcode('[drop-down-select post_type="vacancies" field="consultant"]');?></select>
				</span>
			</div>
			
			<input type="hidden" name="action" value="vacanciesfilter">

		</form>
	</div>
	
	<div class="container">
		<div id="content-area" class="clearfix regular-font">
			<div id="left-area">

				<?php

					$args = array_merge( $wp_query->query_vars, array( 'posts_per_page' => get_option( 'posts_per_page' ), 'order' => 'ASC', 'orderby' => 'menu_order' ) );
					query_posts( $args );

					if ( have_posts() ) :
				?>
				
				<div id="main-posts" class="ajax_posts">
					
					<?php
						$count = 0; //set up counter variable
						while ( have_posts() ) : the_post();

							$count++;
							
							$post_format = et_pb_post_format(); 
							$job_location = get_post_meta( get_the_ID() , 'job_location' , true );
							$job_client = get_post_meta( get_the_ID() , 'job_client' , true );
							$hide_job_client = get_post_meta( get_the_ID() , 'hide_job_client' , true );
							$job_client_logo = get_field('job_client_logo') ? '<img src="'.get_field('job_client_logo').'" />' : '';
							
							$show_job_client = $hide_job_client == 1 ? '' : $job_client;
							$position_status = $position_status == 1 ? 'Open Position' : 'This Position is Closed';
							$seperator = strlen($show_job_client) > 0 && strlen($show_job_client) > 0 ? ' - ' : '';

							?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>

								<span class="regular-font"><h2 class="client-location"><?php print $show_job_client . $seperator . $job_location; ?></h2></span>

								<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								
								<div class="the-excerpt"><?php the_excerpt(); ?></div>
								
								<div class="article-post-btn-container">
									
									<div class="truncated-post">
										<?php
											// et_divi_post_meta();
											truncate_post( 170 );	
										?>
									</div> <!-- .truncated-post -->
									
									<div class="job-client-logo">
										<?php echo $job_client_logo; ?>
									</div>
									
									<div class="go-to-article-btn">
										<a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/arrow@2x.png"></a>
									</div>

								</div> <!-- .article-post-btn-container -->

							</article> <!-- .et_pb_post -->
					<?php
						endwhile;

						wp_reset_postdata();
					?>
					
				</div>

				<?php

				// don't display the button if there are not enough posts
				if (  $wp_query->max_num_pages > 1 ) :
					echo '<div id="vacancies_loadmore" class="yer-btn">Load More Positions</div>'; // you can use <a> as well
				endif;

			else:

				echo 'No results';

			endif;
			?>
			
			</div> <!-- #left-area -->

			<div id="sidebar"></div>
			
		</div> <!-- #content-area -->
	
	</div> <!-- .container -->

</div> <!-- #main-content -->

<?php

get_footer();
