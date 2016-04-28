<?php

remove_shortcode( 'ajax_load_more' );
add_shortcode('ajax_load_more', function(){
   return '';
});

//hack for full post display
global $wp_query, $post, $itv_has_slideshows_cat;

$wp_query->is_singular = true;
$wp_query->is_single = true;

do_action( 'genesis_before_entry' );

$title = apply_filters( 'genesis_post_title_text', get_the_title() );
$title = apply_filters( 'single_post_title', $title);
$sep = apply_filters( 'document_title_separator', '-' );
$title = $title.' '.$sep.' '.get_bloginfo( 'name', 'display' );
$post_title = $post->post_title;
$slug = $post->post_name;
$tracker = $itv_has_slideshows_cat ? 'slideshowTracker.' : '';

$anchor_url = get_permalink_with_utm();
$atts = array(
    'data-anchor-url' => $anchor_url,
    'data-anchor-title' => $title,
    'data-anchor-tracker' => $tracker,
    'data-anchor-slug' => $slug,
    'data-anchor-post-title' => $post_title,
);

printf( '<article %s>', genesis_attr( 'entry', $atts ) );

do_action( 'genesis_entry_header' );

do_action( 'genesis_before_entry_content' );

printf( '<div %s >', genesis_attr( 'entry-content' ) );
do_action( 'genesis_entry_content' );
echo '</div>';

do_action( 'genesis_after_entry_content' );

do_action( 'genesis_entry_footer' );

echo '</article>';

do_action( 'genesis_after_entry' );

$wp_query->is_singular = false;
$wp_query->is_single = false;
