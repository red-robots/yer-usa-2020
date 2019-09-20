<?php
/**
 * Front Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */
get_header(); 
?>

<div id="et-main-area">
<div id="main-content">
<article id="post-11" class="post-11 page type-page status-publish hentry">
<div class="entry-content">
<div id="et-boc" class="et-boc">
<div class="et_builder_inner_content et_pb_gutters3">
<div class="et_pb_section et_pb_section_6 home-page-content-containers et_section_regular">
<div class="et_pb_row et_pb_row_10 et_pb_row_fullwidth et_pb_gutters1">
<div class="et_pb_column et_pb_column_4_4 et_pb_column_22  et_pb_css_mix_blend_mode_passthrough et-last-child">
<div class="et_pb_module et_pb_code et_pb_code_12  et_pb_text_align_center">
<div class="et_pb_code_inner">
<?php
	$wp_query = new WP_Query();
	$wp_query->query(array(
		'post_type'=>'page',
		'pagename' => 'hire-top-talent'
	));
	if ($wp_query->have_posts()) : ?>
    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); 

    $secTwoTitle = get_field('section_title_2');
    $secTwoDesc = get_field('section_desc_2');
    $secTwoLink = get_field('section_link_2');
    $secThreeTitle = get_field('section_title_3');
    $secThreeLink = get_field('section_link_3');



    ?>	

	<div id="hire-top-talent-container" class="content-containers active">
		<div data-post-id='1032' class='insert-page insert-page-1032 '>
			<div id="et-boc" class="et-boc">
				<div class="et_builder_inner_content et_pb_gutters3">
					<div class="et_pb_section et_pb_section_7 et_section_regular">
						<div class="et_pb_row et_pb_row_11 et_pb_row_fullwidth et_pb_gutters1">
							<div class="et_pb_column et_pb_column_4_4 et_pb_column_23  et_pb_css_mix_blend_mode_passthrough et-last-child">
								<div class="et_pb_module et_pb_code et_pb_code_5">
									<div class="et_pb_code_inner">
										<?php 
										get_template_part('inc/slider');
										//echo do_shortcode('[rev_slider alias="hire-top-talent-hero-slider"]');
										//get_template_part('inc/rev-slider-home'); ?>
									</div><!-- not sure if i need this -->
								</div> <!-- .et_pb_code -->
							</div> <!-- .et_pb_column -->
						</div> <!-- .et_pb_row -->
					</div> <!-- .et_pb_section -->
					<div id="home-page-get-started-section" class="et_pb_section et_pb_section_8 et_section_regular">
						<div class="et_pb_row et_pb_row_12">
							<div class="et_pb_column et_pb_column_4_4 et_pb_column_24  et_pb_css_mix_blend_mode_passthrough et-last-child">
								<div class="et_pb_module et_pb_text et_pb_text_12 et_pb_bg_layout_light  et_pb_text_align_center">
									<div class="et_pb_text_inner">
										<h2><?php echo $secTwoTitle; ?></h2>
									</div>
								</div> <!-- .et_pb_text -->
								<div class="et_pb_module et_pb_divider et_pb_divider_1 et_pb_divider_position_ et_pb_space">
									<div class="et_pb_divider_internal"></div>
								</div>
								<div class="et_pb_module et_pb_text et_pb_text_13 et_pb_bg_layout_light  et_pb_text_align_center">
									<div class="et_pb_text_inner">
										<p><?php echo $secTwoDesc; ?></p>
									</div>
								</div> <!-- .et_pb_text -->
								<div class="et_pb_button_module_wrapper et_pb_button_6_wrapper et_pb_button_alignment_center et_pb_module ">
									<a id="#hire-top-talent-contact-form" class="et_pb_button et_pb_button_6 anchor et_hover_enabled et_pb_bg_layout_light" href="<?php echo $secTwoLink; ?>">Get Started</a>
								</div>
							</div> <!-- .et_pb_column -->
						</div> <!-- .et_pb_row -->
					</div> <!-- .et_pb_section -->

					<?php //get_template_part('inc/map-slider'); ?>

					<div class="et_pb_section et_pb_section_10 et_section_regular grey-section">
						<div class="et_pb_row et_pb_row_14">
							<div class="et_pb_column et_pb_column_4_4 et_pb_column_27  et_pb_css_mix_blend_mode_passthrough et-last-child">
								<div class="et_pb_module et_pb_text et_pb_text_16 et_pb_bg_layout_light  et_pb_text_align_center">
									<div class="et_pb_text_inner">
										<h2><?php echo $secThreeTitle; ?></h2>
									</div>
								</div> <!-- .et_pb_text -->
							</div> <!-- .et_pb_column -->
						</div> <!-- .et_pb_row -->
					<div class="et_pb_row et_pb_row_15">
					<?php $i=0; if( have_rows('boxes') ) : while( have_rows('boxes') ) : the_row(); $i++;

								$icon = get_sub_field('icon');
								$t = get_sub_field('title');
								$desc = get_sub_field('description');
								$sani = sanitize_title_with_dashes($t);
								if($i==3){$cl = 'et-last-child';}else{$cl='';}

							?>
						<div class="<?php echo $cl; ?> et_pb_column et_pb_column_1_3 et_pb_column_28  et_pb_css_mix_blend_mode_passthrough">
							
							<div id="<?php echo $sani; ?>" class="et_pb_module et_pb_blurb et_pb_blurb_3 regular-font max-height et_pb_bg_layout_light  et_pb_text_align_center  et_pb_blurb_position_top">
								<div class="et_pb_blurb_content">
									<div class="et_pb_main_blurb_image">
										<span class="et_pb_image_wrap">
											<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
										</span>
									</div>
									<div class="et_pb_blurb_container">
										<h4 class="et_pb_module_header">
											<span><?php echo $t; ?></span>
										</h4>
										<div class="et_pb_blurb_description">
											<p><?php echo $desc; ?></p>
										</div>
									</div>
								</div> <!-- .et_pb_blurb_content -->
							</div> <!-- .et_pb_blurb -->
						</div> <!-- .et_pb_column -->
						<?php endwhile; endif; ?>
					</div> <!-- .et_pb_row -->
						<div class="et_pb_row et_pb_row_16">
							<div class="et_pb_column et_pb_column_4_4 et_pb_column_31  et_pb_css_mix_blend_mode_passthrough et-last-child">
								<div class="et_pb_button_module_wrapper et_pb_button_7_wrapper et_pb_button_alignment_center et_pb_module ">
									<a class="et_pb_button et_pb_custom_button_icon et_pb_button_7 yer-btn et_pb_bg_layout_light" href="<?php echo $secThreeLink; ?>" data-icon="&#x3d;">Learn More About How We Work</a>
								</div>
							</div> <!-- .et_pb_column -->
						</div> <!-- .et_pb_row -->
					</div> <!-- .et_pb_section -->


					<div id="hire-top-talent-testimonials" class="et_pb_section et_pb_section_11 et_pb_with_background et_section_regular">
						<div class="et_pb_row et_pb_row_17">
							<div class="et_pb_column et_pb_column_4_4 et_pb_column_32  et_pb_css_mix_blend_mode_passthrough et-last-child">
								<div class="et_pb_module et_pb_code et_pb_code_6">
									<div class="et_pb_code_inner">
										<?php echo do_shortcode('[testimonials type="client, external link"]'); ?>
									</div>
								</div> <!-- .et_pb_code -->
							</div> <!-- .et_pb_column -->
						</div> <!-- .et_pb_row -->
						<div class="et_pb_row et_pb_row_18 et_pb_row_fullwidth et_pb_gutters1">
							<div class="et_pb_column et_pb_column_4_4 et_pb_column_33  et_pb_css_mix_blend_mode_passthrough et-last-child">
								<div class="et_pb_module et_pb_code et_pb_code_7  et_pb_text_align_center">
									<div class="et_pb_code_inner">
										<?php echo do_shortcode('[country-icons type="client, external link"]'); ?>
									</div>
								</div> <!-- .et_pb_code -->
							</div> <!-- .et_pb_column -->
						</div> <!-- .et_pb_row -->
					</div> <!-- .et_pb_section -->


					<div class="et_pb_section et_pb_section_12 et_section_regular">
						<div class="et_pb_row et_pb_row_19 et_pb_row_fullwidth et_pb_equal_columns et_pb_gutters1">
							<div class="et_pb_column et_pb_column_1_2 et_pb_column_34  et_pb_css_mix_blend_mode_passthrough">
								<div class="et_pb_module et_pb_image et_pb_image_4">
									<span class="et_pb_image_wrap ">
										<img src="<?php bloginfo('url'); ?>/wp-content/uploads/2018/05/In-75px.png" />
									</span>
								</div>
								<div class="et_pb_module et_pb_text et_pb_text_17 et_pb_bg_layout_light  et_pb_text_align_center">
									<div class="et_pb_text_inner">
										<p>
											<span class="condensed" style="line-height: 1;">Connect With Us</span><!--max-width-200-on-lrg-->
										</p>
									</div>
								</div> <!-- .et_pb_text -->
								<div class="et_pb_module et_pb_image et_pb_image_5">
									<a href="https://www.linkedin.com/company/yer-usa?trk=cws-cpw-coname-0-0" target="_blank">
										<span class="et_pb_image_wrap ">
											<img src="<?php bloginfo('url'); ?>/wp-content/uploads/2018/05/yer-linkedin-card.jpg" />
										</span>
									</a>
								</div>
							</div> <!-- .et_pb_column -->
							<div class="et_pb_column et_pb_column_1_2 et_pb_column_35  et_pb_css_mix_blend_mode_passthrough et-last-child">
								<div class="et_pb_module et_pb_text et_pb_text_18 et_pb_bg_layout_light  et_pb_text_align_left">
									<div class="et_pb_text_inner">
										<h2>Meet Our Consultants</h2>
									</div>
								</div> <!-- .et_pb_text -->
								<div class="et_pb_button_module_wrapper et_pb_button_8_wrapper et_pb_button_alignment_center et_pb_module ">
									<a class="et_pb_button et_pb_custom_button_icon et_pb_button_8 yer-btn et_pb_bg_layout_light" href="/consultants" data-icon="&#x3d;">View All Consultants</a>
								</div>
							</div> <!-- .et_pb_column -->
						</div> <!-- .et_pb_row -->
					</div> <!-- .et_pb_section -->


					<div id="hire-top-talent-contact-form" class="et_pb_section et_pb_section_13 et_pb_with_background et_section_regular">
						<div class="et_pb_row et_pb_row_20 et_pb_row_fullwidth">
							<div class="et_pb_column et_pb_column_4_4 et_pb_column_36  et_pb_css_mix_blend_mode_passthrough et-last-child">
								<div class="et_pb_module et_pb_text et_pb_text_19 et_pb_bg_layout_light  et_pb_text_align_left">
									<div class="et_pb_text_inner">
										<h2>Start the conversation and let us find your perfect candidate</h2>
									</div>
								</div> <!-- .et_pb_text -->
								<div class="et_pb_module et_pb_text et_pb_text_20 contact-form et_pb_bg_layout_light  et_pb_text_align_center">
									<div class="et_pb_text_inner">
										<?php echo do_shortcode('[contact-form-7 id="1100" title="Hire top talent contact form"]'); ?>
									</div>
								</div> <!-- .et_pb_text -->
							</div> <!-- .et_pb_column -->
						</div> <!-- .et_pb_row -->
					</div> <!-- .et_pb_section -->			
				</div>
			</div>
		</div>
	</div>
