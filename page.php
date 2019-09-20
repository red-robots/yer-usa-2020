<?php
/**
 * Default Template
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


				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-676" class="post-676 page type-page status-publish hentry">
						<div class="entry-content">
							<div id="et-boc" class="et-boc">
								<div class="et_builder_inner_content et_pb_gutters3">
									<div class="et_pb_section et_pb_section_6 et_section_regular">
										<div class="et_pb_row et_pb_row_10">
											<div class="et_pb_column et_pb_column_4_4 et_pb_column_22  et_pb_css_mix_blend_mode_passthrough et-last-child">
												<div class="et_pb_module et_pb_text et_pb_text_12 et_pb_bg_layout_light  et_pb_text_align_left">
													<div class="et_pb_text_inner">
														<h1><?php the_title(); ?></h1>
														<?php the_content(); ?>
													</div>
												</div> <!-- .et_pb_text -->
											</div> <!-- .et_pb_column -->
										</div> <!-- .et_pb_row -->
									</div> <!-- .et_pb_section -->
								</div>
							</div>
						</div> <!-- .entry-content -->
					</article> <!-- .et_pb_post -->

				<?php endwhile; // End of the loop.?>

				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
