<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'news', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'news' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'News Pro Theme', 'news' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/news/' );
define( 'CHILD_THEME_VERSION', '3.0.2' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'news_load_scripts' );
function news_load_scripts() {

	global $thisPageType, $post;

	wp_enqueue_script( 'news-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ));
	wp_enqueue_script( 'Swiper', '//cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js' );
	wp_enqueue_script( 'FB-share', get_bloginfo( 'stylesheet_directory' ) . '/js/FB-share.js', array( 'jquery' ));

	if( !isMobile() || ( in_category('slideshows') && is_single() ) )
		wp_enqueue_script( 'slideshow-custom-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/slideshow-custom-menu.js', array( 'jquery' ));

	if(!is_page('end-slideshow') && is_single() && !in_category('slideshows') && !is_page('apple')){
		wp_enqueue_script( 'ScrollMagic', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js' );
		wp_enqueue_script( 'scroll-changing-url', get_bloginfo( 'stylesheet_directory' ) . '/js/scroll-changing-url.js', array( 'jquery' ));
	} elseif( ! is_page('apple') ) {
		wp_enqueue_script( 'slideshow-js', get_bloginfo( 'stylesheet_directory' ) . '/js/slideshow.js', array( 'jquery' ));
	}

	//JS code for setting utm-params, mobile detection and helpers.
	wp_register_script( 'sp-helpers', get_bloginfo( 'stylesheet_directory' ) . '/js/helpers.js', array( 'jquery' ));
	wp_register_script( 'utm-params', get_bloginfo( 'stylesheet_directory' ) . '/js/utm-params.js', array( 'sp-helpers' ));
	$translation_array = [
		'id' => $post->ID,
		'slug' => substr($post->post_name, 0, 40),
		'type' => $thisPageType,
		'tags' => preg_replace('/[^a-zA-Z 0-9]+/', '', wp_get_post_tags($post->ID, array('fields' => 'names')))
	];
	wp_localize_script( 'utm-params', 'post', $translation_array );
	wp_enqueue_script( 'utm-params');
	wp_enqueue_script( 'itv.ads.config', get_bloginfo( 'stylesheet_directory' ) . '/js/sp.native.ads.config.js', array( 'jquery', 'utm-params' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Raleway:400,700|PT+Sans:400,700|Pathway+Gothic+One', array(), CHILD_THEME_VERSION );
	wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
	wp_enqueue_style('Swiper-css','//cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css');
	
}

//image for facebook preview
add_image_size( 'fb-share', 600, 314, array( 'center', 'top' ) );

//image for post previews (custom posts)
add_image_size( 'custom-post', 300, 300, true );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'header_image'    => '',
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'height'          => 58,
	'width'           => 154,
) );

//* Add support for additional color style options
add_theme_support( 'genesis-style-selector', array(
	'news-pro-blue'   => __( 'News Pro Blue', 'news' ),
	'news-pro-green'  => __( 'News Pro Green', 'news' ),
	'news-pro-pink'   => __( 'News Pro Pink', 'news' ),
	'news-pro-orange' => __( 'News Pro Orange', 'news' ),
) );

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'news_remove_comment_form_allowed_tags' );
function news_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//add footer navigation menu
add_theme_support ( 'genesis-menus' , array (
	'primary'   => __( 'Primary Navigation Menu', 'genesis' ),
	'secondary' => __( 'Secondary Navigation Menu', 'genesis' ),
	'footer'    => __( 'Footer Navigation Menu', 'genesis' )
) );

//add dns lookup
add_action( 'genesis_meta', function(){
	?><link rel="dns-prefetch" href="//cdn.itsthevibe.com">
<link rel="dns-prefetch" href="//www.itsthevibe.com">
<link rel="dns-prefetch" href="//www.google-analytics.com">
<link rel="dns-prefetch" href="//www.googletagservices.com">
<link rel="dns-prefetch" href="//www.googletagmanager.com">
<link rel="dns-prefetch" href="//pagead2.googlesyndication.com">
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="dns-prefetch" href="//maxcdn.bootstrapcdn.com">
<link rel="dns-prefetch" href="//cdn.taboola.com">
<link rel="dns-prefetch" href="//pixel.quantserve.com">
<link rel="dns-prefetch" href="//secure.quantserve.com">
<link rel="dns-prefetch" href="//edge.quantserve.com">
<link rel="dns-prefetch" href="//web.adblade.com">
<link rel="dns-prefetch" href="//www.facebook.com">
<link rel="dns-prefetch" href="//platform.twitter.com">
<link rel="dns-prefetch" href="//trends.revcontent.com">
<link rel="dns-prefetch" href="//cdn.revcontent.com">
<link rel="dns-prefetch" href="//labs-cdn.revcontent.com">
<link rel="dns-prefetch" href="//publishers.revcontent.com">
<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="//b.scorecardresearch.com">
<link rel="dns-prefetch" href="//sb.scorecardresearch.com">
<link rel="dns-prefetch" href="//apex.go.sonobi.com">
<link rel="dns-prefetch" href="//acdn.adnxs.com">
<link rel="dns-prefetch" href="//adserver.adtechus.com">
<link rel="dns-prefetch" href="//ap.lijit.com">
<link rel="dns-prefetch" href="//gslbeacon.lijit.com">
<link rel="dns-prefetch" href="//ads.pubmatic.com">
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link rel="dns-prefetch" href="//google-analytics.com">
<link rel="dns-prefetch" href="//googletagservices.com">
<link rel="dns-prefetch" href="//ad.doubleclick.net">
<link rel="dns-prefetch" href="//partner.googleadservices.com">
<link rel="dns-prefetch" href="//i.yldbt.com">
<link rel="dns-prefetch" href="//cdn.yldbt.com">
<link rel="dns-prefetch" href="//aka-cdn.adtechus.com">
<link rel="dns-prefetch" href="//aka-cdn-ns.adtechus.com">
<link rel="dns-prefetch" href="//js.indexww.com">
<link rel="dns-prefetch" href="//as.casalemedia.com/">
<link rel="dns-prefetch" href="//c.amazon-adsystem.com">
<link rel="dns-prefetch" href="//fls-na.amazon-adsystem.com">
<link rel="dns-prefetch" href="//rcm-na.amazon-adsystem.com">
<link rel="dns-prefetch" href="//ecx.images-amazon.com">
<link rel="dns-prefetch" href="//aax.amazon-adsystem.com/">
<link rel="dns-prefetch" href="//ws-na.amazon-adsystem.com/">
<link rel="dns-prefetch" href="//z-na.amazon-adsystem.com">
<link rel="dns-prefetch" href="//ib.adnxs.com">
<?php
}, 5 );

//get utm params from cookies
add_action('genesis_doctype', 'get_utm_params');
function get_utm_params(){
	global $custom_utm_params;

	$custom_utm_params = array();

	$targeting = array(
		'utm_source',
		'utm_campaign',
		'utm_medium',
		'utm_content',
		'utm_term',
		'test'
	);

	foreach($targeting as $target){
		$param = isset($_COOKIE['itv_'.$target]) ? $_COOKIE['itv_'.$target] : false;
		if(!empty($param)){
			$custom_utm_params[$target] = $param;
		}
	}
}

//make header full width on all pages
add_filter( 'genesis_attr_site-header', function($atts){
//	if(is_front_page()){
		if(! empty($atts['class'])){
			$atts['class'] .= ' full-width-head';
		} else {
			$atts['class'] = ' full-width-head';
		}
//	}
	return $atts;
}, 100 );

//wp seo open graph image size override for facebook
add_filter('wpseo_opengraph_image_size', function($size){
	if(has_image_size('fb-share')){
		$size = 'fb-share';
	}
	return $size;
});

/** Force sidebar-content-sidebar layout */
add_filter( 'genesis_pre_get_option_site_layout', 'itv_slideshow_layout' );
function itv_slideshow_layout( $opt ) {
	if ( in_category('slideshows') && !is_category()){ // Modify the conditions to apply the layout to here
		$utm_source = (isset($_GET['utm_source']) ? strtolower($_GET['utm_source']) : strtolower($_COOKIE['itv_utm_source']));

		$url = $_SERVER['REQUEST_URI'];
		$last_url_segment = basename(parse_url($url, PHP_URL_PATH));
		$first_page_allowed_source = ['outbrain', 'taboola', 'taboola_native', 'taboola_organic', 'revcontent', '3lift', 'brt', 'instagram', 'cad', 'adblade', 'twitter'];
		$second_page_allowed_source = ['outbrain', 'taboola', 'taboola_native', 'taboola_organic', 'revcontent', '3lift', 'brt', 'instagram', 'cad', 'adblade', 'twitter', 'fb', 'gemini', 'google', 'edge', 'pinterest', 'yahoo', 'g4', 'shrd', 'bgard'];

		//page 1 & page 2
		if(is_page('end-slideshow') || (!is_numeric($last_url_segment) && in_array($utm_source, $first_page_allowed_source)) || (is_numeric($last_url_segment) && in_array($utm_source, $second_page_allowed_source))){
			$opt = 'sidebar-content-sidebar'; //set layout with left sidebar
		}
	}
	return $opt;
}

//* Reposition the secondary navigation
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action('genesis_header', 'genesis_do_subnav', 9);

//hide the main menu on first page load
add_filter('wp_nav_menu', function($nav_menu, $args = []){
	if( ! empty($args->menu) && is_object($args->menu) && ! empty($args->menu->slug) ) {

		if($args->menu->slug == 'main-navigation') {
			$nav_menu = '<style type="text/css">@media only screen and (max-width: 1023px){#menu-main-navigation, .nav-header .responsive-menu-icon{display: none !important;}}</style>' . $nav_menu;
		} elseif($args->menu->slug == 'secondary-navigation') {
			$nav_menu = '<style type="text/css">#menu-secondary-navigation{display: none;}</style>' . $nav_menu;
		}
	}
	return $nav_menu;
}, 15, 2);

//add social icons to bottom
add_filter( 'wp_nav_menu_secondary-navigation_items', function($items, $args = []){
	$items .= '<li><div class="header-social-icons">
		<a href="https://www.facebook.com/Its-The-Vibe-1064149386940758/" target="_blank"><i class="fa fa-fw fa-facebook"></i></a>
		<a href="https://www.instagram.com/its_the_vibe/" target="_blank"><i class="fa fa-fw fa-instagram"></i></a>
		<a href="https://www.pinterest.com/itsthevibe/" target="_blank"><i class="fa fa-fw fa-pinterest"></i></a>
		</div></li>';
	return $items;
}, 15, 2 );

add_filter( 'genesis_search_form',function($form, $search_text, $button_text, $label){

	$form .= '<div class="search-button"><i class="fa fa-search fa-fw" aria-hidden="true"></i></div>';

	return $form;
}, 11, 4);

//hide page titles on some pages
add_action( 'genesis_entry_header', function(){
	if( is_page() && (is_front_page() || is_page('end-slideshow') || is_page('apple')) ) {
		itv_remove_page_title();
	}
}, 3);

function itv_remove_page_title(){
	remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
}

//remove "Advertisement" from post excerpt (for twitter and facebook share)
add_filter('get_the_excerpt', function($excerpt){
	return trim(str_replace('Advertisement', '', $excerpt));
}, 99999);

//Remove post tags from all posts
add_filter('genesis_post_meta', function($post_meta){
	return str_replace('[post_tags]', '', $post_meta);
});

add_action('genesis_after_entry', 'add_infinite_scroll', 99999);

function add_infinite_scroll(){

	if( is_singular('post') && ! is_home() && ! is_front_page() && ! has_category('slideshows') ){

		$post = get_post();
		$cat = itv_get_primary_category($post);

		if( class_exists('AjaxLoadMore') ){
			if(isMobile()){
				echo do_shortcode('[ajax_load_more post_type="post" post__not_in="'.$post->ID.'" category="'.$cat->slug.'" posts_per_page="6" max_pages="1" scroll_distance="-500" repeater="repeater"]');
			} else {
				echo do_shortcode('[ajax_load_more post_type="post" post__not_in="'.$post->ID.'" category="'.$cat->slug.'" posts_per_page="1" max_pages="0" scroll_distance="-500" container_type="div"]');
			}
		}
	}
}

//add infinite scroll instead of pagination in category, archive and search
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
add_action( 'genesis_after_endwhile', 'sp_add_alm_shortcode');


function sp_add_alm_shortcode(){
	if( is_singular() )
		return;

	global $wp_query;

	if( $wp_query->max_num_pages <= 1 )
		return;

	$posts_per_page = get_query_var( 'posts_per_page' ) ? absint( get_query_var( 'posts_per_page' ) ) : 1;

	$query_string = '';
	$custom_args = '';

	$alm_fields = array(
		's' => 'search',
		'category_name' => 'category',
		'author_name' => 'author'
	);

	$repeater = $wp_query->is_category ? 'repeater1category' : ($wp_query->is_archive ? 'repeater1archive' : ($wp_query->is_search ? 'repeater1search' : 'repeater1category'));

	foreach($wp_query->query as $key => $val){
		if(array_key_exists($key, $alm_fields)){
			$query_string .= ' '.$alm_fields[$key].'="'.$val.'"';
		} else {
			$custom_args .= $key.':'.$val.',';
		}
	}

	echo do_shortcode('[ajax_load_more post_type="post" posts_per_page="'.$posts_per_page.'" offset="'.$posts_per_page.'"'.$query_string.' custom_args="'.$custom_args.'" max_pages="0" scroll_distance="-500" container_type="div" repeater="'.$repeater.'"]');
}

if (!defined('ALM_REPEATER_PATH')){
	define('ALM_REPEATER_PATH', get_stylesheet_directory().'/' );
}

add_action('alm_repeater_installed', function(){});

add_shortcode('alm_repeater_preload', function($atts, $content){

	extract(shortcode_atts(array(
		'posts_per_page' => '9',
		'section_name' => 'slideshow'
	), $atts));

	$args = array(
		'posts_per_page' => $posts_per_page,
		'section_name' => $section_name
	);

	ob_start();

	global $wp_query, $post;

	$old_query = $wp_query;
	$old_post = $post;

	query_posts($args);

	while ( have_posts() ){
		the_post();
		include( get_stylesheet_directory() . '/repeaters/repeater.php' );
	};

	$output_string = ob_get_contents();;
	ob_end_clean();

	$wp_query = $old_query;
	$post = $old_post;

	$output_string .= '<script>jQuery(document).trigger( "customAlmComplete", [false] );</script>';

	return $output_string;
});

remove_filter( 'post_class', 'genesis_entry_post_class' );
add_filter( 'post_class', 'itv_entry_post_class' );

function itv_entry_post_class( $classes ) {
	if( ! in_array('entry', $classes) ){
		$classes[] = 'entry';

		//* Remove "hentry" from post class array, if HTML5
		if ( genesis_html5() ){
			$classes = array_diff( $classes, array( 'hentry' ) );
		}
	}
	return $classes;
}

//add facebook share button before every single post
add_action( 'genesis_after_entry' , 'itv_facebook_share' );

function itv_facebook_share(){
	if(is_single() && ! is_page() && ! is_home() && ! is_front_page() && ! is_404()){
		$shareURL = get_permalink();
		include('lib/fb/FB-share-like.php');
	}
}

//add facebook share button after every single post
add_action( 'genesis_before_entry' , 'itv_social_share_buttons' );

function itv_social_share_buttons(){

	if(is_single() && ! is_page() && ! is_home() && ! is_front_page() && ! is_404()){

		$shareURL = get_permalink();
		$post_title_full = get_the_title();
		include('lib/social-share-buttons.php');
		
	}

}

/* Display Featured Image on top of single post if content has no images */
add_filter( 'the_content', 'add_featured_image_to_post' );
function add_featured_image_to_post($content) {
	if ( is_singular() && ! is_page() ){

		$img_pos = strpos($content, 'img');

		//check if there is no img tag or shortcode in beginning
		if(empty($img_pos) || $img_pos > 100) {
			$content = get_the_post_thumbnail( null, 'post-image' ).$content;
		}
	}
	return $content;
}

// Make all images the link to next post on mobile pages, wrap images in <p> tag for ad inserter
add_filter( 'the_content', function($content) {
	if ( is_singular() && ! is_page() ){
		$splits = preg_split('/(<img[^>]+\>)/i', $content, -1, PREG_SPLIT_DELIM_CAPTURE);
		if(count($splits) >= 3){
			$next_post = get_next_post(true);
			$next_link = get_permalink($next_post->ID);
			foreach($splits as &$split){
				if(strpos($split,'<img') === 0){
					if(isMobile() && !empty($next_post)){
						$split = '<p><a href="'.$next_link.'">'.$split.'</a></p>';
					} else {
						$split = '<p>'.$split.'</p>';
					}
				}
			}
			$content = implode('',$splits);
		}
	}
	return $content;
}, 20);

add_action('genesis_after_entry', 'add_ad_block_after_post', 99998);

function add_ad_block_after_post(){
	if(function_exists ('adinserter') && ! is_home() && ! is_front_page() ) echo adinserter (1);
}

add_action('genesis_before', 'add_google_tag_manager', 5);

function add_google_tag_manager(){
	echo '<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-P8TJTK" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':new Date().getTime(),event:\'gtm.js\'});
var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';
j.async=true;j.src=\'//www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,\'script\',\'dataLayer\',\'GTM-P8TJTK\');</script>';
}

add_action('genesis_before', 'add_google_analytics', 6);

function add_google_analytics(){
	?><script>
		window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
		ga('create', 'UA-76802967-1', 'auto', 'ajaxTracker');
		ga('create', 'UA-77237275-1', 'auto', 'adblockTracker');
		ga('create', 'UA-75246817-1', 'auto');

		<?php send_google_analytics();?>

		<?php if(is_404()): ?>
			ga('send', 'event', '404 Error', document.referrer, '<?php echo $_SERVER["REQUEST_URI"]; ?>', {nonInteraction: true, anonymizeIp: false});
		<?php endif; ?>

		//adblock check
		var adblockTest = document.createElement('div');
		adblockTest.innerHTML = '&nbsp;';
		adblockTest.className = 'adsbox';
		document.body.appendChild(adblockTest);
		window.setTimeout(function() {
			if (adblockTest.offsetHeight === 0) {
				SP_OBJ.SESSION.ADS_BLOCKED = true;
				ga('adblockTracker.send', 'event', 'Ad Blocker check', 'Adblock', '<?php echo $_SERVER["REQUEST_URI"]; ?>');
				ga('adblockTracker.send', 'event', 'Ads Blocked', utm_source, '<?php echo $_SERVER["REQUEST_URI"]; ?>');
			} else {
				SP_OBJ.SESSION.ADS_BLOCKED = false;
				ga('adblockTracker.send', 'event', 'Ad Blocker check', 'no Adblock', '<?php echo $_SERVER["REQUEST_URI"]; ?>');
			}
			adblockTest.remove();
		}, 100);
	</script>
	<script async src='https://www.google-analytics.com/analytics.js'></script>
	<?php
}

function send_google_analytics(){

	global $post, $itv_has_slideshows_cat, $custom_utm_params;
	if( ! isset($itv_has_slideshows_cat) ){
		$itv_has_slideshows_cat = has_category('slideshows');
	}
	$title = $post->post_title;
	$slug = $post->post_name;
	$tracker = ( is_single() && ! $itv_has_slideshows_cat && ! is_page() ) ? 'ajaxTracker.' : '';
	$ga_utm = array(
		'utm_source' => 'campaignSource',
		'utm_campaign' => 'campaignName',
		'utm_medium' => 'campaignMedium',
		'utm_content' => 'campaignContent',
		'utm_term' => 'campaignKeyword',
	);
	?>
	ga('<?php echo $tracker; ?>set', {
		page: <?php echo json_encode($slug); ?>,
		title: <?php echo json_encode($title); ?>,
		allowLinker: false,
		anonymizeIp: false,
	<?php if( ! empty($custom_utm_params) && is_array($custom_utm_params) ){
		foreach($ga_utm as $utm => $ga){
			if(isset($custom_utm_params[$utm])){
				echo "$ga : ".json_encode($custom_utm_params[$utm]).",";
			} else {
				echo "$ga : '',";
			}
		}
	} ?>
	});
	ga('<?php echo $tracker; ?>send', 'pageview');
	<?php
}

function itv_get_primary_category($post = null){

	$post = get_post($post);

	if(empty($post)){
		return false;
	}

	$primary_category = get_post_meta($post->ID, '_yoast_wpseo_primary_category', true);

	if( empty($primary_category) ){
		if(has_category('news', $post->ID)) {
			$cat = get_category_by_slug('news');
		} elseif(has_category('entertainment', $post->ID)) {
			$cat = get_category_by_slug('entertainment');
		} else {
			$cat = get_the_category($post->ID)[0];
		}
	} else {
		$cat = get_category($primary_category);
	}

	return $cat;
}

//remove categories from under the post
remove_action( 'genesis_entry_footer', 'post_meta');
add_filter( 'genesis_post_categories_shortcode', function(){return '';}, 100 );
add_filter( 'genesis_attr_entry-meta-after-content', function(){return '';}, 100 );

//add revcontent exit pop (desktop only)
function revcontent_exit_pop() {
	$utm_source = (isset($_GET['utm_source']) ? strtolower($_GET['utm_source']) : strtolower($_COOKIE['itv_utm_source']));
	$exclude_utm_source = ['gemini', 'yahoo'];
	$url = $_SERVER['REQUEST_URI'];
	$last_url_segment = basename(parse_url($url, PHP_URL_PATH));

	if(!is_home() && !is_front_page() && !is_page('apple') && !(in_category('slideshows') && !is_numeric($last_url_segment) && in_array($utm_source, $exclude_utm_source))){
		echo '<script>if(typeof(ExitPop) == "function"){ExitPop();}</script>';
	}
}
add_action( 'wp_footer', 'revcontent_exit_pop', 1000 );

//facebook init
function itv_facebook_init(){
	?><script>
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '<?php echo (strpos(get_site_url(),".dev")) ? "771002713031348" : "769715033160116"; ?>',
				xfbml      : true,
				version    : 'v2.5'
			});
		};

		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script><?php
}

