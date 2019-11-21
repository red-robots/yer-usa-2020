<?php 



if( !$tagline ) {
	$tagline=get_the_title();
	} ?>
<div class="banner hero-wrapper" style="background-image: url(<?php echo $thumb; ?>);">

<div class="et_pb_row et_pb_row_10">
<div class="et_pb_column et_pb_column_4_4 et_pb_column_22  et_pb_css_mix_blend_mode_passthrough et-last-child">
<div class="et_pb_module et_pb_text et_pb_text_12 et_pb_bg_layout_light  et_pb_text_align_center">

	<div class="et_pb_text_inner">
		<h1><?php the_title(); ?></h1>
		<p>&nbsp;</p>
	</div>


	<div class="et_pb_module et_pb_text et_pb_text_13 condensed et_pb_bg_layout_light  et_pb_text_align_center">
		<div class="et_pb_text_inner tagline">
			<?php echo $tagline; ?>
		</div>
		
		<?php if($secondary_tagline) { ?>
		<div class="et_pb_module et_pb_text et_pb_text_14 condensed et_pb_bg_layout_light  et_pb_text_align_center">
			<div class="tagline-sec et_pb_text_inner"><?php echo $secondary_tagline; ?></div>
		</div>
		<?php } ?>
	</div>

	</div></div></div>
</div>