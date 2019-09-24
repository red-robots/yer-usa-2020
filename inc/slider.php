<?php  if( have_rows('slider') ) : ?>
	<div class="flexslider">
		<ul class="slides">
			<?php  while( have_rows('slider') ) : the_row();

			$title = get_sub_field('text');
			$img = get_sub_field('slide_image');
			$btnText = get_sub_field('button_text');
			$btnLink = get_sub_field('button_link');
			$isMap = get_sub_field('is_this_the_map_slide');
			$gallery = get_sub_field('gallery');

			if( $gallery ) { 
				$c = 'gallery';
			} else {$c='';}


	 ?>

				 <li>
				 	
				 	<?php if( $title ) { ?>
					 	<div class="text <?php echo $c; ?>">
					 		<h2><?php echo $title; ?></h2>
					 		<?php if( $gallery ): ?>
					 			<div class="gallery">
							    <?php foreach( $gallery as $image ): ?>
						            <div class="logo">
						               <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
						            </div>
							        <?php endforeach; ?>
							    </div>
							   <?php endif; ?>
					 	</div>
				 	<?php } ?>
				 	<?php if( $btnText ) { ?>
					 	<div class="learn-banner">
					 		<div class="btn">
						 		<a href="<?php echo $btnLink; ?>">
						 			<?php echo $btnText; ?>
						 		</a>
					 		</div>
					 	</div>
				 	<?php } ?>
				 	<img src="<?php echo $img['url']; ?>"  alt="<?php echo $img['alt']; ?>">
				 </li>


			<?php endwhile; ?>
		</ul>
	</div>
<?php endif; ?>