add_action('genesis_before', 'itv_facebook_init');

//remove genesis footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action('genesis_footer', function(){
	echo '<div class="footer-menu-wrap">';
	genesis_nav_menu( array(
		'theme_location' => 'footer',
		'container'       => 'div',
		'container_class' => 'wrap',
		'menu_class'     => 'menu genesis-nav-menu menu-footer',
		'depth'           => 1
	) );
	echo '</div>';
});

//connect AjaxLoadMore with MyPostsOrder
add_filter('alm_modify_query_args', function($args){
	if( array_key_exists('section_name', $args) ) {
		global $wp_query, $paged;
		$wp_query->query_vars = $args;

		if(isset($args['paged'])){
			$paged = $args['paged'];
		}
	}
	return $args;
});

remove_filter('post_limits', 'mpo_change_limit' );

add_action('genesis_doctype', function(){
	global $thisPageType;

	$pageChecks = array(
		'ITV_Home' 			=> is_front_page(),
		'ITV_404' 			=> (is_page('404page') || is_404()),
		'ITV_Category'		=> is_category(),
		'ITV_Slideshow' 	=> in_category('slideshows'),
		'ITV_End_Slideshow' => is_page('End Slideshow'),
		'ITV_Apple'         => is_page('apple'),
		'ITV_Article'		=> (is_single() && !in_category('slideshows') && !is_page() && !is_404())
	);
	$thisPageType = array_shift(array_keys(array_filter($pageChecks)));
}, 1 );

