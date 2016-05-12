<?php

remove_shortcode( 'ajax_load_more' );
add_shortcode('ajax_load_more', function(){
	return '';
});

global $wp_query;

$wp_query->is_search = true;

do_action( 'genesis_before_entry' );

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

$wp_query->is_search = false;