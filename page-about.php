<?php
/**
 * Template Name: About
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */
get_header(); 

$tagline = get_field('tagline');
$secondary_tagline = get_field('secondary_tagline');
$block_1_title = get_field('block_1_title');
$block_1_description = get_field('block_1_description');
$block_2_title = get_field('block_2_title');
$block_2_description = get_field('block_2_description');
$block_3_title = get_field('block_3_title');
$block_3_description = get_field('block_3_description');
$background_image = get_field('background_image');
$quote = get_field('quote');
$name = get_field('name');
$title = get_field('title');
$link = get_field('link');
$left_block_title = get_field('left_block_title');
$left_block_list = get_field('left_block_list');
$right_block_title = get_field('right_block_title');
$section_5_title = get_field('section_5_title');
$section_6_title = get_field('section_6_title');
$section_6_description = get_field('section_6_description');
$section_6_link_label = get_field('section_6_link_label');
$section_6_link = get_field('section_6_link');

//repeaters 
$right_block_lists = get_field('right_block_lists');
$steps = get_field('steps');

// thumbs
$thumb = get_the_post_thumbnail_url();


// echo '<pre>';
// print_r($right_block_lists);
// echo '</pre>';

// foreach($right_block_lists as $k) {

// }

include( locate_template( 'inc/banner.php', false, false ) );
?>

	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
			endwhile; // End of the loop.
			?>
			<div class="wrapper">
				<section class="about-first">
				<div class="mobile-padding">
					<div class="block">
						<h2><?php echo $block_1_title; ?></h2>
						<div class="desc">
							<?php echo $block_1_description; ?>
						</div>
					</div>
					<div class="block">
						<h2><?php echo $block_2_title; ?></h2>
						<div class="desc">
							<?php echo $block_2_description; ?>
						</div>
					</div>
					<div class="block last">
						<h2><?php echo $block_3_title; ?></h2>
						<div class="desc">
							<?php echo $block_3_description; ?>
						</div>
					</div>
					</div>
				</section>
			</div>
			<section class="about-second" style="background-image: url(<?php echo $background_image['url']; ?>);">
				
				<div class="info">
					<div class="quote">
						<?php echo $quote; ?>
					</div>
					<div class="name">
						<?php echo $name; ?>
					</div>
					<div class="title">
						<?php echo $title; ?>
					</div>
					<div class="button">
						<a href="<?php echo $link ?>">Meet Our Team</a>
					</div>
				</div>
				
			</section>
			<section class="about-third">
				<div class="block left">
					<h2><?php echo $left_block_title; ?></h2>
					<?php echo $left_block_list; ?>
				</div>
				<div class="block">
					<h2><?php echo $right_block_title; ?></h2>
					<?php if(have_rows('right_block_lists')) : 
					while(have_rows('right_block_lists')) : the_row(); $i++;
							$title = get_sub_field('block_title');

							if( $i==1 || $i==3 ){echo '<div class="half">';}
					 ?>
					 <div class="listitem <?php echo $i; ?>">
					 	<h3><?php echo $title; ?></h3>
					 	<?php if(have_rows('block_list')) : ?>
					 		<ul>
					 			<?php while(have_rows('block_list')) : the_row(); ?>
					 				<li><?php the_sub_field('list_item'); ?></li>
					 			<?php endwhile; ?>
					 		</ul>
					 	<?php endif; ?>
					 </div>
					 <?php if( $i==2 || $i==3 ){echo '</div>';} ?>
					<?php endwhile; ?>
				<?php endif; ?>
					<?php //echo $left_block_list; ?>
				</div>
			</section>
			<section class="about-fourth">
				<h2><?php echo $section_5_title; ?></h2>
				<?php $cg=1;$i=0; 
					if(have_rows('steps')): ?>
					<div class="steps">
						<?php while(have_rows('steps')): the_row(); $i++; 
								$stepDesc = get_sub_field('step_description');
								if($cg==1){$cl='first';}else{$cl='non';}
							?>
							<div class="step <?php echo $cl.' '.$cg; ?>">
								<div class="circle"><?php echo $i; ?></div>
								<div class="desc">
									<?php echo $stepDesc; ?>
								</div>
							</div>
							<?php $cg++;
								if($cg==3){$cg=1;} ?>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</section>
			<section class="about-fith">
				<h2><?php echo $section_6_title; ?></h2>
				<div class="desc">
					<?php echo $section_6_description; ?>
				</div>
				<div class="button">
					<a href="<?php echo $section_6_link; ?>"><?php echo $section_6_link_label; ?></a>
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