<?php endwhile; endif; ?>
<p></p> 


<?php
	$wp_query = new WP_Query();
	$wp_query->query(array(
		'post_type'=>'page',
		'pagename' => 'look-for-jobs'
	));
	if ($wp_query->have_posts()) : ?>
    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

	<div id="look-for-jobs-container" class="content-containers">
		<div data-post-id='1036' class='insert-page insert-page-1036 '>
			<div id="et-boc" class="et-boc">
				<div class="et_builder_inner_content et_pb_gutters3">
					<div class="et_pb_section et_pb_section_14 et_section_regular">
						<div class="et_pb_row et_pb_row_21 et_pb_row_fullwidth et_pb_gutters1">
							<div class="et_pb_column et_pb_column_4_4 et_pb_column_37  et_pb_css_mix_blend_mode_passthrough et-last-child">
								<div class="et_pb_module et_pb_code et_pb_code_8">
									<div class="et_pb_code_inner">
										<div id="rev_slider_2_2_wrapper" class="rev_slider_wrapper fullscreen-container" data-source="gallery" style="background:transparent;padding:0px;">
											<?php 
											echo do_shortcode('[rev_slider alias="look-for-jobs-hero-slider"]');
											//get_template_part('inc/rev-slider-home-two'); ?>
										</div>
									</div> <!-- .et_pb_code -->
								</div> <!-- .et_pb_column -->
							</div> <!-- .et_pb_row -->
						</div> <!-- .et_pb_section -->
						<div id="home-page-get-started-section" class="et_pb_section et_pb_section_15 et_section_regular">
							<div class="et_pb_row et_pb_row_22">
								<div class="et_pb_column et_pb_column_4_4 et_pb_column_38  et_pb_css_mix_blend_mode_passthrough et-last-child">
									<div class="et_pb_module et_pb_text et_pb_text_21 et_pb_bg_layout_light  et_pb_text_align_center">
										<div class="et_pb_text_inner">
											<h2>Work in the U.S. for Europe&#8217;s brightest companies</h2>
										</div>
									</div> <!-- .et_pb_text -->
									<div class="et_pb_module et_pb_divider et_pb_divider_3 et_pb_divider_position_ et_pb_space">
										<div class="et_pb_divider_internal"></div>
									</div>
									<div class="et_pb_module et_pb_text et_pb_text_22 et_pb_bg_layout_light  et_pb_text_align_center">
										<div class="et_pb_text_inner">
											<p>YER connects in-demand American professionals with European businesses operating in the United States.</p>
										</div>
									</div> <!-- .et_pb_text -->
									<div class="et_pb_module et_pb_code et_pb_code_9  et_pb_text_align_center">
										<div class="et_pb_code_inner">
											<?php echo do_shortcode('[vacancies-search]'); ?>
										</div>
									</div> <!-- .et_pb_code -->
								</div> <!-- .et_pb_column -->
							</div> <!-- .et_pb_row -->
						</div> <!-- .et_pb_section -->
						<div class="et_pb_section et_pb_section_16 et_section_regular">
							<div class="et_pb_row et_pb_row_23 et_pb_row_fullwidth et_pb_equal_columns et_pb_gutters1">
								<div class="et_pb_column et_pb_column_1_2 et_pb_column_39 overlay  et_pb_css_mix_blend_mode_passthrough">
									<div class="et_pb_module et_pb_text et_pb_text_23 regular-font et_pb_bg_layout_light  et_pb_text_align_left">
										<div class="et_pb_text_inner">
											<h3>For 30 years</h3>
										</div>
									</div> <!-- .et_pb_text -->
									<div class="et_pb_module et_pb_text et_pb_text_24 et_pb_bg_layout_light  et_pb_text_align_left">
										<div class="et_pb_text_inner">
											<h2>YER Has Helped Executives &amp; Professionals Advance Their Careers</h2>
										</div>
									</div> <!-- .et_pb_text -->
								</div> <!-- .et_pb_column -->
								<div class="et_pb_column et_pb_column_1_2 et_pb_column_40  et_pb_css_mix_blend_mode_passthrough et-last-child">
									<div class="et_pb_module et_pb_divider_4 et_pb_space et_pb_divider_hidden">
										<div class="et_pb_divider_internal"></div>
									</div>
									<div class="et_pb_module et_pb_text et_pb_text_25 et_pb_bg_layout_light  et_pb_text_align_center">
										<div class="et_pb_text_inner"><h2>Latest Vacancies</h2></div>
									</div> <!-- .et_pb_text -->
									<div class="et_pb_module et_pb_code et_pb_code_10">
										<div class="et_pb_code_inner">
											<?php echo do_shortcode('[latest-vacancies num-posts="4" layout="compact"]'); ?>
										</div>
									</div> <!-- .et_pb_code -->
									<div class="et_pb_button_module_wrapper et_pb_button_9_wrapper et_pb_button_alignment_center et_pb_module ">
										<a class="et_pb_button et_pb_custom_button_icon et_pb_button_9 yer-btn et_pb_bg_layout_light" href="/vacancies" data-icon="&#x3d;">Browse All Vacancies</a>
									</div>
									<div class="et_pb_module et_pb_divider_5 et_pb_space et_pb_divider_hidden">
										<div class="et_pb_divider_internal"></div>
									</div>
								</div> <!-- .et_pb_column -->
							</div> <!-- .et_pb_row -->
						</div> <!-- .et_pb_section -->
						<div id="look-for-jobs-testimonials" class="et_pb_section et_pb_section_17 et_pb_with_background et_section_regular">
							<div class="et_pb_row et_pb_row_24">
								<div class="et_pb_column et_pb_column_4_4 et_pb_column_41  et_pb_css_mix_blend_mode_passthrough et-last-child">
									<div class="et_pb_module et_pb_code et_pb_code_11">
										<div class="et_pb_code_inner">
											<?php echo do_shortcode('[testimonials type="candidate"]'); ?>
										</div>
									</div> <!-- .et_pb_code -->
								</div> <!-- .et_pb_column -->
							</div> <!-- .et_pb_row -->
						</div> <!-- .et_pb_section -->
						<div class="et_pb_section et_pb_section_18 et_section_regular">
							<div class="et_pb_row et_pb_row_25 et_pb_row_fullwidth et_pb_equal_columns et_pb_gutters1">
								<div class="et_pb_column et_pb_column_1_2 et_pb_column_42  et_pb_css_mix_blend_mode_passthrough">
									<div class="et_pb_module et_pb_image et_pb_image_6">
										<span class="et_pb_image_wrap ">
											<img src="<?php bloginfo('url'); ?>/wp-content/uploads/2018/05/In-75px.png" />
										</span>
									</div>
									<div class="et_pb_module et_pb_text et_pb_text_26 et_pb_bg_layout_light  et_pb_text_align_center">
										<div class="et_pb_text_inner">
											<p>
												<span class="condensed" style="line-height: 1;">Connect With Us</span><!--max-width-200-on-lrg-->
											</p>
										</div>
									</div> <!-- .et_pb_text -->
									<div class="et_pb_module et_pb_image et_pb_image_7">
										<a href="https://www.linkedin.com/company/yer-usa?trk=cws-cpw-coname-0-0" target="_blank">
											<span class="et_pb_image_wrap ">
												<img src="<?php bloginfo('url'); ?>/wp-content/uploads/2018/05/yer-linkedin-card.jpg" />
											</span>
										</a>
									</div>
								</div> <!-- .et_pb_column -->
								<div class="et_pb_column et_pb_column_1_2 et_pb_column_43  et_pb_css_mix_blend_mode_passthrough et-last-child">
									<div class="et_pb_module et_pb_code et_pb_code_12  et_pb_text_align_center">
										<div class="et_pb_code_inner"><!--<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>-->
											<script type="IN/JYMBII" data-companyid="11317039" data-format="inline"></script>
										</div>
									</div> <!-- .et_pb_code -->
								</div> <!-- .et_pb_column -->
							</div> <!-- .et_pb_row -->
						</div> <!-- .et_pb_section -->
						<div class="et_pb_section et_pb_section_19 et_pb_with_background et_section_regular">
							<div class="et_pb_row et_pb_row_26 et_pb_row_fullwidth">
								<div class="et_pb_column et_pb_column_4_4 et_pb_column_44  et_pb_css_mix_blend_mode_passthrough et-last-child">
									<div class="et_pb_module et_pb_text et_pb_text_27 et_pb_bg_layout_light  et_pb_text_align_left">
										<div class="et_pb_text_inner">
											<h2>Let us help you find your next career opportunity</h2>
										</div>
									</div> <!-- .et_pb_text -->
									<div id="look-for-jobs-apply-form" class="et_pb_module et_pb_text et_pb_text_28 apply-form et_pb_bg_layout_light  et_pb_text_align_center">
										<div class="et_pb_text_inner">
											<?php echo do_shortcode('[contact-form-7 id="1284" title="Look for jobs contact form"]'); ?>
										</div>
									</div> <!-- .et_pb_text -->
								</div> <!-- .et_pb_column -->
							</div> <!-- .et_pb_row -->
						</div> <!-- .et_pb_section -->			
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endwhile; endif; ?>
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
<?php 
get_footer();

 ?>