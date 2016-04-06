<?php

add_action('genesis_before_entry', function(){
	$post = get_post();

	$slideshow_type = get_post_meta($post->ID, 'slideshow_format', true);
	$custom_slide = get_post_meta($post->ID, 'custom_slide', true);

	if( ! empty($slideshow_type) && ! empty($custom_slide) ) {

		remove_action('genesis_after_entry', 'add_infinite_scroll', 99999);

		add_action('genesis_entry_content', 'itv_add_slideshow');
	}
});

function itv_add_slideshow(){
	$post = get_post();

	$post_meta = get_post_meta($post->ID);

	$custom_slide = (int) $post_meta['custom_slide'][0];

	$url = $_SERVER['REQUEST_URI'];

	$last_url_segment = basename(parse_url($url, PHP_URL_PATH));

	if( is_numeric($last_url_segment) && $last_url_segment <= $custom_slide ) {
		$i = $last_url_segment;
	} else {
		$i = 0;
	}
//	for($i = 0; $i < $custom_slide; $i++){
		$post_link = get_permalink();
		$back = ($i-1) > 0 ? $i-1 : '';
		$image_title = empty($post_meta['custom_slide_'.$i.'_image_title'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_title'][0];
		$image = empty($post_meta['custom_slide_'.$i.'_image'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image'][0];
		$image_credit_text = empty($post_meta['custom_slide_'.$i.'_image_credit_text'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_credit_text'][0];
		$image_credit = empty($post_meta['custom_slide_'.$i.'_image_credit'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_credit'][0];
		$image_info = empty($post_meta['custom_slide_'.$i.'_image_info'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_info'][0];
		$image_information_footer = empty($post_meta['custom_slide_'.$i.'_image_information_footer'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_information_footer'][0];
		?>
<div class="slideshow-wrap">
	<?php if($i != 0 && ($i+1) != $custom_slide):?>
		<div class="slideshow-navigation">
			<a href="<?php echo $post_link.$back;?>">Back</a>
			<h2><?php echo $image_title;?></h2>
			<a href="<?php echo $post_link.($i+1);?>">Next</a>
		</div>
	<?php endif;?>
	<div class="slideshow-image">
		<?php echo wp_get_attachment_image((int)$image, 'full');?>
		<p class="slideshow-credit-text"><?php echo $image_credit_text;?></p>
		<p class="slideshow-credit"><?php echo $image_credit;?></p>
	</div>
	<p class="slideshow-info"><?php echo $image_info; ?></p>
	<p class="slideshow-info-footer"><?php echo $image_information_footer; ?></p>
	<?php if($i != 0 && ($i+1) != $custom_slide):?>
		<div class="slideshow-navigation">
			<a href="<?php echo get_permalink().$back;?>">Back</a>
			<div class="slideshow-counter"><?php echo $i.'/'.($custom_slide-2); ?></div>
			<a href="<?php echo get_permalink().($i+1);?>">Next</a>
		</div>
	<?php endif;?>
</div>
		<?php
//	}
}