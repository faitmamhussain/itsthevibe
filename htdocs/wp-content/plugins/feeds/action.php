<?php 
include "../../../wp-load.php";

global $wpdb;

if(isset($_POST)){
	foreach($_POST['feed_url_int'] as $url){
		$content = file_get_contents($url);
		$x = new SimpleXmlElement($content);
		foreach($x->channel->item as $entry){
			$result = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."posts WHERE post_title = '" . $entry->title . "'", 'ARRAY_A');
			if(!empty($result)){
				echo "already exists";
			}else{
				
				 $doc = new DOMDocument();
				$doc->loadHTML($entry->description);
				$xpath = new DOMXPath($doc);
				$src = $xpath->evaluate("string(//img/@src)");
				
				$post_id = wp_insert_post(array(
					'post_type'       => "feeds",
					'post_content'    => $entry->description, // description
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
			}
		}
	}
}
?>