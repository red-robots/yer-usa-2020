<?php
/**
 * Template Name: Contact
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



				<?php endwhile; // End of the loop.?>

				<article id="post-691" class="post-691 page type-page status-publish hentry">
					<div class="entry-content">
						<div id="et-boc" class="et-boc">
							<div class="et_builder_inner_content et_pb_gutters3">
								<div class="et_pb_section et_pb_section_6 hero-wrapper et_pb_with_background et_section_regular">
									<div class="et_pb_row et_pb_row_10">
										<div class="et_pb_column et_pb_column_4_4 et_pb_column_22  et_pb_css_mix_blend_mode_passthrough et-last-child">
											<div class="et_pb_module et_pb_text et_pb_text_12 et_pb_bg_layout_light  et_pb_text_align_left">
												<div class="et_pb_text_inner">
													<h1><?php the_title(); ?></h1>
												</div>
											</div> <!-- .et_pb_text -->
										</div> <!-- .et_pb_column -->
									</div> <!-- .et_pb_row -->
								</div> <!-- .et_pb_section -->
								<div class="et_pb_section et_pb_section_7 et_section_regular">
									<div class="et_pb_row et_pb_row_11 et_pb_row_fullwidth et_pb_gutters1 et_pb_row_1-4_3-4">
										<div class="et_pb_column et_pb_column_1_4 et_pb_column_23  et_pb_css_mix_blend_mode_passthrough">
										<?php if(have_rows('addresses')) : 
										$count = count(get_field('addresses'));
										$row=1;
										?>
											<?php while(have_rows('addresses')) : the_row(); 

												$city = get_sub_field('city');
												$add1 = get_sub_field('address_line_1');
												$add2 = get_sub_field('address_line_2');
												$mapIt = get_sub_field('map_it_link');
												$phone = get_sub_field('phone');
												$email = antispambot( get_sub_field('email') );
											?>
											<div class="et_pb_module et_pb_text et_pb_text_13 regular-font et_pb_bg_layout_light  et_pb_text_align_left">
												<div class="et_pb_text_inner">
													<?php if($city) { ?><h2><?php echo $city; ?></h2><?php } ?>
														<p>
														<?php if($add1) { ?><?php echo $add1; ?><?php } ?>
														<?php if($add2) { ?><br /><?php echo $add2; ?><?php } ?>
														<?php if($mapIt) { ?><br /><a href="<?php echo $city; ?>" target="_blank" rel="noopener noreferrer">Map It</a><?php } ?>
														<br />&#8211;
														<?php if($phone) { ?><br /><?php echo $phone; ?><?php } ?>
														<?php if($email) { ?>
															<br /><a href="<?php echo $email; ?>"><?php echo $email; ?></a>
														<?php } ?>
													</p>
												</div>
											</div> <!-- .et_pb_text -->
											<?php if( $row !== $count ) { ?>
											<div class="et_pb_module et_pb_divider et_pb_divider_1 et_pb_divider_position_ et_pb_space">
												<div class="et_pb_divider_internal">
												</div>
											</div>
											<?php } ?>
											<?php $row++; endwhile; ?>
										<?php endif; ?>

											
										</div> <!-- .et_pb_column -->
										<div class="et_pb_column et_pb_column_3_4 et_pb_column_24  et_pb_css_mix_blend_mode_passthrough et-last-child">
											<div class="et_pb_module et_pb_text et_pb_text_17 et_pb_bg_layout_light  et_pb_text_align_center">
												<div class="et_pb_text_inner">
													<h2><?php the_field('form_title'); ?></h2>
												</div>
											</div> <!-- .et_pb_text -->
											<div id="contact-us-form" class="et_pb_module et_pb_code et_pb_code_4 contact-form">
												<div class="et_pb_code_inner">
													<?php echo do_shortcode('[contact-form-7 id="1340" title="Contact Us"]'); ?>
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
get_sidebar();
get_footer();
