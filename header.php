<?php
/**
 * The header for theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link rel="stylesheet" href="https://use.typekit.net/puk0kbb.css">



<link rel='stylesheet' id='childstyle-css'  href='<?php bloginfo( 'stylesheet_directory' ); ?>/divi.css' type='text/css' media='all' />
<?php 
if(is_page('yer-usa')) {
	$thePage='contact';
}elseif(is_page('careers')) {
	$thePage='careers';
}elseif(is_front_page()) {
	$thePage='home';
}

 ?>


<?php wp_head(); ?>

<script defer src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>
<script defer src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/vendors/flexslider.js"></script>
<script type='text/javascript' src='//platform.linkedin.com/in.js?ver=5.2.2'></script>
<script type='text/javascript' src='//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js?ver=1'></script>


 <?php if( is_page(array('yer-usa','careers')) || is_front_page() ) { ?>
<link rel='stylesheet'  href='<?php bloginfo( 'stylesheet_directory' ); ?>/inline-styles-<?php echo $thePage; ?>.css' type='text/css' media='all' />
<?php } ?>
</head>

<body <?php body_class(); ?>>
<div id="page-container" class="et-animated-content ">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'acstarter' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
	<div id="right-full-screen-menu-container" class="custom-top-wrap">
	<div class="custom-top">
		<div class="wrapper">
			
			<?php if(is_home()) { ?>
	            <h1 class="logo">
		            <a href="<?php bloginfo('url'); ?>">
		            	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/yer-logo.svg" alt="<?php bloginfo('name'); ?>">
		            </a>
	            </h1>
	        <?php } else { ?>
	            <div class="logo">
	            	<a href="<?php bloginfo('url'); ?>">
		            	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/yer-logo.svg" alt="<?php bloginfo('name'); ?>">
		            </a>
	            </div>
	        <?php } ?>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'MENU', 'acstarter' ); ?></button>
				<?php //wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->

			<div class="burger">
			  <span></span>
			</div>

			<nav class="mobilemenu">
				<?php wp_nav_menu( array( 
					'container' => 'ul',
					'theme_location' => 'primary-menu',
					'menu_class'     => 'mobilemain',
				)); ?>
			</nav>

			

	</div><!-- wrapper -->
	</div>
			<div id="home-page-tabs-row" class="et_pb_row et_pb_row_1 et_pb_row_fullwidth et_pb_gutters1">
				<div class="et_pb_column et_pb_column_4_4 et_pb_column_3  et_pb_css_mix_blend_mode_passthrough et-last-child">
					<div id="home-page-tabs" class="et_pb_module et_pb_code et_pb_code_0">
						<div class="et_pb_code_inner">
							<ul class="tabs-nav-controls">
								<li class="active" data-tab="hire-top-talent">
									<a href="">Hire Top Talent</a>
								</li>
								<li class="" data-tab="look-for-jobs">
									<a href="">Look For Jobs</a>
								</li>
							</ul>
						</div>

					</div>
				</div>
			</div>
	
	</div>
	</header><!-- #masthead -->



	<div id="content" class="site-content ">
