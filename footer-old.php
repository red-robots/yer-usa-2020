<?php
/**
 * Fires after the main content, before the footer is output.
 *
 * @since ??
 */
do_action( 'et_after_main_content' );

if ( 'on' == et_get_option( 'divi_back_to_top', 'false' ) ) : ?>

	<span class="et_pb_scroll_top et-pb-icon"></span>

<?php endif;

if ( ! is_page_template( 'page-template-blank.php' ) ) : ?>

			<footer id="main-footer">
				<?php echo do_shortcode( '[et_pb_section global_module="695"][/et_pb_section]' ); ?>	
				<?php //get_sidebar( 'footer' ); ?>


		<?php
			// if ( has_nav_menu( 'footer-menu' ) ) : ?>

				<!-- <div id="et-footer-nav">
					<div class="container">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'footer-menu',
								'depth'          => '1',
								'menu_class'     => 'bottom-nav',
								'container'      => '',
								'fallback_cb'    => '',
							) );
						?>
					</div>
				</div> --> <!-- #et-footer-nav -->

			<?php //endif; ?>
<br>
				<div id="footer-bottom">
					<div class="container clearfix">
					<?php 
					wp_nav_menu( array(
						'theme_location' => 'footer-menu',
						'depth'          => '1',
						'menu_class'     => 'menu-legal-menu-container',
						'container'      => '',
						'fallback_cb'    => '',
					) );
					 ?>
				<?php
					// if ( false !== et_get_option( 'show_footer_social_icons', true ) ) {
					// 	get_template_part( 'includes/social_icons', 'footer' );
					// }

					//echo et_get_footer_credits();
				//echo do_shortcode( '[et_pb_section global_module="700"][/et_pb_section]' );
				echo '<br>';
				echo '<div id="copyright">';
				echo '&copy; '.date('Y').' YER Inc. All rights reserved.';
				echo '</div>';
				?>
					</div>	<!-- .container -->
				</div>
			</footer> <!-- #main-footer -->
		</div> <!-- #et-main-area -->

<?php endif; // ! is_page_template( 'page-template-blank.php' ) ?>

	</div> <!-- #page-container -->

	<?php wp_footer(); ?>
</body>
</html>
