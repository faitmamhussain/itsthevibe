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

	wp_enqueue_script( 'news-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'Swiper', '//cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js' );
	wp_enqueue_script( 'scroll-changing-url', get_bloginfo( 'stylesheet_directory' ) . '/js/scroll-changing-url.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'FB-share', get_bloginfo( 'stylesheet_directory' ) . '/js/FB-share.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Raleway:400,700|PT+Sans:400,700|Pathway+Gothic+One', array(), CHILD_THEME_VERSION );
	wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
	wp_enqueue_style('Swiper-css','//cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css');
	
}

//* Add new image sizes
add_image_size( 'home-bottom', 150, 150, TRUE );
add_image_size( 'home-middle', 348, 180, TRUE );
add_image_size( 'home-top', 740, 400, TRUE );

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

//* Add support for 6-column footer widgets
add_theme_support( 'genesis-footer-widgets', 6 );

//* Reposition the secondary navigation
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav' );

//* Hook after entry widget after the entry content
add_action( 'genesis_after_entry', 'news_after_entry', 5 );
function news_after_entry() {

	if ( is_singular( 'post' ) )
		genesis_widget_area( 'after-entry', array(
			'before' => '<div class="after-entry" class="widget-area">',
			'after'  => '</div>',
		) );

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'news_remove_comment_form_allowed_tags' );
function news_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home - Top', 'news' ),
	'description' => __( 'This is the top section of the homepage.', 'news' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle-left',
	'name'        => __( 'Home - Middle Left', 'news' ),
	'description' => __( 'This is the middle left section of the homepage.', 'news' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle-right',
	'name'        => __( 'Home - Middle Right', 'news' ),
	'description' => __( 'This is the middle right section of the homepage.', 'news' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-bottom',
	'name'        => __( 'Home - Bottom', 'news' ),
	'description' => __( 'This is the bottom section of the homepage.', 'news' ),
) );
genesis_register_sidebar( array(
	'id'          => 'after-entry',
	'name'        => __( 'After Entry', 'news' ),
	'description' => __( 'This is the after entry section.', 'news' ),
) );

//add foter navigation menu
add_theme_support ( 'genesis-menus' , array (
	'primary'   => __( 'Primary Navigation Menu', 'genesis' ),
	'secondary' => __( 'Secondary Navigation Menu', 'genesis' ),
	'footer'    => __( 'Footer Navigation Menu', 'genesis' )
) );

//add dns lookup
add_action( 'genesis_doctype', function(){
	?>
	<link rel="dns-prefetch" href="//cdn.itsthevibe.com">
	<link rel="dns-prefetch" href="//www.itsthevibe.com">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<link rel="dns-prefetch" href="//www.googletagservices.com">
	<link rel="dns-prefetch" href="//www.googletagmanager.com">
	<link rel="dns-prefetch" href="//pagead2.googlesyndication.com">
	<link rel="dns-prefetch" href="//fonts.googleapis.com">
	<link rel="dns-prefetch" href="//maxcdn.bootstrapcdn.com">
	<link rel="dns-prefetch" href="//cdn.taboola.com">
	<link rel="dns-prefetch" href="//pixel.quantserve.com">
	<link rel="dns-prefetch" href="//web.adblade.com">
	<link rel="dns-prefetch" href="//www.facebook.com">
	<link rel="dns-prefetch" href="//platform.twitter.com">
	<link rel="dns-prefetch" href="//pixel.quantserve.com">
	<link rel="dns-prefetch" href="//trends.revcontent.com">
	<link rel="dns-prefetch" href="//cdn.revcontent.com">
	<link rel="dns-prefetch" href="//labs-cdn.revcontent.com">
	<link rel="dns-prefetch" href="//publishers.revcontent.com">
	<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
	<?php
}, 5 );

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

//add fixes for floating left sidebar
add_filter("genesis_attr_site-container", function($attributes){

	$site_layout = genesis_site_layout();

	if ( $site_layout == 'sidebar-content-sidebar' && strpos($attributes['class'], 'site-container') !== false ){
		$attributes['class'] .= ' has-left-sidebar';
	}

	return $attributes;
});

/** Force sidebar-content-sidebar layout */
add_filter( 'genesis_pre_get_option_site_layout', 'child_do_layout' );
function child_do_layout( $opt ) {
	if ( in_category('slideshows') || is_category('slideshows')) { // Modify the conditions to apply the layout to here
		$opt = 'sidebar-content-sidebar'; // You can change this to any Genesis layout
		return $opt;
	}
}

//hide page titles on some pages
add_action( 'genesis_entry_header', function(){
	if( is_page() && (is_front_page() || is_page('end-slideshow')) ) {
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

//Remove post tags from all posts
add_filter('genesis_post_meta', function($post_meta){
	return str_replace('[post_tags]', '', $post_meta);
});

add_action('genesis_after_entry', 'add_infinite_scroll', 99999);

function add_infinite_scroll(){
	if(is_singular('post') && ! is_home() && ! is_front_page() && class_exists('AjaxLoadMore')){
		$post = get_post();

		$cat = itv_get_primary_category($post);

		echo do_shortcode('[ajax_load_more post_type="post" post__not_in="'.$post->ID.'" category="'.$cat->slug.'" posts_per_page="1" max_pages="0" container_type="div"]');
	}
}

if (!defined('ALM_REPEATER_PATH')){
	define('ALM_REPEATER_PATH', get_stylesheet_directory().'/' );
}

add_action('alm_repeater_installed', function(){});

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
add_action( 'genesis_before_entry_content' , 'itv_facebook_share' );

function itv_facebook_share(){
	if(is_single() && ! is_page() && ! is_home() && ! is_front_page() && ! is_404()){
		$shareURL = get_permalink();
		include('lib/fb/FB-share-like.php');
	}
}

//add facebook share button after every single post
add_action( 'genesis_after_entry_content' , 'itv_social_share_buttons' );

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

add_action('genesis_after_entry', 'add_ad_block_after_post', 99998);

function add_ad_block_after_post(){
	if(function_exists ('adinserter') && ! is_home() && ! is_front_page() ) echo adinserter (1);
}

add_action('genesis_before', 'add_google_tag_manager', 5);

function add_google_tag_manager(){
	echo '<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-P8TJTK" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':
new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=
\'//www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,\'script\',\'dataLayer\',\'GTM-P8TJTK\');</script>';
}

function itv_get_primary_category($post = null){

	$post = get_post($post);

	if(empty($post)){
		return false;
	}

	$primary_category = get_post_meta($post->ID, '_yoast_wpseo_primary_category', true);

	if( empty($primary_category) ){
		$primary_category = wp_get_post_categories($post->ID)[0];
	}

	$cat = get_category($primary_category);

	return $cat;
}

//remove categories from under the post
remove_action( 'genesis_entry_footer', 'post_meta');
add_filter( 'genesis_post_categories_shortcode', function(){return '';}, 100 );
add_filter( 'genesis_attr_entry-meta-after-content', function(){return '';}, 100 );

//add revcontent exit pop (desktop only)
function revcontent_exit_pop() {
	$script = '<script type="text/javascript" id="rev2exit" src="http://labs-cdn.revcontent.com/build/revexit.min.js?w=29260&p=21367&k=f70853a271747e8e1f3ffef5a48ea50a20beed84&d=itsthevibe.com&t=false&i=none&x=true&z=10"></script>';
	if(class_exists('MobileSmartShortcodes')){
		echo do_shortcode('[is_desktop]'.$script.'[/is_desktop]');
	} else {
		echo $script;
	}
}
add_action( 'wp_footer', 'revcontent_exit_pop', 100 );

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
add_filter('alm_modify_query_args', function($args, $slug){
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
		'ITV_Article'		=> (is_single() && !in_category('slideshows') && !is_page() && !is_404())
	);
	$thisPageType = array_shift(array_keys(array_filter($pageChecks)));
}, 1 );

add_action('wp_head', function(){
	global $thisPageType;
	//JS code for setting utm-params, mobile detection and helpers.
	include_once(get_stylesheet_directory() . '/lib/utm-params-js.php');
	if($thisPageType == 'ITV_Article'){
		//Included only on article pages. JS code to fire virtual pageviews.
		include_once(get_stylesheet_directory() . '/lib/virtual-pageview-js.php');
	}

	if( !isMobile() || ( isMobile() && in_category('slideshows') && is_single() ) ){
		include_once(get_stylesheet_directory() . '/lib/slideshow-custom-menu.php');
	}
}, 10);

function kill_slideshows_redirect() {
	if (in_category('slideshows')) {
		add_action('redirect_canonical','__return_false');
	}
}
add_action('template_redirect','kill_slideshows_redirect',1);

function get_permalink_with_utm(){
	$url = get_permalink();
	$itv_targeting = array(
		'utm_source',
		'utm_campaign',
		'utm_medium',
		'utm_content',
		'utm_term',
		'test'
	);

	foreach($itv_targeting as $target){
		$param = isset($_COOKIE['itv_'.$target]) ? $_COOKIE['itv_'.$target] : false;
		if(!empty($param)){
			$url = add_query_arg($target, $param, $url);
		}
	}

	return $url;
}

add_shortcode('slideshow-share', function($atts, $content){
	$shareURL = get_site_url() . strtok($_SERVER["REQUEST_URI"],'?');
	$post_title_full = get_the_title();
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
		<?php if(in_category('slideshows') && is_single()){ ?>
		<a class="slideshow-button" href="#">
			<span>Next</span>
			<i class="fa fa-2x fa-chevron-right" aria-hidden="true"></i>
		</a>
		<?php } ?>
	</div>
	<?php
	$html = ob_get_clean();
	return $html;
});

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

//* Custom Slideshow
include_once( get_stylesheet_directory() . '/lib/custom-slideshow.php' );

//* Featured Posts
include_once( get_stylesheet_directory() . '/lib/featured-posts.php' );
