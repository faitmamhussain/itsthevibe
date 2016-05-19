<?php
/** 
 * Plugin Name:Feeds Posts
 * Plugin URI: #
 * Description: Add feeds from feeds url and update new feeds after every three hours
 * Version: 0.1
 * Author: Indi IT
 * Author URI: #
 * License: GPL2
*/


register_activation_hook( __FILE__,  'sp_feeds_activate' );
register_deactivation_hook( __FILE__,  'sp_feeds_deactivate' );

function sp_feeds_activate() {
	$timestamp = wp_next_scheduled( 'sp_feeds_cron' );

	if( ! $timestamp ){
		wp_schedule_event( time(), 'once_in_3_hours', 'sp_feeds_cron' );
	}
}

function sp_feeds_deactivate() {
	wp_clear_scheduled_hook( 'sp_feeds_cron' );
}

if( is_admin() ){
	add_action( 'admin_enqueue_scripts', 'sp_feeds_ui_scripts' );
	add_action('admin_menu', 'sp_feeds_menu');
	add_action( 'admin_init', 'register_sp_feeds_settings' );
}

add_action( 'sp_feeds_cron', 'sp_feeds_auto_import' );

add_filter( 'cron_schedules', function($schedules) {
	$schedules['once_in_3_hours'] = array(
		'interval' => 3 * 60 * 60,
		'display' => __( 'Once in three hours' )
	);
	return $schedules;
});


function sp_feeds_menu(){
	add_menu_page( 'Import Feeds', 'Import Feeds', 'manage_options', 'imp-feeds', 'sp_feeds_add_menu','dashicons-rss' );
}

function sp_feeds_ui_scripts() {
	wp_enqueue_style( 'ui', plugins_url() . '/feeds/ui.css' );
	wp_enqueue_script( 'ui-js', plugins_url() . '/feeds/addmore.js', array(), '0.1', true  );
}

function register_sp_feeds_settings(){
	register_setting( 'sp-feeds-option-group', 'sp_feeds_urls' );
}

function sp_feeds_add_menu() {
	if(isset($_GET['delete'])){
		$m = $_GET['delete'] == 1 ? "<div id='actionmsg' class='actionmsg'>Successfully Deleted Url</div>" : "<div id='actionmsg' class='actionmsg'>Database Error - Not Deleted!</div>";
		echo $m;
	}
	if(isset($_GET['add'])){ 
		$m = $_GET['add'] == 1 ? "<div id='actionmsg' class='actionmsg'>Successfully Added Url</div>" : "<div id='actionmsg' class='actionmsg'>Database Error - Not Saved!</div>";
		echo $m;
	}
	if(isset($_GET['create'])){
		$m = $_GET['create'] == 1 ? "<div id='actionmsg' class='actionmsg'>Success! The post's created successfully</div>" : "<div id='actionmsg' class='actionmsg'>Database Error - Not created!</div>";
		echo $m;
	}
	if(isset($_GET['exists'])){ 
		$m = $_GET['exists'] == 1 ? "<div id='actionmsg' class='actionmsg'>Feeds already exists.No Duplicate entries allowed</div>" : "<div id='actionmsg' class='actionmsg'>Success! The post's created successfully</div>";
		echo $m;
	}
	?>
	<div class="formstyle">
		<div class="headtitle"><?php _e('Import feeds one time');?></div>
		<form action="" method="post">
			<label><?php _e('Please Enter the feed url which you want to import feeds :');?></label>
			<input type="text" name="feed_url" placeholder="Enter Feed Url" />
			<input type="submit" name="import_feed" value="Import feeds" />
		</form>
	</div>
	
	<div class="formstyle">
		<div class="headtitle"><?php _e('Import feeds after every three hours interval');?></div>
		<form action="options.php" method="post">
			<?php wp_nonce_field('update-options'); ?>
			<label><?php _e('Please Enter the feed url whcih you want to import feeds :');?></label> 
			<div class="input_fields_wrap">
				<?php 
				$datainput = get_option('sp_feeds_urls');
				if(!empty($datainput)){
				?>
				<button class="add_field_button"><?php _e('Add More Fields');?></button>
				<?php 
				foreach($datainput as $inputurl){
					echo '<div><input type="text" name="sp_feeds_urls[]" value="'.$inputurl.'" /><a href="?page=imp-feeds&action=delete&id='.$inputurl.'" class="remove_field_int">Remove</a></div>';
				}
				}else{
					?>
					<button class="add_field_button"><?php _e('Add More Fields');?></button>
					<div><input type="text" name="sp_feeds_urls[]" placeholder="Enter Feed Url" /></div>
					<?php 
				}
				?>
			</div>
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="sp_feeds_urls" />
			<input type="submit" value="Save Urls" />
		</form>
	</div>
	<?php 
	if(isset($_POST['import_feed'])){

		$status = sp_import_feeds($_POST['feed_url']);

		if ( empty($status) ) {
			echo "<script> window.location='?page=imp-feeds&create=0'; </script>";
		} else {
			echo "<script> window.location='?page=imp-feeds&create=1'; </script>";
		}
	}
	
	if(isset($_GET['action'])){
		$urlid = $_GET['id'];

		$datainput = get_option('sp_feeds_urls');

		$key = array_search($urlid, $datainput);

		if( is_numeric($key) ) {
			unset($datainput[$key]);
			update_option('sp_feeds_urls', $datainput);
		}
		
		if(is_numeric($key)){
			echo "<script> window.location='?page=imp-feeds&delete=1'; </script>";
		}else{
			echo "<script> window.location='?page=imp-feeds&delete=0'; </script>";
		}
	}
	
}

