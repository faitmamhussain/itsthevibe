<?php

if ( ! defined( 'ABSPATH' ) ) exit;

require_once( plugin_dir_path( __FILE__ ) . '/log-widget.php' );
require_once( plugin_dir_path( __FILE__ ) . 'vendor/autoload.php');

if(isset($_GET['logoff'])){
	delete_option('rd_username_field');
	delete_option('rd_password_field');
	delete_option('rd_channel_checkboxes');
	delete_option('rd_category_checkboxes');
	delete_option('rd_status_radiobuttons');
	delete_option('rd_image_radiobuttons');
	delete_option('rd_author_radiobuttons');
	header("Location: options-general.php?page=Reuters_Direct_Settings");
	exit();
}

class Reuters_Direct_Settings {

	private static $instance = null;
	public $parent = null;
	public $base = '';
	public $settings = array();
	private $user_token;
	private $logger;
	private $mixpanel;

	// CONSTRUCTOR FUNCTION
	public function __construct ( $parent ) {
		$this->parent = $parent;
		$this->base = 'rd_';

		// Initialise settings
		add_action( 'admin_init', array( $this, 'initSettings' ) );

		// Register Reuters Direct
		add_action( 'admin_init' , array( $this, 'registerSettings' ) );

		// Add settings page to menu
		add_action( 'admin_menu' , array( $this, 'addMenuItem' ) );

		// Add settings link to plugins page
		add_filter( 'plugin_action_links_' . plugin_basename( $this->parent->file ) , array( $this, 'addSettingsLink' ) );

		// Add dashboard for logs  
		add_action( 'wp_dashboard_setup', array( $this, 'removeDashWidget' ) );
        add_action( 'wp_dashboard_setup', array( $this, 'addDashWidget' ) );

        // Add KLogger class
        $logger = new Katzgrau\KLogger\Logger(__DIR__.'/logs', Psr\Log\LogLevel::DEBUG, array ('dateFormat' => 'Y-m-d G:i:s'));
		$this->logger = $logger;

		// Add Mixpanel class
		$mixpanel = Mixpanel::getInstance("409fb9ce705d2fd3139146ad60ffc73b", array("use_ssl" => false));
		$this->mixpanel = $mixpanel;
	}

