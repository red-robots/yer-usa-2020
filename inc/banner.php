<?php if( !$tagline ) {
	$tagline=get_the_title();
	} ?>
<div class="banner" style="background-image: url(<?php echo $thumb; ?>);">
	<div>
		<h1><?php the_title(); ?></h1>
	</div>
	<div>
		<div class="tagline"><?php echo $tagline; ?></div>
		<?php if($secondary_tagline) { ?>
			<div class="tagline-sec"><?php echo $secondary_tagline; ?></div>
		<?php } ?>
	</div>
</div>