add_action('wp_head', function(){
	global $thisPageType;

	include_once(get_stylesheet_directory() . '/lib/header.php');

	if($thisPageType == 'ITV_Article'){
		//JS code to fire virtual pageviews.
		?><script type="text/javascript">
			(function ($) {
				$(document).on( "customAlmComplete", function( event, alm ) {
					sendVirtualPageView(alm);
				});
			})(jQuery);
		</script><?php
	}
}, 10);

function itv_kill_slideshows_redirect() {
	if (in_category('slideshows')) {
		add_action('redirect_canonical','__return_false');
	}
}
add_action('template_redirect','itv_kill_slideshows_redirect',1);

function get_permalink_with_utm(){
	global $custom_utm_params;

	$url = get_permalink();

	if( ! empty($custom_utm_params) && is_array($custom_utm_params) ) {
		foreach($custom_utm_params as $target => $param){
			if(!empty($param)){
				$url = add_query_arg($target, $param, $url);
			}
		}
	}

	return $url;
}

add_shortcode('slideshow-share', function($atts, $content){
	$shareURL = get_site_url() . strtok($_SERVER["REQUEST_URI"],'?');
	if(is_category()){
		$post_title_full = single_cat_title('', false);
	} else {
		$post_title_full = get_the_title();
	}

	$post_title = substr($post_title_full, 0, (40 - 3));
	$post_title = preg_replace('/ [^ ]*$/', ' ...', $post_title);

	global $thisPageType;

	ob_start(); ?>
	<div class="slideshow-menu-left">
		<h1 class="slideshow-post-title"><?php echo $post_title; ?></h1>
	</div><!--
 --><div class="slideshow-menu-right">
		<div class="header-social-icons">
			<a  href="#" data-href="<?php echo $shareURL;?>"
				data-layout="link" data-domain="itsthevibe"
				data-share-url="<?php echo $shareURL;?>"
				class="fb-share-button button-facebook">
				<i class="fa fa-fw fa-facebook"></i>
			</a>
			<a href="http://twitter.com/share?text=<?php echo urlencode($post_title_full); ?>&url=<?php echo urlencode($shareURL); ?>" target="_blank">
				<i class="fa fa-fw fa-twitter"></i>
			</a>
			<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode($shareURL); ?>&description=<?php echo urlencode($post_title_full); ?>" target="_blank">
				<i class="fa fa-fw fa-pinterest"></i>
			</a>
			<a href="whatsapp://send?text=<?php echo urlencode($post_title_full.' | '.$shareURL); ?>">
				<i class="fa fa-fw fa-whatsapp"></i>
			</a>
		</div>
		<?php
		$next_post = get_next_post(true);
		$next_link = in_category('slideshows') ? '#' : (! empty($next_post)) ? get_permalink($next_post->ID) : '';
		if(is_single() && ! empty($next_link)){
		?>
		<a class="slideshow-button" href="<?php echo $next_link;?>">
			<span>Next</span>
			<i class="fa fa-2x fa-chevron-right" aria-hidden="true"></i>
		</a>
		<?php } ?>
	</div>
	<?php
	$html = ob_get_clean();
	return $html;
});

