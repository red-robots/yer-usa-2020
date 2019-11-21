<?php 
	$sTitle = get_field('sub_title');
	$title = get_field('title');
 ?>
 <div id="#map" class="et_pb_section et_pb_section_9 et_pb_with_background et_section_regular">




<div class="et_pb_row et_pb_row_13 et_pb_row_fullwidth et_pb_gutters1">
<div class="et_pb_column et_pb_column_1_2 et_pb_column_25  et_pb_css_mix_blend_mode_passthrough">


<div class="et_pb_module et_pb_text et_pb_text_14 regular-font et_pb_bg_layout_light  et_pb_text_align_left">


<div class="et_pb_text_inner">
<h3><?php echo $sTitle; ?></h3>
</div>
</div> <!-- .et_pb_text --><div class="et_pb_module et_pb_text et_pb_text_15 et_pb_bg_layout_light  et_pb_text_align_left">


<div class="et_pb_text_inner">
<h2><?php echo $title; ?></h2>
</div>
</div> <!-- .et_pb_text -->
<div class="et_pb_module et_pb_divider et_pb_divider_2 et_pb_divider_position_ et_pb_space"><div class="et_pb_divider_internal">
	
</div>
</div>
<div class="et_pb_module et_pb_gallery et_pb_gallery_0 clients-logos-container disable-lightbox et_pb_bg_layout_light  et_pb_gallery_grid">
<div class="et_pb_gallery_items et_post_gallery clearfix" data-per_page="12">

<?php if(have_rows('logos')) : while(have_rows('logos')) : the_row(); 
$logo = get_sub_field('logo');
?>
<div class="et_pb_gallery_item et_pb_grid_item et_pb_bg_layout_light">
	<div class='et_pb_gallery_image landscape'>
		<a href="" title="1200px-Deutz_Logo">
			<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
			<span class="et_overlay"></span>
		</a>
	</div>
</div>
<?php endwhile; endif; ?>




</div><!-- .et_pb_gallery_items --></div><!-- .et_pb_gallery -->
</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_2 et_pb_column_26  et_pb_css_mix_blend_mode_passthrough et-last-child">


<div class="et_pb_module et_pb_image et_pb_image_3 et_pb_image_sticky">


<span class="et_pb_image_wrap "><img src="https://yer-usa.com/wp-content/uploads/2018/05/shutterstock_564518068.jpg" /></span>
</div>
</div> <!-- .et_pb_column -->


</div> <!-- .et_pb_row -->


</div> <!-- .et_pb_section -->