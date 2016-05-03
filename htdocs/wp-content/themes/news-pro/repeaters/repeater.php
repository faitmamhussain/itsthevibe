<?php

	$post = get_post();

	if( empty($GLOBALS['home_page_posts_counter']) ){
		$GLOBALS['home_page_posts_counter'] = 1;
	} else {
		$GLOBALS['home_page_posts_counter']++;
	}

	$counter = $GLOBALS['home_page_posts_counter'];

	$cat = itv_get_primary_category($post);

	echo '<div class="home-page-post one-third'.(($counter % 3 == 1) ? ' first' : '').'">';
?>
	<a
		href="<?php echo get_permalink(); ?>"
	   	class="post-image post-link-catchable"
		data-url="<?php echo get_permalink(); ?>"
		data-image="<?php echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); ?>"
		data-term="slot-<?php echo $counter; ?>"
	>
		<?php echo get_the_post_thumbnail($post->ID, 'custom-post');?>
	</a>
	<div class="post-description">
		<a
			href="<?php echo get_category_link($cat->cat_ID);?>"
			class="category post-link-catchable"
			data-url="<?php echo get_category_link($cat->cat_ID);?>"
			data-image=""
			data-term="slot-<?php echo $counter; ?>"
		><?php echo $cat->name;?></a>
		<span class="posted-on"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> ago</span>
		<h3 class="entry-title">
			<a
				href="<?php echo get_permalink(); ?>"
				class="post-link-catchable"
				data-url="<?php echo get_permalink(); ?>"
				data-image="<?php echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); ?>"
				data-term="slot-<?php echo $counter; ?>"
			>
				<?php echo the_title();?>
			</a>
		</h3>
	</div>
</div>
