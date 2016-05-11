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
		
	global $wpdb;	
	
	$feeds_url = $wpdb->prefix.'feeds_url';
	
	$tbA = "CREATE TABLE ".$feeds_url." (
		url_id int(11) NOT NULL AUTO_INCREMENT,
		url varchar(200) NOT NULL,
		UNIQUE KEY url_id (url_id)
	)";
	
	$wpdb->query($tbA);

	//Use wp_next_scheduled to check if the event is already scheduled
	$timestamp = wp_next_scheduled( 'sp_feeds_schedule' );

	if( $timestamp == false ){
		wp_schedule_event( time(), 'once_in_3_hours', 'sp_feeds_cron' );
	}
	
}

function sp_feeds_deactivate() {
	
	global $wpdb;	
	 
	$feeds_url = $wpdb->prefix.'feeds_url';
	
	$tba = "DROP TABLE IF EXISTS $feeds_url";
	
	$wpdb->query($tba);
}

add_action('init','sp_feeds_init');

function sp_feeds_init() {
	add_action('admin_menu', 'sp_feeds_menu');
	add_action( 'admin_enqueue_scripts', 'sp_feeds_ui_scripts' );
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

function sp_feeds_add_menu() {
	global $wpdb;
	$args = array(
		'hide_empty' => false, 
	);	
	$taxonomy = 'category';
	$terms = get_terms($taxonomy, $args); // Get all terms of a taxonomy

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
			<label><?php _e('Please Enter the feed url whcih you want to import feeds :');?></label> 
			<input type="text" name="feed_url" placeholder="Enter Feed Url" />
			<?php 	
			/* if ( $terms && !is_wp_error( $terms ) ) :
			?>
			<!--- <ul>
				<?php foreach ( $terms as $term ) { ?>
					<li><input type="checkbox" name="feed_category[]" value="<?php // echo $term->term_id;?>" /> <a href="<?php // echo get_term_link($term->slug, $taxonomy); ?>"><?php // echo $term->name; ?></a></li>
				<?php }  ?>
			</ul> -->
			<?php endif; */
			?>
			<input type="submit" name="import_feed" value="Import feeds" />
		</form>
	</div>
	
	<div class="formstyle">
		<div class="headtitle"><?php _e('Import feeds after every three hours interval');?></div>
		<form action="" method="post" name="interval">
			<label><?php _e('Please Enter the feed url whcih you want to import feeds :');?></label> 
			<div class="input_fields_wrap">
				<?php 
				$datainput = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."feeds_url");
				if(!empty($datainput)){
				?>
				<button class="add_field_button"><?php _e('Add More Fields');?></button>
				<?php 
				foreach($datainput as $inputurl){
					echo '<div><input type="text" name="feed_url_int[]" value="'.$inputurl->url.'" /><a href="?page=imp-feeds&action=delete&id='.$inputurl->url_id.'" class="remove_field_int">Remove</a></div>';
				}
				}else{
					?>
					<button class="add_field_button"><?php _e('Add More Fields');?></button>
					<div><input type="text" name="feed_url_int[]" placeholder="Enter Feed Url" /></div>
					<?php 
				}
				?>
			</div>
			<input type="submit" name="import_feed_int" value="Save Urls" />
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
	
	if(isset($_POST['import_feed_int'])){
		$msg = array();
		foreach($_POST['feed_url_int'] as $url){
			$qry = "SELECT * FROM ".$wpdb->prefix."feeds_url WHERE url = '" . $url . "'"; 
			$result = $wpdb->get_row($qry);
			if(!empty($result)){
				$msg['message'] = "<div style='display:none'>URL already exists.No Duplicate entries allowed</div>";
			}else{
				$url = htmlspecialchars($url);
				$qry = $wpdb->insert($wpdb->prefix.'feeds_url', array('url' => $url), array('%s'));
				if($qry){
					$msg['message'] = "<script> window.location='?page=imp-feeds&add=1'; </script>";
				}else{
					$msg['message'] = "<script> window.location='?page=imp-feeds&add=0'; </script>";
				}
			}
		}
		
		if(!empty($msg)){
			echo $msg['message']; 
		}
	}
	
	if(isset($_GET['action'])){
		$urlid = $_GET['id'];
		$qry = "DELETE FROM ".$wpdb->prefix."feeds_url WHERE url_id = '".$urlid."'";
		$d = $wpdb->query($qry);
		
		if($d){
			echo "<script> window.location='?page=imp-feeds&delete=1'; </script>";
		}else{
			echo "<script> window.location='?page=imp-feeds&delete=0'; </script>";
		}
	}
	
}

function sp_import_feeds($url) {
	global $wpdb;

	$content = file_get_contents($url);
	$status = $content ? true : false;

	$x = new SimpleXmlElement($content);

	foreach($x->channel->item as $entry) {

		//allow one minute per post
		set_time_limit (60);

		$slug = sanitize_title($entry->title);

		// check if posts already exists
		$result = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."posts WHERE post_name = '" . $slug . "'", 'ARRAY_A');
		if(empty($result)){
			// insert posts
			$imagedownloadcontent = $entry->description;

			$content= $entry->description;
			$content = preg_replace("/<img[^>]+\>/i", " ", $content);
			$doc = new DOMDocument();
			$doc->loadHTML($imagedownloadcontent);
			$xpath = new DOMXPath($doc);
			$src = $xpath->evaluate("string(//img/@src)");

			$post_id = wp_insert_post(array(
				'post_type'       => "post",
				'post_content'    => $content , // description
				'post_title'      => $entry->title, // title
				'post_name'       => $entry->title, // i.e. 'GA'; this is for the URL
				'post_status'     => "pending",
				'post_author' => 1
			));

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
			$attach_id = wp_insert_attachment( $attachment, $uplfile, $post_id );
			$attach_data = wp_generate_attachment_metadata( $attach_id, $uplfile);
			wp_update_attachment_metadata( $attach_id, $attach_data );
			add_post_meta($post_id, '_thumbnail_id', $attach_id, true);

			$wpdb->insert($wpdb->prefix.'term_relationships', array('object_id' => $post_id, 'term_taxonomy_id' => 14), array('%d', '%d'));
			$wpdb->insert($wpdb->prefix.'term_relationships', array('object_id' => $post_id, 'term_taxonomy_id' => 15), array('%d', '%d'));
			$wpdb->update($wpdb->prefix.'term_relationships', array('term_taxonomy_id' => 0), array('term_taxonomy_id' => 1));

			/**
			set category to posts
			$term_taxonomy_ids = wp_set_post_categories( $post_ID, array($cat_ids), 'category');
			$term_taxonomy_ids = wp_set_object_terms( $post_ID, array($cat_ids ), 'category', true );
			$term_taxonomy_ids = wp_set_post_terms( $post_ID, array($cat_ids ), 'category');
			 */
		}
	}

	return $status;
}

function sp_feeds_auto_import(){
	global $wpdb;

	$feeds = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."feeds_url");
	if(!empty($feeds)){
		foreach($feeds as $feed){
			sp_import_feeds($feed->url);
		}
	}
}