//-------------------------Apple news hooks--------------------------------

//Add utm_source to link
add_filter( 'apple_news_metadata', function($meta, $id){

	$apple_utm = '?utm_source=apple&utm_medium=cpc';

	if( ! empty($meta['canonicalURL']) ) {
		if( $pos = strpos($meta['canonicalURL'], '?') ) {
			$meta['canonicalURL'] = substr_replace($meta['canonicalURL'], $apple_utm, $pos);
		} else {
			$meta['canonicalURL'] .= $apple_utm;
		}
	}

	return $meta;
}, 10, 2 );

//automatically add published posts to apple category
add_action( 'publish_post', function($ID, $post){
	if( ! has_category('slideshows', $ID) ){
		$cat_id = get_term_by( 'slug', 'apple', 'category' );
		wp_set_post_categories( $ID, array($cat_id->term_id), true );
	}
}, 10, 2);

if( isMobile() && $_SERVER['REQUEST_URI'] !== '/' ){

	if(is_page()){
		add_filter( "alm_modify_query_args", function($args, $slug){

			if(isset($args['posts_per_page'])){
				$args['posts_per_page'] = 6;
			}

			//allow only one page
			if( ! empty($args['offset'])){
				return array();
			}

			return $args;
		}, 10, 2 );
	}

	add_action('genesis_entry_footer', 'mobile_nav', 99999);

	function mobile_nav(){

		// For single post
		if( is_single() && ! has_category('slideshows') ){

			?>
			<div class="mobile-nav" >

				<?php if( $prev_link = get_previous_post_link( $format = '%link', $link = 'Prev post', $in_same_term = true, $excluded_terms = '', $taxonomy = 'category' ) ){ ?>
					<p class="prev-post" >
						<span class="fa fa-2x fa-chevron-left" ></span>
						<?php echo $prev_link; ?>
					</p>
				<?php } ?>

				<?php if( $next_link = get_next_post_link( $format = '%link', $link = 'Next post', $in_same_term = true, $excluded_terms = '', $taxonomy = 'category' ) ){ ?>
					<p class="next-post" >
						<?php echo $next_link; ?>
						<span class="fa fa-2x fa-chevron-right" ></span>
					</p>
				<?php } ?>

			</div>
			<?php
		}

	}

}

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

//* Custom Slideshow
include_once( get_stylesheet_directory() . '/lib/custom-slideshow.php' );

//* Featured Posts
include_once( get_stylesheet_directory() . '/lib/featured-posts.php' );

//Declare ads configuration
function itv_insert_after_body(){
	echo '<script type="text/javascript" async>DeclareITV();</script>';
}
add_action( 'genesis_before', 'itv_insert_after_body', 10 );

//Include footer
function itv_footer(){
	include_once( get_stylesheet_directory() . '/lib/footer.php' );
}
add_action( 'genesis_after', 'itv_footer');

//cover for embed
add_filter( 'embed_oembed_html', 'itv_custom_oembed_filter', 10, 4 ) ;
function itv_custom_oembed_filter($html, $url, $attr, $post_ID) {
	$return = '<div class="video-container">'.$html.'</div>';
	return $return;
}