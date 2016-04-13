<?php

add_action('genesis_before_entry', function(){
	global $itv_has_slideshows_cat;
	$post = get_post();
	$itv_has_slideshows_cat = in_category('slideshows', $post);

	if($itv_has_slideshows_cat){

		$slideshow_type = get_post_meta($post->ID, 'slideshow_format', true);
		$custom_slide = get_post_meta($post->ID, 'custom_slide', true);

		if( ($slideshow_type == 'single' || $slideshow_type == 'paged') && ! empty($custom_slide) ) {

			$url = $_SERVER['REQUEST_URI'];

			$last_url_segment = basename(parse_url($url, PHP_URL_PATH));

			if(is_single() && is_numeric($last_url_segment)) {
				remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
				remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
				remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
				remove_action( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );
			} else {
				add_filter( 'the_content', 'add_start_slideshow_link', 20 );
			}

			remove_action( 'genesis_before_entry_content' , 'itv_facebook_share' );
			remove_action('genesis_after_entry', 'add_ad_block_after_post', 99998);
			remove_action('genesis_after_entry', 'add_infinite_scroll', 99999);

			if($slideshow_type == 'paged'){
				add_action('genesis_entry_content', 'itv_add_slideshow_paged', 11);
			} elseif($slideshow_type == 'single') {
				add_action('genesis_entry_content', 'itv_add_slideshow_single', 11);
			}
		}
	}
});

function add_start_slideshow_link($content){
	if ( is_singular() && ! is_page() ){
		$content = preg_replace_callback("/<img[^>]+>/i", function($matches){
			return '<a href="1">'.$matches[0].'</a>';
		}, $content);
	}
	return $content;
}

add_action('genesis_after_entry', function(){
	global $itv_has_slideshows_cat;
	if(empty($itv_has_slideshows_cat)){
		$itv_has_slideshows_cat = false;
	}
	if($itv_has_slideshows_cat && is_singular()) include('fb/FB-comments.php');
	if($itv_has_slideshows_cat && function_exists ('adinserter')) echo adinserter(7);
	if($itv_has_slideshows_cat && class_exists('AjaxLoadMore') && is_singular()){
		echo do_shortcode('[ajax_load_more post_type="post" posts_per_page="9" repeater="repeater" max_pages="0" custom_args="section_name:slideshow"]');
	}
}, 99998);

function itv_add_slideshow_paged(){
	$post = get_post();

	$post_meta = get_post_meta($post->ID);

	$custom_slide = (int) $post_meta['custom_slide'][0];

	$url = $_SERVER['REQUEST_URI'];

	$last_url_segment = basename(parse_url($url, PHP_URL_PATH));

	$post_link = get_permalink();

	if( is_single() && is_numeric($last_url_segment) && $last_url_segment <= $custom_slide ) {

		$i = $last_url_segment - 1;

		$back = ($i-1) > 0 ? $i : '';
		$image_title = empty($post_meta['custom_slide_'.$i.'_image_title'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_title'][0];
		$image = empty($post_meta['custom_slide_'.$i.'_image'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image'][0];
		$image_credit_text = empty($post_meta['custom_slide_'.$i.'_image_credit_text'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_credit_text'][0];
		$image_credit = empty($post_meta['custom_slide_'.$i.'_image_credit'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_credit'][0];
		$image_info = empty($post_meta['custom_slide_'.$i.'_image_info'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_info'][0];
		$image_information_footer = empty($post_meta['custom_slide_'.$i.'_image_information_footer'][0]) ? '' : $post_meta['custom_slide_'.$i.'_image_information_footer'][0];
		$final_page = empty($post_meta['final_page'][0]) ? get_site_url().'/end-slideshow' : $post_meta['final_page'][0];
		$shareURL = $post_link.$i;

		$slide_image = '<a href="'.$post_link.($i+2).'">'.wp_get_attachment_image((int)$image, 'full').'</a>';

		?>
		<div class="slideshow-wrap">
			<div class="slideshow-navigation">
				<a class="slideshow-button one-sixth first" href="<?php echo $post_link.$back;?>">Back</a>
				<h2 class="four-sixths"><?php echo $image_title;?></h2>
				<?php if( ($i+1) == $custom_slide ):?>
					<a class="slideshow-button one-sixth" href="<?php echo $final_page;?>">Next</a>
				<?php else:?>
					<a class="slideshow-button one-sixth" href="<?php echo $post_link.($i+2);?>">Next</a>
				<?php endif; ?>
			</div>
			<div class="slideshow-image">
				<?php echo $slide_image; ?>
				<?php if( ! empty($image_credit) ):?>
					<p class="slideshow-credit">
						<a href="<?php echo $image_credit;?>"><?php echo (! empty($image_credit_text)) ? $image_credit_text : $image_credit;?></a>
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
			<div class="slideshow-share">
				<?php if(is_single())include_once('fb/FB-share-like.php');?>
			</div>
			<div class="slideshow-navigation">
				<a class="slideshow-button one-sixth first" href="<?php echo $post_link.$back;?>">Back</a>
				<div class="slideshow-counter four-sixths"><?php echo ($i+1).'/'.$custom_slide; ?></div>
				<?php if( ($i+1) == $custom_slide ):?>
					<a class="slideshow-button one-sixth" href="<?php echo $final_page;?>">Next</a>
				<?php else:?>
					<a class="slideshow-button one-sixth" href="<?php echo $post_link.($i+2);?>">Next</a>
				<?php endif; ?>
			</div>
		</div>
		<?php
	} else {
		?>
		<div class="slideshow-wrap">
			<div class="slideshow-share">
				<?php if(is_single())include_once('fb/FB-share-like.php');?>
			</div>
			<div class="slideshow-navigation">
				<a class="slideshow-button slideshow-button-start" href="<?php echo $post_link.'1';?>">START SLIDESHOW</a>
			</div>
		</div>
		<?php
	}
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
			<?php echo wp_get_attachment_image((int)$image, 'full');?>
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
}