<?php 
/**
 * Template Name: Blog
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */
get_header(); 

// $is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

// if(get_query_var('s') !== '') {
	
// }

// var_dump( get_query_var( 's' ) );
$thumb = get_the_post_thumbnail_url();
$tagline = get_field('tagline');
$secondary_tagline = '';




if( !$tagline ) {
	$tagline=get_the_title();
	} ?>
<div class="banner hero-wrapper" style="background-image: url(<?php echo $thumb; ?>);">

<div class="et_pb_row et_pb_row_10">
<div class="et_pb_column et_pb_column_4_4 et_pb_column_22  et_pb_css_mix_blend_mode_passthrough et-last-child">
<div class="et_pb_module et_pb_text et_pb_text_12 et_pb_bg_layout_light  et_pb_text_align_center">

	<div class="et_pb_text_inner">
		<h1><?php the_title(); ?></h1>
	</div>


	<div class="et_pb_module et_pb_text et_pb_text_13 condensed et_pb_bg_layout_light  et_pb_text_align_center">
		<div class="et_pb_text_inner tagline">
			<?php //echo $tagline; ?>
		</div>
		
		<?php if($secondary_tagline) { ?>
		<div class="et_pb_module et_pb_text et_pb_text_14 condensed et_pb_bg_layout_light  et_pb_text_align_center">
			<div class="tagline-sec et_pb_text_inner"><?php echo $secondary_tagline; ?></div>
		</div>
		<?php } ?>
	</div>

	</div></div></div>
</div>

<div id="main-content" class="vacancies-archive">

	<!-- <div class="hero-wrapper" style="background-image: url('<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url(11, 'full'); ?>');">
		<h1 class="entry-title">Vacancies</h1>
	</div> -->

	
	
	<div class="container">
		<div id="content-area" class="clearfix regular-font">
			<div id="left-area">

				<?php

					$wp_query = new WP_Query();
					$wp_query->query(array(
						'post_type'=>'post',
						'posts_per_page' => 10,
						'paged' => $paged
					));

					if( $wp_query->have_posts() ) :
				?>
				
				<div id="main-posts" class="ajax_posts flexwrap">
					
					<?php
						$count = 0; 
						while( $wp_query->have_posts() ) : $wp_query->the_post();

							$count++;
							$thumbz = get_the_post_thumbnail_url();
							// $post_format = et_pb_post_format(); 
							// $job_location = get_post_meta( get_the_ID() , 'job_location' , true );
							// $job_client = get_post_meta( get_the_ID() , 'job_client' , true );
							// $hide_job_client = get_post_meta( get_the_ID() , 'hide_job_client' , true );
							// $job_client_logo = get_field('job_client_logo') ? '<img src="'.get_field('job_client_logo').'" />' : '';
							
							// $show_job_client = $hide_job_client == 1 ? '' : $job_client;
							// $position_status = $position_status == 1 ? 'Open Position' : 'This Position is Closed';
							// $seperator = strlen($show_job_client) > 0 && strlen($show_job_client) > 0 ? ' - ' : '';

							?>

							<article id="post-<?php the_ID(); ?>" class="blog" >

								<?php if($thumbz){ ?>
										<div class="thumb">
											<img src="<?php echo $thumbz; ?>">
										</div>
									<?php } ?>
								<div class="info">
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								
								<div class="the-excerpt"><?php the_excerpt(); ?></div>
								
								<div class="article-post-btn-container">
									
									<!--<div class="truncated-post">
										<?php
											// et_divi_post_meta();
											truncate_post( 170 );	
										?>
									</div>  .truncated-post -->
									
									

									

								</div> <!-- .article-post-btn-container -->
								</div>
								<div class="btn">
										<a href="<?php the_permalink(); ?>">Read More</a>
									</div>
							</article> <!-- .et_pb_post -->
					<?php
						endwhile;

						wp_reset_postdata();
					?>
					
				</div>

				<?php
				pagi_posts_nav();
				// don't display the button if there are not enough posts
				// if (  $wp_query->max_num_pages > 1 ) :
				// 	echo '<div id="blog_loadmore" class="yer-btn">Load More Posts</div>'; // you can use <a> as well
				// endif;

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
