<?php

add_action('genesis_before_entry', function(){
	$post = get_post();

	$slideshow_type = get_post_meta($post->ID, 'slideshow_format', true);
	$custom_slide = get_post_meta($post->ID, 'custom_slide', true);

	if( ($slideshow_type == 'single' || $slideshow_type == 'paged') && ! empty($custom_slide) ) {

		remove_action('genesis_after_entry', 'add_infinite_scroll', 99999);

		if($slideshow_type == 'paged'){
			add_action('genesis_entry_content', 'itv_add_slideshow_paged');
		} elseif($slideshow_type == 'single') {
			add_action('genesis_entry_content', 'itv_add_slideshow_single');
		}
	}
});

function itv_add_slideshow_paged(){
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

	$post_link = get_permalink();
	$back = ($i-1) > 0 ? $i-1 : '';
	$image_title = empty($post_meta['custom_slide_'.$i.'_image_title'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_title'][0];
	$image = empty($post_meta['custom_slide_'.$i.'_image'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image'][0];
	$image_credit_text = empty($post_meta['custom_slide_'.$i.'_image_credit_text'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_credit_text'][0];
	$image_credit = empty($post_meta['custom_slide_'.$i.'_image_credit'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_credit'][0];
	$image_info = empty($post_meta['custom_slide_'.$i.'_image_info'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_info'][0];
	$image_information_footer = empty($post_meta['custom_slide_'.$i.'_image_information_footer'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_information_footer'][0];
	$final_page = empty($post_meta['final_page'][0]) ? get_site_url().'/end-slideshow' : $post_meta['final_page'][0];

	if($i == 0){
		$slide_image = '<a href="'.$post_link.'1">'.wp_get_attachment_image((int)$image, 'full').'</a>';
	} elseif( ! empty($image_credit) ){
		$slide_image = '<a href="'.$image_credit.'" target="_blank">'.wp_get_attachment_image((int)$image, 'full').'</a>';
	} else {
		$slide_image = wp_get_attachment_image((int)$image, 'full');
	}
		?>
<div class="slideshow-wrap">
	<?php if($i != 0):?>
		<div class="slideshow-navigation">
			<a class="slideshow-button one-sixth first" href="<?php echo $post_link.$back;?>">Back</a>
			<h2 class="four-sixths"><?php echo $image_title;?></h2>
			<?php if( ($i+1) == $custom_slide ):?>
				<a class="slideshow-button one-sixth" href="<?php echo get_site_url().'/end-slideshow'?>">Next</a>
			<?php else:?>
				<a class="slideshow-button one-sixth" href="<?php echo $post_link.($i+1);?>">Next</a>
			<?php endif; ?>
		</div>
	<?php endif;?>
	<div class="slideshow-image">
		<?php echo $slide_image; ?>
		<?php if( ! empty($image_credit) ):?>
			<p class="slideshow-credit">
				<a href="<?php echo $image_credit;?>" target="_blank"><?php echo (! empty($image_credit_text)) ? $image_credit_text : $image_credit;?></a>
			</p>
		<?php elseif(! empty($image_credit_text)):?>
			<p class="slideshow-credit"><?php echo $image_credit_text;?></p>
		<?php endif;?>
	</div>
	<?php if( ! empty($image_info) ):?>
		<p class="slideshow-info"><?php echo $image_info; ?></p>
	<?php endif;?>
	<?php if( ! empty($image_information_footer) ):?>
		<p class="slideshow-info-footer"><?php echo $image_information_footer; ?></p>
	<?php endif;?>
	<div class="slideshow-navigation">
	<?php if($i != 0):?>
		<a class="slideshow-button one-sixth first" href="<?php echo $post_link.$back;?>">Back</a>
		<div class="slideshow-counter four-sixths"><?php echo $i.'/'.($custom_slide-1); ?></div>
		<?php if( ($i+1) == $custom_slide ):?>
			<a class="slideshow-button one-sixth" href="<?php echo $final_page;?>">Next</a>
		<?php else:?>
			<a class="slideshow-button one-sixth" href="<?php echo $post_link.($i+1);?>">Next</a>
		<?php endif; ?>
	<?php elseif($i == 0):?>
		<a class="slideshow-button slideshow-button-start" href="<?php echo $post_link.'1';?>">START SLIDESHOW</a>
	<?php endif;?>
	</div>
</div>
<?php
	add_action('genesis_after_entry', function(){
		if(function_exists ('adinserter')) echo adinserter(7);
		if(class_exists('AjaxLoadMore') && is_singular()){
			echo '</br><p></p><h2>Check out some more:</h2>';
			echo do_shortcode('[ajax_load_more post_type="post" category="slideshows" posts_per_page="9" repeater="repeater" max_pages="0" container_type="div" meta_key="_thumbnail_id" meta_value="" meta_compare="EXISTS" meta_type="DECIMAL"]');
		}
	}, 99998);
}

function itv_add_slideshow_single(){
	$post = get_post();

	$post_meta = get_post_meta($post->ID);

	$custom_slide = (int) $post_meta['custom_slide'][0];

	for($i = 0; $i < $custom_slide; $i++){
		$image_title = empty($post_meta['custom_slide_'.$i.'_image_title'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_title'][0];
		$image = empty($post_meta['custom_slide_'.$i.'_image'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image'][0];
		$image_credit_text = empty($post_meta['custom_slide_'.$i.'_image_credit_text'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_credit_text'][0];
		$image_credit = empty($post_meta['custom_slide_'.$i.'_image_credit'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_credit'][0];
		$image_info = empty($post_meta['custom_slide_'.$i.'_image_info'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_info'][0];
		$image_information_footer = empty($post_meta['custom_slide_'.$i.'_image_information_footer'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_information_footer'][0];
	?>
	<div class="slideshow-wrap">
		<div class="slideshow-navigation">
			<h2 class="single"><?php echo $image_title;?></h2>
		</div>
		<div class="slideshow-image">
			<a href="<?php echo $image_credit;?>" target="_blank"><?php echo wp_get_attachment_image((int)$image, 'full');?></a>
			<?php if( ! empty($image_credit) ):?>
				<p class="slideshow-credit">
					<a href="<?php echo $image_credit;?>" target="_blank"><?php echo (! empty($image_credit_text)) ? $image_credit_text : $image_credit;?></a>
				</p>
			<?php elseif(! empty($image_credit_text)):?>
				<p class="slideshow-credit"><?php echo $image_credit_text;?></p>
			<?php endif;?>
		</div>
		<p class="slideshow-info"><?php echo $image_info; ?></p>
		<p class="slideshow-info-footer"><?php echo $image_information_footer; ?></p>
	</div>
	<?php
		if(function_exists ('adinserter') && ($i+1) != $custom_slide) echo adinserter(7);
	}
	add_action('genesis_after_entry', function(){
		if(class_exists('AjaxLoadMore') && is_singular()){
			echo '</br><p></p><h2>Check out some more:</h2>';
			echo do_shortcode('[ajax_load_more post_type="post" category="slideshows" posts_per_page="9" repeater="repeater" max_pages="0" container_type="div" meta_key="_thumbnail_id" meta_value="" meta_compare="EXISTS" meta_type="DECIMAL"]');
		}
	}, 99998);
}