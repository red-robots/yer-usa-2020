<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */
$linkedin = get_field('linkedin', 'option');
$facebook = get_field('facebook', 'option');
$twitter = get_field('twitter', 'option');
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="logo">
			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/yer-logo.svg" alt="<?php bloginfo('name'); ?>">
		</div>
		<div class="social">
			<?php if($facebook){ ?>
				<a href="<?php echo $facebook; ?>"><i class="fab fa-facebook-f fa-2x"></i></a>
			<?php } ?>
			<?php if($twitter){ ?>
				<a href="<?php echo $twitter; ?>"><i class="fab fa-twitter fa-2x"></i></a>
			<?php } ?>
			<?php if($linkedin){ ?>
				<a href="<?php echo $linkedin; ?>"><i class="fab fa-linkedin-in fa-2x"></i></a>
			<?php } ?>
		</div>
		<div class="footer-nav">
			<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu') ); ?>
		</div><!-- wrapper -->
		<footer class="disclaimer">
			<div class="dismenu"><?php wp_nav_menu( array( 'theme_location' => 'footer-menu') ); ?></div>
			&copy; <?php echo date('Y'); ?> YER Inc. All rights reserved.
		</footer>
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