function sp_import_feeds($url) {
	global $wpdb;

	$news_cat = get_cat_id('News');

	$content = file_get_contents($url);
	$status = $content ? true : false;

	$x = new SimpleXmlElement($content);

	foreach($x->channel->item as $entry) {

		//allow one minute per post
		set_time_limit(60);

		$slug = sanitize_title($entry->title);
		$post_title = sanitize_post_field( 'post_title', $entry->title, 0, 'db' );
		$sanitized_slug = sanitize_title($post_title);

		// check if posts already exists
		$by_title = get_page_by_title($entry->title, ARRAY_A, 'post');
		$by_sanitized_title = ($post_title != $entry->title) ? get_page_by_title($post_title, ARRAY_A, 'post') : $by_title;
		$by_slug = get_posts(array('name' => $slug, 'post_type' => 'post', 'numberposts' => 1, 'post_status' => 'any'));
		$by_sanitized_slug = ($slug != $sanitized_slug) ? get_posts(array('name' => $sanitized_slug, 'post_type' => 'post', 'numberposts' => 1, 'post_status' => 'any')) : $by_slug;

		if(empty($by_title) && empty($by_slug) && empty($by_sanitized_slug) && empty($by_sanitized_title)){
			// insert posts
			$imagedownloadcontent = $entry->description;

			$content= $entry->description;
			$content = preg_replace("/<img[^>]+\>/i", " ", $content);
			$doc = new DOMDocument();
			$doc->loadHTML($imagedownloadcontent);
			$xpath = new DOMXPath($doc);
			$src = $xpath->evaluate("string(//img/@src)");

			if( ! empty($news_cat) ) {
				$post_id = wp_insert_post(array(
					'post_type'       => "post",
					'post_content'    => $content , // description
					'post_title'      => $entry->title, // title
					'post_name'       => $slug, // i.e. 'GA'; this is for the URL
					'post_status'     => "pending",
					'post_category' => array($news_cat),
					'post_author' => 1
				));

				update_post_meta($post_id, '_yoast_wpseo_primary_category', $news_cat);
				
			} else {
				$post_id = wp_insert_post(array(
					'post_type'       => "post",
					'post_content'    => $content , // description
					'post_title'      => $entry->title, // title
					'post_name'       => $slug, // i.e. 'GA'; this is for the URL
					'post_status'     => "pending",
					'post_author' => 1
				));
			}

			$filename = $src;
			$uploads = wp_upload_dir();
			$upload_path = $uploads['basedir'];
			$uplfile = $upload_path."/".time().".jpg";

			$imgcontent = file_get_contents($filename);
			//Store in the filesystem.
			$fp = fopen($uplfile, "w");
			fwrite($fp, $imgcontent);
			fclose($fp);

			$wp_filetype = wp_check_filetype(basename($uplfile), null );
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => preg_replace('/\.[^.]+$/', '', basename($uplfile)),
				'post_content' => '',
				'post_status' => 'pending'
			);

			if( ! function_exists('wp_generate_attachment_metadata') ) {
				require ( ABSPATH . 'wp-admin/includes/image.php');
			}

			$attach_id = wp_insert_attachment( $attachment, $uplfile, $post_id );
			$attach_data = wp_generate_attachment_metadata( $attach_id, $uplfile);
			wp_update_attachment_metadata( $attach_id, $attach_data );
			add_post_meta($post_id, '_thumbnail_id', $attach_id, true);

		}
	}

	return $status;
}

function sp_feeds_auto_import(){
	$feeds = get_option('sp_feeds_urls');
	if(!empty($feeds)){
		foreach($feeds as $feed){
			sp_import_feeds($feed);
		}
	}
}