	// MAIN INSTANCE
	public static function instance ( $parent ) {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self( $parent );
		}
		return self::$instance;
	} 

	// INTIALIZE SETTINGS PAGE
	public function initSettings () {
		$this->settings = $this->settingsFields();

		$style_url = plugins_url() . '/reuters-direct/assets/css/style.css';
		wp_enqueue_style( 'style', $style_url );	

		$script_url = plugins_url() . '/reuters-direct/assets/js/script.js';
		wp_register_script( 'script-js', $script_url, array(),'',true  );
		wp_enqueue_script( 'script-js' );
	}

	// FUNCTION TO ADD PAGE
	public function addMenuItem () {
		$page = add_options_page( __( 'Reuters Direct', 'reuters-direct' ) , __( 'Reuters Direct', 'reuters-direct' ) , 'manage_options' , 'Reuters_Direct_Settings' ,  array( $this, 'settingsPage' ) );
	}

	// FUNCTION TO ADD PAGE LINK
	public function addSettingsLink ( $links ) {
		$settings_link = '<a href="options-general.php?page=Reuters_Direct_Settings"></a>';
  		array_push( $links, $settings_link );
  		return $links;
	}

	// FUNCTION TO BUILD SETTING FIELDS
	private function settingsFields () {

		$settings['login'] = array(
			'title'					=> __( 'Login', 'reuters-direct' ),
			'description'			=> __( 'Welcome to Reuters WordPress Direct, a content aggregator for the Reuters Connect Platform.<br><br>This plugin requires a Reuters Connect Web Services-API user to authenticate and ingest content.<br>Please reach out to <a href="https://liaison.reuters.com/contact-us/" target="_blank">Customer Support</a> to be put in touch with an appropriate representative to set up access.', 'reuters-direct' ),
			'page'				  	=> __( 'Reuters_Direct_Login' ),
			'fields'				=> array(
				array(
					'id' 			=> 'username_field',
					'label'			=> __( 'Username' , 'reuters-direct' ),
					'description'	=> __( 'This is a standard text field.', 'reuters-direct' ),
					'type'			=> 'text',
					'placeholder'	=> __( 'Enter Username', 'reuters-direct' )
				),
				array(
					'id' 			=> 'password_field',
					'label'			=> __( 'Password' , 'reuters-direct' ),
					'description'	=> __( 'This is a standard password field.', 'reuters-direct' ),
					'type'			=> 'password',
					'placeholder'	=> __( 'Enter Password', 'reuters-direct' )
				)
			)
		);

		$settings['settings'] = array(
			'title'					=> __( 'Settings', 'reuters-direct' ),
			'description'			=> __( '', 'reuters-direct' ),
			'page'				  	=> __( 'Reuters_Direct_Settings' ),
			'fields'				=> array(
				array(
					'id'			=> 'channel_checkboxes',
					'label'			=> __( 'Select Channels' , 'reuters-direct' ),
					'description'	=> __( 'This is a multiple checkbox field for channel selection.', 'reuters-direct' ),
					'type' 			=> 'channel_checkboxes',
					'default'		=> array()
				),
				array(
					'id'			=> 'category_checkboxes',
					'label'			=> __( 'Select Category Codes' , 'reuters-direct' ),
					'description'	=> __( 'This is a multiple checkbox field for category code selection.', 'reuters-direct' ),
					'type' 			=> 'category_checkboxes',
					'options'		=> array('SUBJ'=>'subj', 'N2'=>'N2', 'MCC'=>'MCC', 'MCCL'=>'MCCL', 'RIC'=>'RIC', 'A1312'=>'A1312', 'Agency_Labels'=>'Agency_Labels', 'User_Defined'=>'User_Defined'),
					'default'		=> array(''),
					'info'			=> array('IPTC subject codes (These are owned by the IPTC, see their website for various lists) 
The key distinctions between N2000 and IPTC are that N2000 includes region and country codes while IPTC do not. IPTC codes can also be structured or nested.
', 'N2000 codes also known as Reuters Topic and Region codes. These are alphabetic and inclusion means some relevance to the story. You can use this code to identify stories located in a certain location and or topic. These codes are derived from the IPTC subject codes below. Use Note: Using these codes, will generate a fair amount of additional category codes as stories are coded with multiple N2 codes.', 'These are Media Category Codes or MCC codes. Often referred to as ‘desk codes’. Derived from the ANPA-1312 format. These codes are added manually by Editorial Staff at Reuters.', 'These are the same as MCC codes however, these codes are applied automatically by Open Calais after the content of the story has been analyzed.', 'Reuters Instrument Code -  Stock Symbol + Index.', 'These are legacy ANPA codes.', 'Agency Labels are pre-defined verticals introduced to help you segregate the ingested content and help map them to generic pre-defined categories such as TopNews and Entertainment.','Categorize content on a per channel basis and map those channels to new or pre-existing WordPress categories.')
				),
				array(
					'id' 			=> 'status_radiobuttons',
					'label'			=> __( 'Set Post Status', 'reuters-direct' ),
					'description'	=> __( 'This is a radio button field for post status selection.', 'reuters-direct' ),
					'type'			=> 'status_radiobuttons',
					'options'		=> array( 'publish' => 'Publish (Online Reports)', 'draft' => 'Draft (Online Reports)', 'publish images' => 'Publish (Online Reports with images only)'),
					'default'		=> 'draft'
				),

				array(
					'id' 			=> 'image_radiobuttons',
					'label'			=> __( 'Set Image Rendition', 'reuters-direct' ),
					'description'	=> __( 'This is a radio button field for image rendition selection.', 'reuters-direct' ),
					'type'			=> 'image_radiobuttons',
					'options'		=> array( 'rend:thumbnail' => 'Small JPEG: 150 pixels (Pictures & Online Reports)', 'rend:viewImage' => 'Medium JPEG: 640 pixels (Pictures) 450 pixels (Online Reports)', 'rend:baseImage' => 'Large JPEG: 3500 pixels (Pictures) 800 pixels (Online Reports)' ),
					'default'		=> 'rend:viewImage'
				),
				array(
					'id' 			=> 'author_radiobuttons',
					'label'			=> __( 'Set Post Author', 'reuters-direct' ),
					'description'	=> __( 'This is a radio button field for post author selection.', 'reuters-direct' ),
					'type'			=> 'author_radiobuttons',
					'options'		=> array( 'Reuters' => 'Reuters', 'Default User' => 'Default User' ),
					'default'		=> 'Reuters'
				)				
			)
		);

		$settings = apply_filters( 'Reuters_Direct_Settings_fields', $settings );

		return $settings;
	}

	// FUNCTION TO REGISTER
	public function registerSettings () {
		if( is_array( $this->settings ) ) {
			foreach( $this->settings as $section => $data ) {
				
				add_settings_section( $section, null, array($this, 'settingsSection'), $data['page'] );

				foreach( $data['fields'] as $field ) {

					// Validation callback for field
					$validation = '';
					if( isset( $field['callback'] ) ) {
						$validation = $field['callback'];
					}

					// Register field
					$option_name = $this->base . $field['id'];
					register_setting( $data['page'], $option_name, $validation );

					// Add field to page
					add_settings_field( $field['id'], $field['label'], array( $this, 'displayFields' ), $data['page'], $section, array( 'field' => $field ) );
				}
			}
		}
	}

	// FUNCTION TO ADD DESCRIPTION
	public function settingsSection ( $section ) {
		$html = '<p>' . $this->settings[ $section['id'] ]['description'] . '</p>' . "\n";
		echo $html;
	}

	// FUNCTION TO GENERATE HTML WITH FIELDS
	public function displayFields ( $args ) {
		$field = $args['field'];
		$html = '';
		$option_name = $this->base . $field['id'];
		$option = get_option( $option_name );
		$data = '';
		if( isset( $field['default'] ) ) {
			$data = $field['default'];
			if( $option ) {
				$data = $option;
			}
		}

		switch( $field['type'] ) {

			case 'text':
				$html .= '<div class="settings" style="margin-bottom:0px;"><div id="rd_formheader">Login</div><table class="setting_option" style="padding-bottom:0px;"><tr><td class="login_field">Username</td></tr><tr><td><input id="' . esc_attr( $field['id'] ) . '" type="' . $field['type'] . '" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value="' . $data . '"/></td></tr></table></div>';
				break;
			
			case 'password':
				$html .= '<div class="settings"><table class="setting_option" style="padding-top:0px;"><tr><td class="login_field">Password</td></tr><tr><td><input id="' . esc_attr( $field['id'] ) . '" type="' . $field['type'] . '" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value="' . $data . '"/></td></tr></table></div>';
				break;
			
			case 'channel_checkboxes':
			    $channel_xml = '';
				$channel_url = "http://rmb.reuters.com/rmd/rest/xml/channels?&token=$this->user_token";
			  	$response = wp_remote_get($channel_url, array('timeout' => 10));
			  	
			  	if (!is_wp_error($response)){
				   $channel_xml = simplexml_load_string(wp_remote_retrieve_body($response));
				}
				else{
				   $this->logger->error($response->get_error_message());
				}
				$OLR = $TXT = $GRA = $PIC = array();
				foreach ($channel_xml->channelInformation as $channel_data) 
				{
		   			$channel = (string) $channel_data->description;
		   			$alias = (string) $channel_data->alias;
		   			if(@count($channel_data->category))
		   			{
						$category = (string) $channel_data->category->attributes()->id;
						if($category == "OLR")
						{
							$OLR[$channel] = $alias .':OLR:' . $channel;
						}
						else if($category == "TXT")
						{
							$TXT[$channel] = $alias.':TXT:' . $channel;
						}
						else if($category == "PIC")
						{
							$PIC[$channel] = $alias.':PIC:' . $channel;
						}
						else if($category == "GRA")
						{
							$GRA[$channel] = $alias.':GRA:' . $channel;
						}
					}
				}
				$html .= '<div class="settings"><div id="rd_formheader">News Feed</div> <div id="channel_filter"> <span class="label" style="font-weight:bold !important;"><strong style="font-weight:bold !important; margin-left:3px;">Filter by:</strong></span> <a id="OLR" name="Online Reports" href="#" onclick="setFilter(1);" class="category selected">Online Reports</a> <span>|</span> <a id="TXT" name="Text" href="#" onclick="setFilter(2);" class="category">Text</a> <span>|</span> <a id="PIC" name="Pictures" href="#" onclick="setFilter(3);" class="category">Pictures</a> <span>|</span> <a id="GRA" name="Graphics" href="#" onclick="setFilter(4);" class="category">Graphics</a></div>';
				ksort($OLR);
				$html .= '<table id="OLRChannels" class= "channels" style="display: none;">';
				if(!$OLR){
					$html .= '<tr><td>No subscribed channels</td></tr>';
				}
				foreach ($OLR as $channel => $detail) 
				{
					$channel_categories = "";
					$checked = false;
					$saved_detail = array_values(preg_grep( '/'.$detail.'*/', $data ));
					if($saved_detail){
						$checked = true;
						$channel_detail = explode(':', $saved_detail[0]);
						$channel_categories = $channel_detail[3];
					}
					$html .= '<tr class="channel_detail"><td><label for="' . esc_attr( $channel ) . '"><input class="channel_info" type="checkbox" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '[]" value="' . esc_attr( $detail ) . '" id="' . esc_attr( $channel ) . '" /> ' . $channel . '</label><td><input class="category_info" data-role="tagsinput" type="text" value="'.$channel_categories.'" placeholder="Add Category"/></td></tr>';
				}
				$html .= '</table>';
				ksort($TXT);
				$html .= '<table id="TXTChannels" class= "channels" style="display: none;">';
				if(!$TXT){
					$html .= '<tr><td>No subscribed channels</td></tr>';
				}
				foreach ($TXT as $channel => $detail) 
				{
					$channel_categories = "";
					$checked = false;
					$saved_detail = array_values(preg_grep( '/'.$detail.'*/', $data ));
					if($saved_detail){
						$checked = true;
						$channel_detail = explode(':', $saved_detail[0]);
						$channel_categories = $channel_detail[3];
					}
					$html .= '<tr class="channel_detail"><td><label for="' . esc_attr( $channel ) . '"><input class="channel_info" type="checkbox" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '[]" value="' . esc_attr( $detail ) . '" id="' . esc_attr( $channel ) . '" /> ' . $channel . '</label><td><input class="category_info" data-role="tagsinput" type="text" value="'.$channel_categories.'" placeholder="Add Category"/></td></tr>';
				}
				$html .= '</table>';
				ksort($PIC);
				$html .= '<table id="PICChannels" class= "channels" style="display: none;">';
				if(!$PIC){
					$html .= '<tr><td>No subscribed channels</td></tr>';
				}
				$count = 1;
				foreach ($PIC as $channel => $alias) 
				{
					$checked = false;
					if( in_array( $alias, $data ) ) 
					{
						$checked = true;
					}
					if($count%2){$html .= '<tr>';}
				   	$html .= '<td><label for="' . esc_attr( $field['id'] . '_' . $alias ) . '"><input type="checkbox" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '[]" value="' . esc_attr( $alias ) . '" id="' . esc_attr( $field['id'] . '_' . $alias ) . '" /> ' . $channel . '</label></td>';
					if(!$count%2){$html .= '</tr>';}
					$count++;
				}
				$html .= '</table>';
				ksort($GRA);
				$html .= '<table id="GRAChannels" class= "channels" style="display: none;">';
				if(!$GRA){
					$html .= '<tr><td>No subscribed channels</td></tr>';
				}
				$count = 1;
				foreach ($GRA as $channel => $alias) 
				{
					$checked = false;
					if( in_array( $alias, $data ) ) 
					{
						$checked = true;
					}
					if($count%2){$html .= '<tr>';}
				   	$html .= '<td><label for="' . esc_attr( $field['id'] . '_' . $alias ) . '"><input type="checkbox" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '[]" value="' . esc_attr( $alias ) . '" id="' . esc_attr( $field['id'] . '_' . $alias ) . '" /> ' . $channel . '</label></td>';
					if(!$count%2){$html .= '</tr>';}
					$count++;
				}
				$html .= '</table></div>';
				break;
			
			case 'category_checkboxes':
				$html .= '<div class="settings" style="margin-bottom:0;"><div id="rd_formheader">Catergory</div><table class="setting_option">';
				$count = 1;
				$info = $field['info'];
				$info_count = 0;
				foreach( $field['options'] as $k => $v ) 
				{
					$checked = false;
					if( in_array( $v, $data ) ) 
					{
						$checked = true;
					}
					if($count%2){$html .= '<tr>';}
					$html .= '<td><label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="checkbox" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '[]" value="' . esc_attr( $v ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" />' . $k . '</label><p id="' . $k . '" class="category_info">' . $info[$info_count] . '</p></td>';
					if(!$count%2){$html .= '</tr>';}
					$count++;
					$info_count++;
				}
				$html .= '</table></div>';
				break;
			
			case 'status_radiobuttons':
				$html .= '<div class="settings" style="margin-top:20px;"><div id="rd_formheader">Post Status</div><table class="setting_option">';
				$count = 1;
				foreach( $field['options'] as $k => $v ) {
					$checked = false;
					if( $k == $data ) {
						$checked = true;
					}
					if($count%2){$html .= '<tr>';}
					$html .= '<td><label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="radio" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label></td>';
					if(!$count%2){$html .= '</tr>';}
					$count++;
				}
				$html .= '</table></div>';
				break;

			case 'image_radiobuttons':
				$html .= '<div class="settings"><div id="rd_formheader">Image Rendition</div><table class="setting_option">';
				$count = 1;
				foreach( $field['options'] as $k => $v ) {
					$checked = false;
					if( $k == $data ) {
						$checked = true;
					}
					if($count%2){$html .= '<tr>';}
					$html .= '<td><label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="radio" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label></td> ';
					if(!$count%2){$html .= '</tr>';}
					$count++;
				}
				$html .= '</table></div>';
				break;

			case 'author_radiobuttons':
				$html .= '<div class="settings"><div id="rd_formheader">Post Author</div><table class="setting_option">';
				$count = 1;
				foreach( $field['options'] as $k => $v ) {
					$checked = false;
					if( $k == $data ) {
						$checked = true;
					}
					if($count%2){$html .= '<tr>';}
					$html .= '<td><label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="radio" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label></td> ';
					if(!$count%2){$html .= '</tr>';}
					$count++;
				}
				$html .= '</table></div>';
				break;
		}
		echo $html;
	}

	// FUNCTION TO LOAD THE SETTINGS PAGE
	public function settingsPage () {

		// Header
		$html = '<div class="wrap" id="Reuters_Direct_Settings"><div id="rd_header"><h1><span>REUTERS WORDPRESS DIRECT</span><select id="help_links"><option value="" disabled selected>Help</option><option value="https://liaison.reuters.com/contact-us/">Contact Us</option><option value="http://mediaexpress.reuters.com">Media Express</option></select></h1></div>';
		$this->user_token = $this->getToken();
		if($this->user_token)
		{
			// Settings 
			$username = get_option('rd_username_field');
			$html .= '<div id="rd_subheader"><b><span>'.$username.'&nbsp;</span>|<a id="logout" href="?logoff">&nbsp;Logout</a></b></div><div id="rd_settings" class="rd_form"><form name="settings_form" method="post" action="options.php" enctype="multipart/form-data">';
			ob_start();
			settings_fields( 'Reuters_Direct_Settings' );
			do_settings_sections( 'Reuters_Direct_Settings' );
			$html .= ob_get_clean();
			$html .= '<input name="Submit" type="submit" class="rd_button" value="' . esc_attr( __( 'Save Settings' , 'reuters-direct' ) ) . '" /></form></div>';

			// Mixpanel Analytics
			$channels = array();
			$stored_channel = get_option('rd_channel_checkboxes');
			if(!empty($stored_channel)) {
				foreach( $stored_channel as $channel => $detail ) {
					$channel_detail = explode(':', $detail);
					$channel_name = $channel_detail[2];
					array_push($channels, $channel_name);
				}
			}
			$this->mixpanel->people->set($username, array(
				'$name'       		=> get_option('blogname'),
			    'Username'       	=> $username,
			    'Version'           => get_option('Reuters_Direct_version'),
			    'URL'				=> get_option('siteurl'),
			    'News Feed'			=> $channels,
			    'Category'			=> get_option('rd_category_checkboxes'),
			    'Post Status'       => get_option('rd_status_radiobuttons'),
			    'Image Rendition'   => get_option('rd_image_radiobuttons'),
			    'Post Author'		=> get_option('rd_author_radiobuttons')
			));
		}
		else
		{
			// Login
			$html .= '<div id="rd_login" class="rd_form"><form name="login_form" method="post" action="options.php" enctype="multipart/form-data">';	
			ob_start();
			settings_fields( 'Reuters_Direct_Login' );
			do_settings_sections( 'Reuters_Direct_Login' );
			$html .= ob_get_clean();
			$html .= '<input name="Submit" type="submit" class="rd_button" value="' . esc_attr( __( 'Validate & Save' , 'reuters-direct' ) ) . '" /></form></div>';
			$html .= '<script>jQuery("#setting-error-settings_updated").html("<p><strong>Login falied. Please try again with a valid username and password.</strong></p>");jQuery("#setting-error-settings_updated").css("border-color","#a00000");</script>';
		}
		// Footer
		$html .= '<div id="rd_footer" class="rd_footer"><p> © '.date("Y").' Thomson Reuters. All rights reserved. <span>|</span><a href="http://www.thomsonreuters.com/products_services/financial/privacy_statement/" target="_blank" class="privacy">Privacy Statement</a></p><a class="logo" href="http://www.thomsonreuters.com" target="_blank">Reuters</a></div></div>';
		echo $html;
	}

	// FUNCTION TO GET TOKEN
	public function getToken(){
		$token = '';
		$username = get_option('rd_username_field');
		$password = get_option('rd_password_field');
	  	$token_url = "https://commerce.reuters.com/rmd/rest/xml/login?username=$username&password=$password";
	  	$response = wp_remote_get($token_url, array('timeout' => 10, 'sslverify'   => false));
	  	
	  	if (!is_wp_error($response)){
		   $response_xml = simplexml_load_string(wp_remote_retrieve_body($response));
		   if(!$response_xml->error)
		   		$token = $response_xml;
		}
		else{
		   $this->logger->error($response->get_error_message());
		}
	  	return $token;
	}

	// FUNCTION TO ADD DASHBOARD WIDGET
	public function addDashWidget() {
	    global $custom_dashboard_widgets;
	 
	    foreach ( $custom_dashboard_widgets as $widget_id => $options ) {
	        wp_add_dashboard_widget(
	            $widget_id,
	            $options['title'],
	            $options['callback']
	        );
	    }
	}

	// FUNCTION TO REMOVE DASHBOARD WIDGET
	public function removeDashWidget() {
	    global $remove_defaults_widgets;
	 
	    foreach ( $remove_defaults_widgets as $widget_id => $options ) {
	        remove_meta_box( $widget_id, $options['page'], $options['context'] );
	    }
	}
}
?>