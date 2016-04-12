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


register_activation_hook( __FILE__,  'activate' );
register_deactivation_hook( __FILE__,  'deactivate' );

function activate() {
		
	global $wpdb;	
	
	$feeds_url = $wpdb->prefix.'feeds_url';
	
	$tbA = "CREATE TABLE ".$feeds_url." (
		url_id int(11) NOT NULL AUTO_INCREMENT,
		url varchar(200) NOT NULL,
		UNIQUE KEY url_id (url_id)
	)";
	
	$wpdb->query($tbA);
	
}

function deactivate() {
	
	global $wpdb;	
	 
	$feeds_url = $wpdb->prefix.'feeds_url';
	
	$tba = "DROP TABLE IF EXISTS $feeds_url";
	
	$wpdb->query($tba);
}

add_action('init','init_feeds');
function init_feeds() {
	add_action('admin_menu', 'feeds_menu');
	add_shortcode('mypubslishfeeds', 'displayfeeds');
	// register_cpt_practicearea();
	
	add_action( 'admin_enqueue_scripts', 'feeds_ui_scripts' );

}

function feeds_menu(){
	add_menu_page( 'Import Feeds', 'Import Feeds', 'manage_options', 'imp-feeds', 'addFeed','dashicons-rss' );
}

function feeds_ui_scripts() {
	wp_enqueue_style( 'ui', plugins_url() . '/feeds/ui.css' );
	wp_enqueue_script( 'ui-js', plugins_url() . '/feeds/addmore.js', array(), '0.1', true  );
}

/*
function register_cpt_practicearea() {

        $labels = array( 
            'name' => _x( 'Feeds', 'feeds' ),
            'singular_name' => _x( 'Feeds', 'feeds' ),
            'add_new' => _x( 'Add New', 'feeds' ),
            'add_new_item' => _x( 'Add New Feed', 'feeds' ),
            'edit_item' => _x( 'Edit Feed', 'feeds' ),
            'new_item' => _x( 'New Feed', 'feeds' ),
            'view_item' => _x( 'View Feed', 'feeds' ),
            'search_items' => _x( 'Search Feed', 'feeds' ),
            'not_found' => _x( 'No Feed found', 'feeds' ),
            'not_found_in_trash' => _x( 'No Feed found in Trash', 'feeds' ),
            'parent_item_colon' => _x( 'Parent Feed:', 'feeds' ),
            'menu_name' => _x( 'Feeds', 'feeds' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => true,
            
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'trackbacks', 'custom-fields', 'page-attributes' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post'
        );

        register_post_type( 'feeds', $args );
		create_pra_taxonomies();
}

// create texonoly for perticualr custom post type

function create_pra_taxonomies() {
    register_taxonomy(
        'feeds_txnmy',
        'feeds',
        array(
            'labels' => array(
                'name' => 'Feeds Category',
                'add_new_item' => 'Add New Category',
                'new_item_name' => "New Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}

*/


function addFeed() {
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
	if(isset($_GET['craete'])){ 
		$m = $_GET['craete'] == 1 ? "<div id='actionmsg' class='actionmsg'>Success! The post's created successfully</div>" : "<div id='actionmsg' class='actionmsg'>Database Error - Not craeted!</div>";
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
		// $cat_ids = implode(',', $_POST['feed_category']);
		$content = file_get_contents($_POST['feed_url']);
		$x = new SimpleXmlElement($content);
		$msg = array();
		foreach($x->channel->item as $entry) {
			// check if posts already exists
			$result = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."posts WHERE post_title = '" . $entry->title . "'", 'ARRAY_A');
			if(!empty($result)){
				$msg['message'] = "<script> window.location='?page=imp-feeds&exists=1'; </script>";
			}else{
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
				if ( is_wp_error( $post_id ) ) {
					$msg['message'] = "<script> window.location='?page=imp-feeds&craete=0'; </script>";
				} else {
					$msg['message'] = "<script> window.location='?page=imp-feeds&craete=1'; </script>";
				}
			}
		}
		
		if(!empty($msg)){
			echo $msg['message']; 
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

function displayfeeds(){

	$args = array(
		'post_type'=> 'post',
		'order'    => 'ASC',
		'post_status'  =>  'publish',
		'numberposts' => -1
    );

	$the_query = new WP_Query( $args );	

	if(!empty($the_query)) :
		if($the_query->have_posts() ) : 
			
			ob_start();
			echo "<style>.feeds > div {
				background: #ccc none repeat scroll 0 0;
				float: left;
				margin: 5px;
				padding: 10px;
				width: 46%;
			} .feeds h4 {
				font-size: 16px ;
				font-weight: 900;
			} .feeds img {
				
			}
                        .feeds p img {
                           display: none;
                         }</style>";
			echo '<div class="feeds">';
			$f=0;
				while ( $the_query->have_posts() ) : 
				$f++;
					$the_query->the_post(); ?>
					<div>
						<h4><?php echo $f; ?>. <?php echo get_the_title(); ?></h4>
                                                <?php the_post_thumbnail('full');?>
						<p><?php echo apply_filters('the_content', substr(get_the_content(), 0, 153) ); ?> <a href="<?php echo the_permalink(); ?>"><?php _e(' Read More > ');?> </a></p>
					</div> <?php 
				endwhile;
			echo '</div>';
		endif;
	else:
		echo "No Post Found!";
	endif;
	$feeds = ob_get_clean();
	
	echo $feeds;
}

/* Code to Display Featured Image on top of the post */
add_action( 'genesis_entry_content', 'featured_post_image', 8 );
function featured_post_image() {
  if ( ! is_singular( 'post' ) )  return;
	the_post_thumbnail('post-image');
}
?>