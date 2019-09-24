<?php
/**
 * Template Name: Careers
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 



//include( locate_template( 'inc/banner.php', false, false ) );
?>

<!-- Careers -->
	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">
		<div id="et-main-area">
			<div id="main-content">


			<?php
			while ( have_posts() ) : the_post();

				$personImg = get_field('person_photo');
				$personQuote = get_field('person_quote');
				$link = get_field('consultant_link');

			endwhile; // End of the loop.

			?>


			<article id="post-1350" class="post-1350 page type-page status-publish hentry">
				<div class="entry-content">
					<div id="et-boc" class="et-boc">
						<div class="et_builder_inner_content et_pb_gutters3">
							<div class="et_pb_section et_pb_section_6 hero-wrapper et_pb_with_background et_section_regular">
								<div class="et_pb_row et_pb_row_10">
									<div class="et_pb_column et_pb_column_4_4 et_pb_column_22  et_pb_css_mix_blend_mode_passthrough et-last-child">
										<div class="et_pb_module et_pb_text et_pb_text_12 et_pb_bg_layout_light  et_pb_text_align_center">
											<div class="et_pb_text_inner"><h1><?php the_title(); ?></h1></div>
										</div> <!-- .et_pb_text -->
									</div> <!-- .et_pb_column -->
								</div> <!-- .et_pb_row -->
							</div> <!-- .et_pb_section -->
							<div class="et_pb_section et_pb_section_7 et_pb_with_background et_section_regular">
								<div class="et_pb_row et_pb_row_11 et_pb_row_fullwidth et_pb_equal_columns">
									<div class="et_pb_column et_pb_column_1_2 et_pb_column_23  et_pb_css_mix_blend_mode_passthrough">
										<div class="et_pb_module et_pb_image et_pb_image_3">
											<span class="et_pb_image_wrap "></span>
										</div>
										<div class="et_pb_module et_pb_image et_pb_image_4">
											<a href="<?php echo $link; ?>" target="_blank">
												<span class="et_pb_image_wrap ">
													<img src="<?php echo $personImg['url']; ?>" alt="<?php echo $personImg['alt']; ?>" />
												</span>
											</a>
										</div>
									</div> <!-- .et_pb_column -->
									<div class="et_pb_column et_pb_column_1_2 et_pb_column_24  et_pb_css_mix_blend_mode_passthrough et-last-child">
										<div class="et_pb_module et_pb_text et_pb_text_13 et_pb_bg_layout_light  et_pb_text_align_center">
											<div class="et_pb_text_inner">
											<?php echo $personQuote; ?>
											</div>
										</div> <!-- .et_pb_text -->
									</div> <!-- .et_pb_column -->
								</div> <!-- .et_pb_row -->
							</div> <!-- .et_pb_section -->
							<div class="et_pb_section et_pb_section_8 et_section_regular">
								<div class="et_pb_row et_pb_row_12">
									<div class="et_pb_column et_pb_column_4_4 et_pb_column_25  et_pb_css_mix_blend_mode_passthrough et-last-child">
										<div class="et_pb_module et_pb_text et_pb_text_14 et_pb_bg_layout_light  et_pb_text_align_left">
											<div class="et_pb_text_inner">
												<h2>Join Our Team</h2>
											</div>
										</div> <!-- .et_pb_text -->
										<div class="et_pb_module et_pb_code et_pb_code_4 vacancies-archive">
											<div class="et_pb_code_inner">
												<?php echo do_shortcode('[latest-vacancies num-posts="-1" layout="full" client="YER-USA"]'); ?>
											</div>
										</div> <!-- .et_pb_code -->
									</div> <!-- .et_pb_column -->
								</div> <!-- .et_pb_row -->
							</div> <!-- .et_pb_section -->			
						</div>
					</div>					
				</div> <!-- .entry-content -->
			</article> <!-- .et_pb_post -->


			
			</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
