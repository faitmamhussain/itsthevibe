<?php
/*
Plugin Name: Ad Inserter
Version: 1.6.2
Description: A simple solution to insert any code into Wordpress. Simply enter any HTML, Javascript or PHP code and select where and how you want to display it.
Author: Spacetime
Author URI: http://igorfuna.com/
Plugin URI: http://igorfuna.com/software/web/ad-inserter-wordpress-plugin
*/

/*
Change Log

Ad Inserter 1.6.2 - 2 April 2016
- Removed deprecated code (fixes PHP Fatal error Call to a member function get_display_type)
- Added support to change plugin processing priority

Ad Inserter 1.6.1 - 28 February 2016
- Fixed bug: For shortcodes in posts the date was not checked
- Fixed error with some templates "Call to undefined method is_main_query()"
- Added support for minumum number of page/post words for Before/After content display option
- Added support for {author} and {author_name} tags

Ad Inserter 1.6.0 - 9 January 2016
- Added support for client-side device detection
- Many code improvements
- Improved plugin processing speed
- Removed support for deprecated tags for manual insertion {adinserter n}
- Few minor bug fixes

Ad Inserter 1.5.8 - 20 December 2015
- Fixed notice "Undefined index: adinserter_selected_block_" when saving page or post

Ad Inserter 1.5.7 - 20 December 2015
- Fixed notice "has_cap was called with an argument that is deprecated since version 2.0!"
- Few minor bug fixes and code improvements
- Added support to blacklist or whitelist url patterns: /url-start*. *url-pattern*, *url-end
- Added support to define minimum number of words in paragraphs
- Added support to define minimum user role for page/post Ad Inserter exceptions editing
- Added support to limit insertions of individual code blocks
- Added support to filter direct visits (no referer)

Ad Inserter 1.5.6 - 14 August 2015
- Fixed Security Vulnerability: Plugin was vulnerable to Cross-Site Scripting (XSS)
- Few bug fixes and code improvements

Ad Inserter 1.5.5 - 6 June 2015
- Few bug fixes and code improvements
- Added support to export and import all Ad Inserter settings

Ad Inserter 1.5.4 - 31 May 2015
- Many code optimizations and cosmetic changes
- Header and Footer code blocks moved to settings tab (#)
- Added support to process shortcodes of other plugins used in Ad Inserter code blocks
- Added support to white-list or black-list individual urls
- Added support to export and import settings for code blocks
- Added support to specify excerpts for block insertion
- Added support to specify text that must be present when counting paragraphs

Ad Inserter 1.5.3 - 2 May 2015
- Fixed Security Vulnerability: Plugin was vulnerable to a combination of CSRF/XSS attacks (credits to Kaustubh Padwad)
- Fixed bug: In some cases deprecated widgets warning reported errors
- Added support to white-list or black-list tags
- Added support for category slugs in category list
- Added support for relative paragraph positions
- Added support for individual code block exceptions on post/page editor page
- Added support for minimum number of words
- Added support to disable syntax highlighting editor (to allow using copy/paste on mobile devices)

Ad Inserter 1.5.2 - 15 March 2015
- Fixed bug: Widget titles might be displayed at wrong sidebar positions
- Change: Default code block CSS class name was changed from ad-inserter to code-block to prevent Ad Blockers from blocking Ad Inserter divs
- Added warning message if deprecated widgets are used
- Added support to display blocks on desktop + tablet and desktop + phone devices

Ad Inserter 1.5.1 - 3 March 2015
- Few fixes to solve plugin incompatibility issues
- Added support to disable all ads on specific page

Ad Inserter 1.5.0 - 2 March 2015
- Added support to display blocks on all, desktop or mobile devices
- Added support for new widgets API - one widget for all code blocks with multiple instances
- Added support to change wrapping code CSS class name
- Fixed bug: Display block N days after post is published was not working properly
- Fixed bug: Display block after paragraph in some cases was not working propery

Ad Inserter 1.4.1 - 29 December 2014
- Fixed bug: Code blocks configured as widgets were not displayed properly on widgets admin page

Ad Inserter 1.4.0 - 21 December 2014
- Added support to skip paragraphs with specified text
- Added position After paragraph
- Added support for header and footer scripts
- Added support for custom CSS styles
- Added support to display blocks to all, logged in or not logged in users
- Added support for syntax highlighting
- Added support for shortcodes
- Added classes to block wrapping divs
- Few bugs fixed

Ad Inserter 1.3.5 - 18 March 2014
- Fixed bug: missing echo for PHP function call example

Ad Inserter 1.3.4 - 15 March 2014
- Added option for no code wrapping with div
- Added option to insert block codes from PHP code
- Changed HTML codes to disable display on specific pages
- Selected code block position is preserved after settings are saved
- Manual insertion can be enabled or disabled regardless of primary display setting
- Fixed bug: in some cases Before Title display setting inserted code into RSS feed

Ad Inserter 1.3.3 - 8 January 2014
- Added option to insert ads also before or after the excerpt
- Fixed bug: in some cases many errors reported after activating the plugin
- Few minor bugs fixed
- Few minor cosmetic changes

Ad Inserter 1.3.2 - 4 December 2013
- Fixed blank settings page caused by incompatibility with some themes or plugins

Ad Inserter 1.3.1 - 3 December 2013
- Added option to insert ads also on pages
- Added option to process PHP code
- Few bugs fixed

Ad Inserter 1.3.0 - 27 November 2013
- Number of ad slots increased to 16
- New tabbed admin interface
- Ads can be manually inserted also with {adinserter AD_NUMBER} tag
- Fixed bug: only the last ad block set to Before Title was displayed
- Few other minor bugs fixed
- Few cosmetic changes

Ad Inserter 1.2.1 - 19 November 2013
- Fixed problem: || in ad code (e.g. asynchronous code for AdSense) causes only part of the code to be inserted (|| to rotate ads is replaced with |rotate|)

Ad Inserter 1.2.0 - 15/05/2012
- Fixed bug: manual tags in posts lists were not removed
- Added position Before title
- Added support for minimum number of paragraphs
- Added support for page display options for Widget and Before title positions
- Alignment now works for all display positions

Ad Inserter 1.1.3 - 07/04/2012
- Fixed bug for {search_query}: When the tag is empty {smart_tag} is used in all cases
- Few changes in the settings page

Ad Inserter 1.1.2 - 16/07/2011
- Fixed error with multisite/network installations

Ad Inserter 1.1.1 - 16/07/2011
- Fixed bug in Float Right setting display

Ad Inserter 1.1.0 - 05/06/2011
- Added option to manually display individual ads
- Added new ad alignments: left, center, right
- Added {search_query} tag
- Added support for category black list and white list

Ad Inserter 1.0.4 - 19/12/2010
- HTML entities for {title} and {short_title} are now decoded
- Added {tag} to display the first tag

Ad Inserter 1.0.3 - 05/12/2010
- Fixed bug for rotating ads

Ad Inserter 1.0.2 - 04/12/2010
- Added support for rotating ads

Ad Inserter 1.0.1 - 17/11/2010
- Added support for different sidebar implementations

Ad Inserter 1.0.0 - 14/11/2010
- Initial release

*/


//ini_set('display_errors',1);
//error_reporting (E_ALL);

if (!defined ('AD_INSERTER_PLUGIN_DIR'))
  define ('AD_INSERTER_PLUGIN_DIR', plugin_dir_path (__FILE__));

/* Version check */
global $wp_version;
$exit_msg = 'Ad Inserter requires WordPress 3.0 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';

if (version_compare ($wp_version, "3.0", "<")) {
  exit ($exit_msg);
}

//include required files
require_once AD_INSERTER_PLUGIN_DIR.'class.php';
require_once AD_INSERTER_PLUGIN_DIR.'constants.php';
require_once AD_INSERTER_PLUGIN_DIR.'settings.php';
require_once AD_INSERTER_PLUGIN_DIR.'includes/Mobile_Detect.php';

$ad_interter_globals = array ();

$detect = new ai_Mobile_Detect;

define ('AI_MOBILE',   $detect->isMobile ());
define ('AI_TABLET',   $detect->isTablet ());
define ('AI_PHONE',    AI_MOBILE && !AI_TABLET);
define ('AI_DESKTOP',  !AI_MOBILE);

// Load options
ai_load_options ();

$block_object = array ();
for ($counter = 1; $counter <= AD_INSERTER_BLOCKS; $counter ++) {
  $obj = new ai_Block ($counter);
  $obj->load_options ($counter);
  $block_object [$counter] = $obj;
}

$plugin_priority = get_plugin_priority ();

// Set hooks
add_action ('admin_menu',         'ai_admin_menu_hook');
add_filter ('the_content',        'ai_content_hook', $plugin_priority);
add_filter ('the_excerpt',        'ai_excerpt_hook', $plugin_priority);
add_action ('loop_start',         'ai_loop_start_hook');
add_action ('init',               'ai_init_hook');
add_action ('admin_notices',      'ai_admin_notice_hook');
add_action ('wp_head',            'ai_wp_head_hook');
add_action ('wp_footer',          'ai_wp_footer_hook');
add_action ('widgets_init',       'ai_widgets_init_hook');
add_action ('add_meta_boxes',     'ai_add_meta_box_hook');
add_action ('save_post',          'ai_save_meta_box_data_hook');
add_action ('wp_enqueue_scripts', 'ai_enqueue_scripts_hook');

add_filter ('plugin_action_links_'.plugin_basename (__FILE__), 'ai_plugin_action_links');


function ai_init_hook() {
  global $block_object;

  // OLD WIDGETS - DEPRECATED
//  for ($counter = 1; $counter <= AD_INSERTER_BLOCKS; $counter ++) {
//    $obj = $block_object [$counter];
//    if($obj->get_display_type() == AD_SELECT_WIDGET){
//      // register widget
//      $widget_options = array ('classname' => 'ad-inserter-widget', 'description' => "DEPRECATED - Use 'Ad Inserter' widget instead.");
//      $widget_parameters = array ('block' => $counter);
//      // Different callback functions because widgets that share callback functions don't get displayed
//      if ($counter <= 16)
//        wp_register_sidebar_widget ('ai_widget'.$counter, $obj->get_ad_name().' - DEPRECATED', 'ai_widget'.$counter, $widget_options, $widget_parameters);
//    }
//  }

  add_shortcode ('adinserter', 'process_shortcodes');
}

function ai_admin_menu_hook () {
  global $ai_settings_page;

//  $ai_settings_page = add_submenu_page ('options-general.php', 'Ad Inserter Options', 'Ad Inserter', 8, basename(__FILE__), 'ai_settings');
  $ai_settings_page = add_submenu_page ('options-general.php', 'Ad Inserter Options', 'Ad Inserter', 'manage_options', basename(__FILE__), 'ai_settings');
  add_action ('admin_enqueue_scripts', 'ai_admin_enqueue_scripts');
}


function ai_admin_enqueue_scripts ($hook_suffix) {
  global $ai_settings_page;

  if ($hook_suffix == $ai_settings_page) {
    wp_enqueue_script ('ad-inserter-js',        plugins_url ('js/ad-inserter.js', __FILE__), array ('jquery', 'jquery-ui-tabs', 'jquery-ui-button', 'jquery-ui-tooltip'), AD_INSERTER_VERSION);
    wp_enqueue_style  ('ad-inserter-jquery-ui', plugins_url ('css/jquery-ui-1.10.3.custom.min.css', __FILE__), false, null);
    wp_enqueue_style  ('ad-inserter',           plugins_url ('css/ad-inserter.css', __FILE__), false, AD_INSERTER_VERSION);

    wp_enqueue_script ('ad-ace',                plugins_url ('includes/ace/src-min-noconflict/ace.js', __FILE__ ), array (), AD_INSERTER_VERSION);
    wp_enqueue_script ('ad-ace-ext-modelist',   plugins_url ('includes/ace/src-min-noconflict/ext-modelist.js', __FILE__ ), array (), AD_INSERTER_VERSION);
  }
}

function ai_enqueue_scripts_hook () {
  wp_enqueue_style ('ad-inserter-devices', plugins_url ( 'css/devices.css', __FILE__), false, AD_INSERTER_VERSION);
}

function ai_admin_notice_hook () {
  global $current_screen, $ai_db_options;

//  $sidebar_widgets = wp_get_sidebars_widgets();
//  $sidebars_with_deprecated_widgets = array ();

//  foreach ($sidebar_widgets as $sidebar_widget_index => $sidebar_widget) {
//    if (is_array ($sidebar_widget))
//      foreach ($sidebar_widget as $widget) {
//        if (preg_match ("/ai_widget([\d]+)/", $widget, $widget_number)) {
//          if (isset ($widget_number [1]) && is_numeric ($widget_number [1])) {
//            $is_widget = $ai_db_options [$widget_number [1]][AI_OPTION_DISPLAY_TYPE] == AD_SELECT_WIDGET;
//          } else $is_widget = false;
//          $sidebar_name = $GLOBALS ['wp_registered_sidebars'][$sidebar_widget_index]['name'];
//          if ($is_widget && $sidebar_name != "")
//            $sidebars_with_deprecated_widgets [$sidebar_widget_index] = $sidebar_name;
//        }
//      }
//  }

//  if (!empty ($sidebars_with_deprecated_widgets)) {
//    echo "<div class='error' style='padding: 11px 15px; font-size: 14px;'><strong>Warning</strong>: You are using deprecated Ad Inserter widgets in the following sidebars: ",
//    implode (", ", $sidebars_with_deprecated_widgets),
//    ". Please replace them with the new 'Ad Inserter' code block widget. See <a href='https://wordpress.org/plugins/ad-inserter/faq/' target='_blank'>FAQ</a> for details.</div>";
//  }
}

function ai_plugin_action_links ($links) {
  $settings_link = '<a href="'.admin_url ('options-general.php?page=ad-inserter.php').'">Settings</a>';
  array_unshift ($links, $settings_link);
  return $links;
}

function ai_current_user_role_ok () {
  $role_values = array ("super-admin" => 6, "administrator" => 5, "editor" => 4, "author" => 3, "contributor" => 2, "subscriber" => 1);
  global $wp_roles;

  $minimum_user_role = isset ($role_values [get_minimum_user_role ()]) ? $role_values [get_minimum_user_role ()] : 0;

  $user_role = 0;
  $current_user = wp_get_current_user();
  $roles = $current_user->roles;

  // Fix for empty roles
  if (isset ($current_user->caps) && count ($current_user->caps) != 0) {
    $caps = $current_user->caps;
    if (isset ($caps ["super-admin"]) && $caps ["super-admin"]) $roles []= "super-admin";
    if (isset ($caps ["administrator"]) && $caps ["administrator"]) $roles []= "administrator";
    if (isset ($caps ["editor"]) && $caps ["editor"]) $roles []= "editor";
    if (isset ($caps ["author"]) && $caps ["author"]) $roles []= "author";
    if (isset ($caps ["contributor"]) && $caps ["contributor"]) $roles []= "contributor";
    if (isset ($caps ["subscriber"]) && $caps ["subscriber"]) $roles []= "subscriber";
  }

  foreach ($roles as $role) {
    $current_user_role = isset ($role_values [$role]) ? $role_values [$role] : 0;
    if ($current_user_role > $user_role) $user_role = $current_user_role;
  }

  return $user_role >= $minimum_user_role;
}


function ai_add_meta_box_hook() {

  if (!ai_current_user_role_ok ()) return;

  $screens = array ('post', 'page');

  foreach ($screens as $screen) {
    add_meta_box (
      'adinserter_sectionid',
      'Ad Inserter Exceptions',
      'ai_meta_box_callback',
      $screen
    );
  }
}

function ai_meta_box_callback ($post) {
  global $block_object;

  // Add an nonce field so we can check for it later.
  wp_nonce_field ('adinserter_meta_box', 'adinserter_meta_box_nonce');

  $post_type = get_post_type ($post);

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $post_meta = get_post_meta ($post->ID, '_adinserter_block_exceptions', true);
  $selected_blocks = explode (",", $post_meta);

  echo '<table>';
  echo '<thead style="font-weight: bold;">';
    echo '  <td>Block</td>';
    echo '  <td style="padding: 0 10px 0 10px;">Name</td>';
    echo '  <td style="padding: 0 10px 0 10px;">Automatic Display Type</td>';
    echo '  <td style="padding: 0 5px 0 5px;">Posts</td>';
    echo '  <td style="padding: 0 5px 0 5px;">Pages</td>';
    echo '  <td style="padding: 0 5px 0 5px;">Manual</td>';
    echo '  <td style="padding: 0 5px 0 5px;">PHP</td>';
    echo '  <td style="padding: 0 10px 0 10px;">Default</td>';
    echo '  <td style="padding: 0 10px 0 10px;">For this ', $post_type, '</td>';
  echo '</thead>';
  echo '<tbody>';
  $rows = 0;
  for ($block = 1; $block <= AD_INSERTER_BLOCKS; $block ++) {
    $obj = $block_object [$block];

    if ($post_type == 'post') {
      $enabled_on_text  = $obj->get_ad_enabled_on_which_posts ();
      $general_enabled  = $obj->get_display_settings_post();
    } else {
        $enabled_on_text = $obj->get_ad_enabled_on_which_pages ();
        $general_enabled = $obj->get_display_settings_page();
      }

    $individual_option_enabled  = $general_enabled && ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED || $enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED);
    $individual_text_enabled    = $enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED;

    $display_type = $obj->get_display_type();
    if ($rows % 2 != 0) $background = "#F0F0F0"; else $background = "#FFF";
    echo '<tr style="background: ', $background, ';">';
    echo '  <td style="text-align: right;">', $obj->number, '</td>';
    echo '  <td style="padding: 0 10px 0 10px;">', $obj->get_ad_name(), '</td>';
    echo '  <td style="padding: 0 10px 0 10px;">', $display_type, '</td>';

    echo '  <td style="padding: 0 10px 0 10px; text-align: center;">';
    if ($obj->get_display_settings_post ()) echo '&check;';
    echo '  </td>';
    echo '  <td style="padding: 0 10px 0 10px; text-align: center;">';
    if ($obj->get_display_settings_page ()) echo '&check;';
    echo '  </td>';
    echo '  <td style="padding: 0 10px 0 10px; text-align: center;">';
    if ($obj->get_enable_manual ()) echo '&check;';
    echo '  </td>';
    echo '  <td style="padding: 0 10px 0 10px; text-align: center;">';
    if ($obj->get_enable_php_call ()) echo '&check;';
    echo '  </td>';

    echo '  <td style="padding: 0 10px 0 10px; text-align: left;">';

    if ($individual_option_enabled) {
      if ($individual_text_enabled) echo 'Enabled'; else echo 'Disabled';
    } else {
        if ($general_enabled) echo 'Enabled on all ', $post_type, 's'; else
          echo 'Disabled on all ', $post_type, 's';
      }
    echo '  </td>';

    echo '  <td style="padding: 0 10px 0 10px; text-align: left;">';
    if ($individual_option_enabled)
      echo '<input type="checkbox" style="border-radius: 5px;" name="adinserter_selected_block_', $block, '" value="1"', in_array ($block, $selected_blocks) ? ' checked': '', ' />';

    echo '<label for="adinserter_selected_block_', $block, '">';
    if ($individual_option_enabled) {
      if (!$individual_text_enabled) echo 'Enabled'; else echo 'Disabled';
    }
    echo '</label>';
    echo '  </td>';

    echo '</tr>';
    $rows ++;
  }

  echo '</tbody>';
  echo '</table>';

  echo '<p>Default behavior for all code blocks for ', $post_type, 's (enabled or disabled) can be configured on <a href="/wp-admin/options-general.php?page=ad-inserter.php" target="_blank">Ad Inserter Settings page</a>. Here you can configure exceptions for this ', $post_type, '.</p>';
}

function ai_save_meta_box_data_hook ($post_id) {
  // Check if our nonce is set.
  if (!isset ($_POST ['adinserter_meta_box_nonce'])) return;

  // Verify that the nonce is valid.
  if (!wp_verify_nonce ($_POST ['adinserter_meta_box_nonce'], 'adinserter_meta_box')) return;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if (defined ('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

  // Check the user's permissions.

  if (isset ($_POST ['post_type'])) {
    if ($_POST ['post_type'] == 'page') {
      if (!current_user_can ('edit_page', $post_id)) return;
    } else {
      if (!current_user_can ('edit_post', $post_id)) return;
    }
  }

  /* OK, it's safe for us to save the data now. */

  $selected = array ();
  for ($block = 1; $block <= AD_INSERTER_BLOCKS; $block ++) {
    $option_name = 'adinserter_selected_block_' . $block;
    if (isset ($_POST [$option_name]) && $_POST [$option_name]) $selected []= $block;
  }

  // Update the meta field in the database.
  update_post_meta ($post_id, '_adinserter_block_exceptions', implode (",", $selected));
}

function ai_widgets_init_hook () {
  register_widget ('ai_widget');
}

function ai_wp_head_hook () {
  $obj = new ai_AdH();
  $obj->load_options ("h");

  if ($obj->get_enable_manual ()) {
    echo ai_getCode ($obj);
  }
}

function ai_wp_footer_hook () {
  $obj = new ai_AdF();
  $obj->load_options ("f");

  if ($obj->get_enable_manual ()) {
    echo ai_getCode ($obj);
  }
}

function ai_plugin_options ($syntax_highlighter_theme = DEFAULT_SYNTAX_HIGHLIGHTER_THEME, $block_class_name = DEFAULT_BLOCK_CLASS_NAME, $minimum_user_role = DEFAULT_MINIMUM_USER_ROLE, $plugin_priority = DEFAULT_PLUGIN_PRIORITY){
  $plugin_options = array ();

  $version_array = explode (".", AD_INSERTER_VERSION);
  $version_string = "";
  foreach ($version_array as $number) {
    $version_string .= sprintf ("%02d", $number);
  }

  $plugin_options ['VERSION'] = $version_string;

  $plugin_options ['SYNTAX_HIGHLIGHTER_THEME']  = $syntax_highlighter_theme;
  $plugin_options ['BLOCK_CLASS_NAME']          = $block_class_name;
  $plugin_options ['MINIMUM_USER_ROLE']         = $minimum_user_role;

  if (!is_numeric ($plugin_priority)) {
    $plugin_priority = DEFAULT_PLUGIN_PRIORITY;
  }
  $plugin_priority = intval ($plugin_priority);
  if ($plugin_priority < 0) {
    $plugin_priority = 0;
  }
  if ($plugin_priority > 999999) {
    $plugin_priority = 999999;
  }
  $plugin_options ['PLUGIN_PRIORITY']           = $plugin_priority;

  return ($plugin_options);
}

function ai_get_option ($option_name) {
  $options = get_option ($option_name);

  if (is_array ($options)) {
    foreach ($options as $key => $option) {
      $options [$key] = stripslashes ($option);
    }
  } else if (is_string ($options)) $options = stripslashes ($options);

  return ($options);
}

function ai_load_options () {
  global $ai_db_options;
  $ai_db_options = get_option (WP_OPTION_NAME);

  if (is_array ($ai_db_options)) {
    foreach ($ai_db_options as $block_number => $block_options) {
      if (is_array ($block_options)) {
        foreach ($block_options as $key => $option) {
          $ai_db_options [$block_number][$key] = stripslashes ($option);
        }
      } else if (is_string ($block_options)) $ai_db_options [$block_number] = stripslashes ($block_options);
    }
  }
}

function get_syntax_highlighter_theme () {
  global $ai_db_options;

  if (isset ($ai_db_options [AI_GLOBAL_OPTION_NAME])) $plugin_db_options = $ai_db_options [AI_GLOBAL_OPTION_NAME]; else $plugin_db_options = '';
  if (!$plugin_db_options) $plugin_db_options = get_option (AD_OPTIONS);

  if (!isset ($plugin_db_options ['SYNTAX_HIGHLIGHTER_THEME']) || $plugin_db_options ['SYNTAX_HIGHLIGHTER_THEME'] == '') {
    $plugin_db_options ['SYNTAX_HIGHLIGHTER_THEME'] = DEFAULT_SYNTAX_HIGHLIGHTER_THEME;
  }

  return ($plugin_db_options ['SYNTAX_HIGHLIGHTER_THEME']);
}

function get_block_class_name () {
  global $ai_db_options;

  if (isset ($ai_db_options [AI_GLOBAL_OPTION_NAME])) $plugin_db_options = $ai_db_options [AI_GLOBAL_OPTION_NAME]; else $plugin_db_options = '';
  if (!$plugin_db_options) $plugin_db_options = get_option (AD_OPTIONS);

  if (!isset ($plugin_db_options ['BLOCK_CLASS_NAME']) || $plugin_db_options ['BLOCK_CLASS_NAME'] == '') {
    $plugin_db_options ['BLOCK_CLASS_NAME'] = DEFAULT_BLOCK_CLASS_NAME;
  }

  return ($plugin_db_options ['BLOCK_CLASS_NAME']);
}

function get_minimum_user_role () {
  global $ai_db_options;

  if (isset ($ai_db_options [AI_GLOBAL_OPTION_NAME])) $plugin_db_options = $ai_db_options [AI_GLOBAL_OPTION_NAME]; else $plugin_db_options = '';
  if (!$plugin_db_options) $plugin_db_options = get_option (AD_OPTIONS);

  if (!isset ($plugin_db_options ['MINIMUM_USER_ROLE']) || $plugin_db_options ['MINIMUM_USER_ROLE'] == '') {
    $plugin_db_options ['MINIMUM_USER_ROLE'] = DEFAULT_MINIMUM_USER_ROLE;
  }

  return ($plugin_db_options ['MINIMUM_USER_ROLE']);
}

function get_plugin_priority () {
  global $ai_db_options;

  if (isset ($ai_db_options [AI_GLOBAL_OPTION_NAME])) $plugin_db_options = $ai_db_options [AI_GLOBAL_OPTION_NAME]; else $plugin_db_options = '';
  if (!$plugin_db_options) $plugin_db_options = get_option (AD_OPTIONS);

  if (!isset ($plugin_db_options ['PLUGIN_PRIORITY']) || $plugin_db_options ['PLUGIN_PRIORITY'] == '') {
    $plugin_db_options ['PLUGIN_PRIORITY'] = DEFAULT_PLUGIN_PRIORITY;
  }

  return ($plugin_db_options ['PLUGIN_PRIORITY']);
}

function filter_html_class ($str){

  $str = str_replace (array ("\\\""), array ("\""), $str);
  $str = sanitize_html_class ($str);

  return $str;
}

function filter_string ($str){

  $str = str_replace (array ("\\\""), array ("\""), $str);
  $str = str_replace (array ("\"", "<", ">"), "", $str);
  $str = esc_html ($str);

  return $str;
}

function filter_option ($option, $value, $delete_escaped_backslashes = true){
  if ($delete_escaped_backslashes)
    $value = str_replace (array ("\\\""), array ("\""), $value);

  if ($option == AI_OPTION_DOMAIN_LIST) {
    $value = str_replace (array ("\\", "/", "?", "\"", "<", ">", "[", "]"), "", $value);
    $value = esc_html ($value);
  }
  elseif ($option == AI_OPTION_PARAGRAPH_TEXT) {
    $value = esc_html ($value);
  }
  elseif ($option == AI_OPTION_NAME ||
          $option == AI_OPTION_GENERAL_TAG ||
          $option == AI_OPTION_DOMAIN_LIST ||
          $option == AI_OPTION_CATEGORY_LIST ||
          $option == AI_OPTION_TAG_LIST ||
          $option == AI_OPTION_URL_LIST ||
          $option == AI_OPTION_PARAGRAPH_TEXT_TYPE ||
          $option == AI_OPTION_PARAGRAPH_NUMBER ||
          $option == AI_OPTION_MIN_PARAGRAPHS ||
          $option == AI_OPTION_MIN_WORDS ||
          $option == AI_OPTION_MIN_PARAGRAPH_WORDS ||
          $option == AI_OPTION_MAXIMUM_INSERTIONS ||
          $option == AI_OPTION_AFTER_DAYS ||
          $option == AI_OPTION_EXCERPT_NUMBER ||
          $option == AI_OPTION_CUSTOM_CSS) {
            $value = str_replace (array ("\"", "<", ">", "[", "]"), "", $value);
            $value = esc_html ($value);
          }

  return $value;
}

function filter_option_hf ($option, $value){
  $value = str_replace (array ("\\\""), array ("\""), $value);

        if ($option == AI_OPTION_CODE ) {
  } elseif ($option == AI_OPTION_ENABLE_MANUAL) {
  } elseif ($option == AI_OPTION_PROCESS_PHP) {
  }

  return $value;
}

/*
function ai_block_counter_check (&$obj) {
  global $ad_interter_globals;

  $global_name = 'BLOCK_' . $obj->number . '_COUNTER';
  $max_insertions = $obj->get_maximum_insertions ();
  if (!isset ($ad_interter_globals [$global_name])) {
    $ad_interter_globals [$global_name] = 0;
  }
  if ($max_insertions != 0 && $ad_interter_globals [$global_name] >= $max_insertions) return false;
  $ad_interter_globals [$global_name] ++;
  return true;
}
*/

function ai_settings () {
  global $ai_db_options, $block_object;

  if (isset ($_POST [AD_FORM_SAVE])) {

    check_admin_referer ('save_adinserter_settings');

    $import_switch_name = AI_OPTION_IMPORT . WP_FORM_FIELD_POSTFIX . '0';
    if (isset ($_POST [$import_switch_name]) && $_POST [$import_switch_name] == "1") {
      // Import Ad Inserter settings
      $saved_settings = $ai_db_options;
      $ai_options = @unserialize (base64_decode (str_replace (array ("\\\""), array ("\""), $_POST ["export_settings_0"])));
      if ($ai_options === false) {
        $ai_options = $saved_settings;
        $invalid_blocks []= 0;
      }
    } else {
        // Try to import individual settings
        $ai_options = array ();

        $invalid_blocks = array ();
        for ($block = 1; $block <= AD_INSERTER_BLOCKS; $block ++) {
          $ad = new ai_Block ($block);

          $import_switch_name = AI_OPTION_IMPORT . WP_FORM_FIELD_POSTFIX . $block;
          if (isset ($_POST [$import_switch_name]) && $_POST [$import_switch_name] == "1") {
            $saved_settings = $ai_db_options [$block];

            $exported_settings = @unserialize (base64_decode (str_replace (array ("\\\""), array ("\""), $_POST ["export_settings_" . $block])));
            if ($exported_settings !== false) {
              foreach (array_keys ($ad->wp_options) as $key){
                if ($key == AI_OPTION_NAME) {
                  $form_field_name = $key . WP_FORM_FIELD_POSTFIX . $block;
                  if (isset ($_POST [$form_field_name])){
                    $ad->wp_options [$key] = filter_option ($key, $_POST [$form_field_name]);
                  }
                } else {
                    if (isset ($exported_settings [$key])) {
                      $ad->wp_options [$key] = filter_option ($key, $exported_settings [$key], false);
                    }
                  }
              }
            } else {
                $ad->wp_options = $saved_settings;
                $invalid_blocks []= $block;
              }
          } else {
              foreach (array_keys ($ad->wp_options) as $key){
                $form_field_name = $key . WP_FORM_FIELD_POSTFIX . $block;
                if (isset ($_POST [$form_field_name])){
                  $ad->wp_options [$key] = filter_option ($key, $_POST [$form_field_name]);
                }
              }
            }

          $ai_options [$block] = $ad->wp_options;

          delete_option (str_replace ("#", $block, AD_ADx_OPTIONS));
        }

        $adH  = new ai_AdH();
        $adF  = new ai_AdF();

        foreach(array_keys ($adH->wp_options) as $key){
          $form_field_name = $key . WP_FORM_FIELD_POSTFIX . AI_HEADER_OPTION_NAME;
          if(isset ($_POST [$form_field_name])){
              $adH->wp_options [$key] = filter_option_hf ($key, $_POST [$form_field_name]);
          }
        }

        foreach(array_keys($adF->wp_options) as $key){
          $form_field_name = $key . WP_FORM_FIELD_POSTFIX . AI_FOOTER_OPTION_NAME;
          if(isset ($_POST [$form_field_name])){
              $adF->wp_options [$key] = filter_option_hf ($key, $_POST [$form_field_name]);
          }
        }

        $ai_options [AI_HEADER_OPTION_NAME] = $adH->wp_options;
        $ai_options [AI_FOOTER_OPTION_NAME] = $adF->wp_options;
        $ai_options [AI_GLOBAL_OPTION_NAME] = ai_plugin_options (filter_string ($_POST ['syntax-highlighter-theme']), filter_html_class ($_POST ['block-class-name']), filter_string ($_POST ['minimum-user-role']), filter_option ('plugin_priority', $_POST ['plugin_priority']));
      }

    if (!empty ($invalid_blocks)) {
      if ($invalid_blocks [0] == 0) {
             echo "<div class='error' style='margin: 5px 15px 2px 0px; padding: 10px;'>Error importing Ad Inserter settings.</div>";
      } else echo "<div class='error' style='margin: 5px 15px 2px 0px; padding: 10px;'>Error importing settings for block", count ($invalid_blocks) == 1 ? "" : "s:", " ", implode (", ", $invalid_blocks), ".</div>";
    }

    update_option (WP_OPTION_NAME, $ai_options);

    // Reload options
    ai_load_options ();

    for ($counter = 1; $counter <= AD_INSERTER_BLOCKS; $counter ++) {
      $obj = new ai_Block ($counter);
      $obj->load_options ($counter);
      $block_object [$counter] = $obj;
    }

    delete_option (str_replace ("#", "Header", AD_ADx_OPTIONS));
    delete_option (str_replace ("#", "Footer", AD_ADx_OPTIONS));
    delete_option (AD_OPTIONS);

    echo "<div class='updated' style='margin: 5px 15px 2px 0px; padding: 10px;'><strong>Settings saved.</strong></div>";

  } elseif (isset ($_POST [AD_FORM_CLEAR])) {

      check_admin_referer ('save_adinserter_settings');

      $ai_options = array ();

      for ($block = 1; $block <= AD_INSERTER_BLOCKS; $block ++) {
        $ad = new ai_Block ($block);
        $ai_options [$block] = $ad->wp_options;

        delete_option (str_replace ("#", $block, AD_ADx_OPTIONS));
      }

      $adH  = new ai_AdH();
      $adF  = new ai_AdF();

      $ai_options [AI_HEADER_OPTION_NAME] = $adH->wp_options;
      $ai_options [AI_FOOTER_OPTION_NAME] = $adF->wp_options;
      $ai_options [AI_GLOBAL_OPTION_NAME] = ai_plugin_options ();
      update_option (WP_OPTION_NAME, $ai_options);

      // Reload options
      ai_load_options ();

      for ($counter = 1; $counter <= AD_INSERTER_BLOCKS; $counter ++) {
        $obj = new ai_Block ($counter);
        $obj->load_options ($counter);
        $block_object [$counter] = $obj;
      }

      delete_option (str_replace ("#", "Header", AD_ADx_OPTIONS));
      delete_option (str_replace ("#", "Footer", AD_ADx_OPTIONS));
      delete_option (AD_OPTIONS);

      echo "<div class='error' style='margin: 5px 15px 2px 0px; padding: 10px;'>Settings cleared.</div>";
  }

  print_settings_form ();
}


function adinserter ($ad_number = ""){
  global $block_object;

  if ($ad_number == "") return "";

  if (!is_numeric ($ad_number)) return "";

  $ad_number = (int) $ad_number;

  if ($ad_number < 1 || $ad_number > AD_INSERTER_BLOCKS) return "";

  // Load options from db
  $obj = $block_object [$ad_number];

  $display_for_users = $obj->get_display_for_users ();

  if ($display_for_users == AD_DISPLAY_LOGGED_IN_USERS && !is_user_logged_in ()) return "";
  if ($display_for_users == AD_DISPLAY_NOT_LOGGED_IN_USERS && is_user_logged_in ()) return "";

  $display_for_devices = $obj->get_display_for_devices ();

  if ($obj->get_detection_server_side ()) {
    if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES && !AI_DESKTOP) return "";
    if ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES && !AI_MOBILE) return "";
    if ($display_for_devices == AD_DISPLAY_TABLET_DEVICES && !AI_TABLET) return "";
    if ($display_for_devices == AD_DISPLAY_PHONE_DEVICES && !AI_PHONE) return "";
    if ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES && !(AI_DESKTOP || AI_TABLET)) return "";
    if ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES && !(AI_DESKTOP || AI_PHONE)) return "";
  }

  if (!$obj->get_enable_php_call ()) return "";

  if (is_front_page ()){
    if (!$obj->get_display_settings_home()) return "";
  } else  if (is_single ()) {
    if (!$obj->get_display_settings_post ()) return "";

    $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
    $selected_blocks = explode (",", $meta_value);

    $enabled_on_text = $obj->get_ad_enabled_on_which_posts ();
    if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
      if (in_array ($obj->number, $selected_blocks)) return "";
    }
    elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
      if (!in_array ($obj->number, $selected_blocks)) return "";
    }
  } elseif (is_page ()) {
    if (!$obj->get_display_settings_page ()) return "";

    $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
    $selected_blocks = explode (",", $meta_value);

    $enabled_on_text = $obj->get_ad_enabled_on_which_pages ();
    if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
      if (in_array ($obj->number, $selected_blocks)) return "";
    }
    elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
      if (!in_array ($obj->number, $selected_blocks)) return "";
    }
  } elseif (is_category()){
    if (!$obj->get_display_settings_category()) return "";
  } elseif (is_search()){
    if (!$obj->get_display_settings_search()) return "";
  } elseif (is_archive()){
    if (!$obj->get_display_settings_archive()) return "";
  }

  if ($obj->get_ad_data() == AD_EMPTY_DATA) return "";

  if (!$obj->check_category ()) return "";

  if (!$obj->check_tag ()) return "";

  if (!$obj->check_url ()) return "";

  if (!$obj->check_date ()) return "";

  if (!$obj->check_referer ()) return "";

  if (!$obj->check_block_counter ()) return "";

  $block_class_name = get_block_class_name ();

  $device_class = "";
  if ($obj->get_detection_client_side ()) {
        if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES) $device_class = " ai-desktop";
    elseif ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES) $device_class = " ai-tablet-phone";
    elseif ($display_for_devices == AD_DISPLAY_TABLET_DEVICES) $device_class = " ai-tablet";
    elseif ($display_for_devices == AD_DISPLAY_PHONE_DEVICES) $device_class = " ai-phone";
    elseif ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES) $device_class = " ai-desktop-tablet";
    elseif ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES) $device_class = " ai-desktop-phone";
  }

  if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $ad_code = ai_getAdCode ($obj); else
    $ad_code = "<div class='" . $block_class_name . " " . $block_class_name . "-" . $ad_number. $device_class . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>";

  return $ad_code;
}


function ai_content_hook ($content = ''){
  global $block_object;

  for ($counter = 1; $counter <= AD_INSERTER_BLOCKS; $counter ++) {
    $obj = $block_object [$counter];

    $display_type = $obj->get_display_type();
    $manual_insert = $obj->get_enable_manual ();

    if ($display_type != AD_SELECT_BEFORE_PARAGRAPH &&
        $display_type != AD_SELECT_AFTER_PARAGRAPH &&
        $display_type != AD_SELECT_BEFORE_CONTENT &&
        $display_type != AD_SELECT_AFTER_CONTENT &&
        !$manual_insert) continue;

    $display_for_users = $obj->get_display_for_users ();

    if ($display_for_users == AD_DISPLAY_LOGGED_IN_USERS && !is_user_logged_in ()) continue;
    if ($display_for_users == AD_DISPLAY_NOT_LOGGED_IN_USERS && is_user_logged_in ()) continue;

    $display_for_devices = $obj->get_display_for_devices ();

    if ($obj->get_detection_server_side ()) {
      if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES && !AI_DESKTOP) continue;
      if ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES && !AI_MOBILE) continue;
      if ($display_for_devices == AD_DISPLAY_TABLET_DEVICES && !AI_TABLET) continue;
      if ($display_for_devices == AD_DISPLAY_PHONE_DEVICES && !AI_PHONE) continue;
      if ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES && !(AI_DESKTOP || AI_TABLET)) continue;
      if ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES && !(AI_DESKTOP || AI_PHONE)) continue;
    }

    //if empty data, continue next
    if ($obj->get_ad_data() == AD_EMPTY_DATA) {
      continue;
    }

    if (is_single ()) {
      if (!$obj->get_display_settings_post ()) continue;

      $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
      $selected_blocks = explode (",", $meta_value);

      $enabled_on_text = $obj->get_ad_enabled_on_which_posts ();
      if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
        if (in_array ($obj->number, $selected_blocks)) continue;
      }
      elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
        if (!in_array ($obj->number, $selected_blocks)) continue;
      }
    } elseif (is_page ()) {
      if (!$obj->get_display_settings_page ()) continue;

      $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
      $selected_blocks = explode (",", $meta_value);

      $enabled_on_text = $obj->get_ad_enabled_on_which_pages ();
      if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
        if (in_array ($obj->number, $selected_blocks)) continue;
      }
      elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
        if (!in_array ($obj->number, $selected_blocks)) continue;
      }
    } else continue;

//    Deprecated
//    if ($obj->display_disabled ($content)) continue;

    if (!$obj->check_category ()) continue;

    if (!$obj->check_tag ()) continue;

    if (!$obj->check_url ()) continue;

    if (!$obj->check_date ()) continue;

    if (!$obj->check_referer ()) continue;

    if (!$obj->check_block_counter ()) continue;

    if ($display_type == AD_SELECT_BEFORE_PARAGRAPH) {
      $content = $obj->before_paragraph ($content);
    } elseif ($display_type == AD_SELECT_AFTER_PARAGRAPH) {
      $content = $obj->after_paragraph ($content);
    } elseif ($display_type == AD_SELECT_BEFORE_CONTENT) {
      $content = $obj->before_content ($content);
    } elseif ($display_type == AD_SELECT_AFTER_CONTENT) {
      $content = $obj->after_content ($content);
    }
  }

   // Clean remaining deprecated tags
//   $content = preg_replace ("/{adinserter (.*)}/", "", $content);

  return $content;
}

// Process Before/After Excerpt postion
function ai_excerpt_hook ($content = ''){
  global $ad_interter_globals, $block_object;

  if (!isset ($ad_interter_globals ['EXCERPT'])) {
    $ad_interter_globals ['EXCERPT'] = 1;
  } else $ad_interter_globals ['EXCERPT'] ++;
  $excerpt_counter = $ad_interter_globals ['EXCERPT'];

  for ($block_index = 1; $block_index <= AD_INSERTER_BLOCKS; $block_index ++) {
    $obj = $block_object [$block_index];

    $display_type = $obj->get_display_type ();

    if ($display_type != AD_SELECT_BEFORE_EXCERPT && $display_type != AD_SELECT_AFTER_EXCERPT) continue;

    $display_for_users = $obj->get_display_for_users ();

    if ($display_for_users == AD_DISPLAY_LOGGED_IN_USERS && !is_user_logged_in ()) continue;
    if ($display_for_users == AD_DISPLAY_NOT_LOGGED_IN_USERS && is_user_logged_in ()) continue;

    $display_for_devices = $obj->get_display_for_devices ();

    if ($obj->get_detection_server_side ()) {
      if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES && !AI_DESKTOP) continue;
      if ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES && !AI_MOBILE) continue;
      if ($display_for_devices == AD_DISPLAY_TABLET_DEVICES && !AI_TABLET) continue;
      if ($display_for_devices == AD_DISPLAY_PHONE_DEVICES && !AI_PHONE) continue;
      if ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES && !(AI_DESKTOP || AI_TABLET)) continue;
      if ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES && !(AI_DESKTOP || AI_PHONE)) continue;
    }

    $excerpt_number = $obj->get_excerpt_number();
    $excerpt_settings = array ();
    if (strpos ($excerpt_number, ",") !== false) {
      $excerpt_settings = explode (",", $excerpt_number);
    } else $excerpt_settings []= $excerpt_number;

    if ($obj->get_excerpt_number() != 0 && !in_array ($excerpt_counter, $excerpt_settings)) continue;

    if (is_front_page ()){
      if (!$obj->get_display_settings_home()) continue;
    }
    elseif (is_category()){
      if (!$obj->get_display_settings_category()) continue;
    }
    elseif (is_search()){
      if (!$obj->get_display_settings_search()) continue;
    }
    elseif (is_archive()){
      if (!$obj->get_display_settings_archive()) continue;
    }

    //if empty data, continue with next
    if ($obj->get_ad_data() == AD_EMPTY_DATA){
      continue;
    }

    // Deprecated
//    if ($obj->display_disabled ($content)) continue;

    if (!$obj->check_category ()) continue;

    if (!$obj->check_tag ()) continue;

    if (!$obj->check_url ()) continue;

    if (!$obj->check_referer ()) continue;

    if (!$obj->check_block_counter ()) continue;

    $block_class_name = get_block_class_name ();

    $device_class = "";
    if ($obj->get_detection_client_side ()) {
          if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES) $device_class = " ai-desktop";
      elseif ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES) $device_class = " ai-tablet-phone";
      elseif ($display_for_devices == AD_DISPLAY_TABLET_DEVICES) $device_class = " ai-tablet";
      elseif ($display_for_devices == AD_DISPLAY_PHONE_DEVICES) $device_class = " ai-phone";
      elseif ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES) $device_class = " ai-desktop-tablet";
      elseif ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES) $device_class = " ai-desktop-phone";
    }

    if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $ad_code = ai_getAdCode ($obj); else
      $ad_code = "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block_index . $device_class . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>";

    if ($display_type == AD_SELECT_BEFORE_EXCERPT)
        $content = $ad_code . $content; else
          $content = $content . $ad_code;
  }

  return $content;
}

// Process Before Title postion
function ai_loop_start_hook ($query){
  global $block_object;

  if (!method_exists ($query, 'is_main_query')) return;
  if (!$query->is_main_query()) return;
  if (is_feed()) return;
  if (strpos ($_SERVER ['REQUEST_URI'], '/wp-admin/') === 0) return;

  $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
  $selected_blocks = explode (",", $meta_value);

  $ad_code = "";

  for ($block_index = 1; $block_index <= AD_INSERTER_BLOCKS; $block_index ++) {
    $obj = $block_object [$block_index];

    if ($obj->get_display_type () != AD_SELECT_BEFORE_TITLE) continue;

    $display_for_users = $obj->get_display_for_users ();

    if ($display_for_users == AD_DISPLAY_LOGGED_IN_USERS && !is_user_logged_in ()) continue;
    if ($display_for_users == AD_DISPLAY_NOT_LOGGED_IN_USERS && is_user_logged_in ()) continue;

    $display_for_devices = $obj->get_display_for_devices ();

    if ($obj->get_detection_server_side ()) {
      if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES && !AI_DESKTOP) continue;
      if ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES && !AI_MOBILE) continue;
      if ($display_for_devices == AD_DISPLAY_TABLET_DEVICES && !AI_TABLET) continue;
      if ($display_for_devices == AD_DISPLAY_PHONE_DEVICES && !AI_PHONE) continue;
      if ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES && !(AI_DESKTOP || AI_TABLET)) continue;
      if ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES && !(AI_DESKTOP || AI_PHONE)) continue;
    }

    if (is_front_page ()){
      if (!$obj->get_display_settings_home()) continue;
    }
    elseif (is_page()){
      if (!$obj->get_display_settings_page()) continue;

      $enabled_on_text = $obj->get_ad_enabled_on_which_pages ();
      if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
        if (in_array ($obj->number, $selected_blocks)) continue;
      }
      elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
        if (!in_array ($obj->number, $selected_blocks)) continue;
      }
    }
    elseif (is_single()){
      if (!$obj->get_display_settings_post()) continue;

      $enabled_on_text = $obj->get_ad_enabled_on_which_posts ();
      if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
        if (in_array ($obj->number, $selected_blocks)) continue;
      }
      elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
        if (!in_array ($obj->number, $selected_blocks)) continue;
      }
    }
    elseif (is_category()){
      if (!$obj->get_display_settings_category()) continue;
    }
    elseif (is_search()){
      if (!$obj->get_display_settings_search()) continue;
    }
    elseif (is_archive()){
      if (!$obj->get_display_settings_archive()) continue;
    }

    //if empty data, continue with next
    if ($obj->get_ad_data() == AD_EMPTY_DATA) continue;

    if (!$obj->check_category ()) continue;

    if (!$obj->check_tag ()) continue;

    if (!$obj->check_url ()) continue;

    if (!$obj->check_date ()) continue;

    if (!$obj->check_referer ()) continue;

    if (!$obj->check_block_counter ()) continue;

    $block_class_name = get_block_class_name ();

    $device_class = "";
    if ($obj->get_detection_client_side ()) {
          if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES) $device_class = " ai-desktop";
      elseif ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES) $device_class = " ai-tablet-phone";
      elseif ($display_for_devices == AD_DISPLAY_TABLET_DEVICES) $device_class = " ai-tablet";
      elseif ($display_for_devices == AD_DISPLAY_PHONE_DEVICES) $device_class = " ai-phone";
      elseif ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES) $device_class = " ai-desktop-tablet";
      elseif ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES) $device_class = " ai-desktop-phone";
    }

    if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $ad_code .= ai_getAdCode ($obj); else
      $ad_code .= "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block_index . $device_class . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>";
  }

  echo $ad_code;
}

/*
function ai_isCategoryAllowed ($categories, $cat_type) {

  $categories = trim (strtolower ($categories));

//  echo ' listed categories: ' . $categories, "<br />\n";

  if ($cat_type == AD_BLACK_LIST) {

    if($categories == AD_EMPTY_DATA) {
      return true;
    }

    $cats_listed = explode (",", $categories);

    foreach((get_the_category()) as $post_category) {

      //echo '<br/> post category name : ' . $post_category->cat_name;

      foreach($cats_listed as $cat_disabled){

        $cat_disabled = trim ($cat_disabled);

        $post_category_name = strtolower ($post_category->cat_name);
        $post_category_slug = strtolower ($post_category->slug);

        //echo '<br/>Category disabled loop : ' . $cat_disabled . '<br/> category name : ' . $post_category_name;

        if ($post_category_name == $cat_disabled || $post_category_slug == $cat_disabled) {
          //echo ' match';
          return false;
        }else{
          //echo ' not match';
        }
      }
    }
    return true;

  } else {

      if ($categories == AD_EMPTY_DATA){
        return false;
      }

      $cats_listed = explode (",", $categories);

      foreach((get_the_category()) as $post_category) {

        //echo '<br/> post category name : ' . $post_category->cat_name;

        foreach($cats_listed as $cat_enabled){

          $cat_enabled = trim ($cat_enabled);

          $post_category_name = strtolower ($post_category->cat_name);
          $post_category_slug = strtolower ($post_category->slug);

//          echo '<br/>Category enabled loop : ' . $cat_enabled . '<br/> category name : ' . $post_category_name . '<br/> category slug: ' . $post_category_slug;

          if ($post_category_name == $cat_enabled || $post_category_slug == $cat_enabled) {
//            echo '#match';
            return true;
          }else{
//            echo '#no match';
          }
        }
      }
      return false;
    }
}

function ai_isTagAllowed ($tags, $tag_type){

  $tags = trim (strtolower ($tags));
  $tags_listed = explode (",", $tags);
  foreach ($tags_listed as $index => $tag_listed) {
    $tags_listed [$index] = trim ($tag_listed);
  }
  $has_any_of_the_given_tags = has_tag ($tags_listed);

//  echo ' listed tags: ' . $tags, "\n";

  if ($tag_type == AD_BLACK_LIST) {

    if ($tags == AD_EMPTY_DATA) {
      return true;
    }

    if (is_tag()) {
      foreach ($tags_listed as $tag_listed) {
        if (is_tag ($tag_listed)) return false;
      }
      return true;
    }

    return !$has_any_of_the_given_tags;

  } else {

      if ($tags == AD_EMPTY_DATA){
        return false;
      }

      if (is_tag()) {
        foreach ($tags_listed as $tag_listed) {
          if (is_tag ($tag_listed)) return true;
        }
        return false;
      }

      return $has_any_of_the_given_tags;
    }
}

function ai_isUrlAllowed ($urls, $url_type){

  $page_url = $_SERVER ['REQUEST_URI'];

  $urls = trim ($urls);
  $urls_listed = explode (" ", $urls);
  foreach ($urls_listed as $index => $url_listed) {
    if ($url_listed == "") unset ($urls_listed [$index]); else
      $urls_listed [$index] = trim ($url_listed);
  }

//  print_r ($urls_listed);
//  echo "<br />\n";
//  echo ' page url: ' . $page_url, "<br />\n";
//  echo ' listed urls: ' . $urls, "\n";
//  echo "<br />\n";

  if ($url_type == AD_BLACK_LIST) $return = false; else $return = true;

  if ($urls == AD_EMPTY_DATA) {
    return !$return;
  }

  foreach ($urls_listed as $url_listed) {
    if ($url_listed [0] == '') continue;
    if ($url_listed == '*') return $return;

    if ($url_listed [0] == '*') {
      if ($url_listed [strlen ($url_listed) - 1] == '*') {
        $url_listed = substr ($url_listed, 1, strlen ($url_listed) - 2);
        if (strpos ($page_url, $url_listed) !== false) return $return;
      } else {
          $url_listed = substr ($url_listed, 1);
          if (substr ($page_url, - strlen ($url_listed)) == $url_listed) return $return;
        }
    }
    elseif ($url_listed [strlen ($url_listed) - 1] == '*') {
      $url_listed = substr ($url_listed, 0, strlen ($url_listed) - 1);
      if (strpos ($page_url, $url_listed) === 0) return $return;
    }
    else if ($url_listed == $page_url) return $return;
  }
  return !$return;
}

function ai_isDisplayDisabled ($obj, $content){

  $ad_name = $obj->get_ad_name();

  if (preg_match ("/<!-- +Ad +Inserter +Ad +".($obj->number)." +Disabled +-->/i", $content)) return true;

  if (preg_match ("/<!-- +disable +adinserter +\* +-->/i", $content)) return true;

  if (preg_match ("/<!-- +disable +adinserter +".($obj->number)." +-->/i", $content)) return true;

//  if (preg_match ("/<!-- +disable +adinserter +".(trim ($obj->get_ad_name()))." +-->/i", $content)) return true;
  if (strpos ($content, "<!-- disable adinserter " . $ad_name . " -->") != false) return true;

  return false;
}

function ai_isDisplayDateAllowed ($obj, $publish_date){

  $after_days = trim ($obj->get_ad_after_day());

  // If 0 display immediately
  if($after_days == AD_ZERO || $after_days == AD_EMPTY_DATA){
    return true;
  }

  return (date ('U', time ()) >= $publish_date + $after_days * 86400);
}

function ai_isRefererAllowed ($obj) {

  $domain_list_type = $obj->get_ad_domain_list_type ();

  if (isset ($_SERVER['HTTP_REFERER'])) {
      $http_referer = $_SERVER['HTTP_REFERER'];
  } else $http_referer = '';

  if ($domain_list_type == AD_BLACK_LIST) $return = false; else $return = true;

  $domains = trim ($obj->get_ad_domain_list ());
  if ($domains == "") return !$return;
  $domains = explode (",", $domains);

  foreach ($domains as $domain) {
    $domain = trim ($domain);
    if ($domain == "") continue;

    if ($domain == "#") {
      if ($http_referer == "") return $return;
    } elseif (preg_match ("/" . $domain . "/i", $http_referer)) return $return;
  }
  return !$return;
}
*/

function ai_getCode ($obj){
  $code = $obj->get_ad_data();

  if ($obj->get_process_php ()) {
    ob_start ();
    eval ("?>". $code . "<?php ");
    $code = ob_get_clean ();
  }

  return $code;
}


function ai_getAdCode ($obj){

  $ad_code = $obj->get_ad_data_replaced();

  if ($obj->get_process_php ()) {
    ob_start ();
    eval ("?>". $ad_code . "<?php ");
    $ad_code = ob_get_clean ();
  }

  if (strpos ($ad_code, AD_SEPARATOR) !== false) {
    $ads = explode (AD_SEPARATOR, $ad_code);
    $ad_code = $ads [rand (0, sizeof ($ads) - 1)];
  }

// No shortcode processing if recursion is detected
//  if (preg_match ("/\[adinserter block=\"".$obj->number."\"[^\]]*\]/", $ad_code, $adinserter_shortcodes)) return $ad_code;
//  if (preg_match ("/\[adinserter name=\"".$obj->get_ad_name()."\"[^\]]*\]/", $ad_code, $adinserter_shortcodes)) return $ad_code;

  return do_shortcode ($ad_code);
}

/*

function ai_generateBeforeParagraph ($block, $content, $obj){

  $paragraph_positions = array ();
  $last_position = - 1;

  $paragraph_start = "<p";

  while (stripos ($content, $paragraph_start, $last_position + 1) !== false) {
    $last_position = stripos ($content, $paragraph_start, $last_position + 1);
    if ($content [$last_position + 2] == ">" || $content [$last_position + 2] == " ")
      $paragraph_positions [] = $last_position;
  }

  $paragraph_min_words = $obj->get_minimum_paragraph_words();
  if ($paragraph_min_words != 0) {
    $filtered_paragraph_positions = array ();
    foreach ($paragraph_positions as $index => $paragraph_position) {
      $paragraph_code = $index == count ($paragraph_positions) - 1 ? substr ($content, $paragraph_position) : substr ($content, $paragraph_position, $paragraph_positions [$index + 1] - $paragraph_position);
      $number_of_words = sizeof (explode (" ", strip_tags ($paragraph_code)));
      if ($number_of_words >= $paragraph_min_words) $filtered_paragraph_positions [] = $paragraph_position;
    }
    $paragraph_positions = $filtered_paragraph_positions;
  }

  $paragraph_texts = explode (",", html_entity_decode ($obj->get_paragraph_text()));
  if ($obj->get_paragraph_text() != "" && count ($paragraph_texts != 0)) {

    $filtered_paragraph_positions = array ();
    $paragraph_text_type = $obj->get_paragraph_text_type ();

    foreach ($paragraph_positions as $index => $paragraph_position) {
      $paragraph_code = $index == count ($paragraph_positions) - 1 ? substr ($content, $paragraph_position) : substr ($content, $paragraph_position, $paragraph_positions [$index + 1] - $paragraph_position);

      if ($paragraph_text_type == AD_CONTAIN) {
        $found = true;
        foreach ($paragraph_texts as $paragraph_text) {
          if (stripos ($paragraph_code, trim ($paragraph_text)) === false) {
            $found = false;
            break;
          }
        }
        if ($found) $filtered_paragraph_positions [] = $paragraph_position;
      } elseif ($paragraph_text_type == AD_DO_NOT_CONTAIN) {
          $found = false;
          foreach ($paragraph_texts as $paragraph_text) {
            if (stripos ($paragraph_code, trim ($paragraph_text)) !== false) {
              $found = true;
              break;
            }
          }
          if (!$found) $filtered_paragraph_positions [] = $paragraph_position;
        }
    }

    $paragraph_positions = $filtered_paragraph_positions;
  }

  // Nothing to do
  if (sizeof ($paragraph_positions) == 0) return $content;

  $position = $obj->get_paragraph_number();

  if ($position > 0 && $position < 1) {
    $position = intval ($position * (sizeof ($paragraph_positions) - 1) + 0.5);
  }
  elseif ($position <= 0) {
    $position = rand (0, sizeof ($paragraph_positions) - 1);
  } else $position --;

  if ($obj->get_direction_type() == AD_DIRECTION_FROM_BOTTOM) {
    $paragraph_positions = array_reverse ($paragraph_positions);
  }

  $text = str_replace (array ("\n", "  "), " ", $content);
  $text = strip_tags ($text);
  $number_of_words = sizeof (explode (" ", $text));

  if (sizeof ($paragraph_positions) > $position && sizeof ($paragraph_positions) >= $obj->get_paragraph_number_minimum() && $number_of_words >= $obj->get_minimum_words()) {
    $content_position = $paragraph_positions [$position];

    $block_class_name = get_block_class_name ();

    $display_for_devices = $obj->get_display_for_devices ();

    $device_class = "";
    if ($obj->get_detection_client_side ()) {
          if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES) $device_class = " ai-desktop";
      elseif ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES) $device_class = " ai-tablet-phone";
      elseif ($display_for_devices == AD_DISPLAY_TABLET_DEVICES) $device_class = " ai-tablet";
      elseif ($display_for_devices == AD_DISPLAY_PHONE_DEVICES) $device_class = " ai-phone";
      elseif ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES) $device_class = " ai-desktop-tablet";
      elseif ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES) $device_class = " ai-desktop-phone";
    }

    if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $content = substr_replace ($content, ai_getAdCode ($obj), $content_position, 0); else
      $content = substr_replace ($content, "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block . $device_class . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>", $content_position, 0);
  }

  return $content;
}

function ai_generateAfterParagraph ($block, $content, $obj){

  $paragraph_positions = array ();
  $last_position = - 1;

  $paragraph_end = "</p>";

  while (stripos ($content, $paragraph_end, $last_position + 1) !== false){
    $last_position = stripos ($content, $paragraph_end, $last_position + 1) + 3;
    $paragraph_positions [] = $last_position;
  }

  $paragraph_min_words = $obj->get_minimum_paragraph_words();
  if ($paragraph_min_words != 0) {
    $filtered_paragraph_positions = array ();
    foreach ($paragraph_positions as $index => $paragraph_position) {
      $paragraph_code = $index == 0 ? substr ($content, 0, $paragraph_position + 1) : substr ($content, $paragraph_positions [$index - 1] + 1, $paragraph_position - $paragraph_positions [$index - 1]);
      $number_of_words = sizeof (explode (" ", strip_tags ($paragraph_code)));
      if ($number_of_words >= $paragraph_min_words) $filtered_paragraph_positions [] = $paragraph_position;
    }
    $paragraph_positions = $filtered_paragraph_positions;
  }

  $paragraph_texts = explode (",", html_entity_decode ($obj->get_paragraph_text()));
  if ($obj->get_paragraph_text() != "" && count ($paragraph_texts != 0)) {

    $filtered_paragraph_positions = array ();
    $paragraph_text_type = $obj->get_paragraph_text_type ();

    foreach ($paragraph_positions as $index => $paragraph_position) {
      $paragraph_code = $index == 0 ? substr ($content, 0, $paragraph_position + 1) : substr ($content, $paragraph_positions [$index - 1] + 1, $paragraph_position - $paragraph_positions [$index - 1]);

      if ($paragraph_text_type == AD_CONTAIN) {
        $found = true;
        foreach ($paragraph_texts as $paragraph_text) {
          if (stripos ($paragraph_code, trim ($paragraph_text)) === false) {
            $found = false;
            break;
          }
        }
        if ($found) $filtered_paragraph_positions [] = $paragraph_position;
      } elseif ($paragraph_text_type == AD_DO_NOT_CONTAIN) {
          $found = false;
          foreach ($paragraph_texts as $paragraph_text) {
            if (stripos ($paragraph_code, trim ($paragraph_text)) !== false) {
              $found = true;
              break;
            }
          }
          if (!$found) $filtered_paragraph_positions [] = $paragraph_position;
        }
    }

    $paragraph_positions = $filtered_paragraph_positions;
  }

  // Nothing to do
  if (sizeof ($paragraph_positions) == 0) return $content;

  $position = $obj->get_paragraph_number();

  if ($position > 0 && $position < 1) {
    $position = intval ($position * (sizeof ($paragraph_positions) - 1) + 0.5);
  }
  elseif ($position <= 0) {
    $position = rand (0, sizeof ($paragraph_positions) - 1);
  } else $position --;

  if ($obj->get_direction_type() == AD_DIRECTION_FROM_BOTTOM) {
    $paragraph_positions = array_reverse ($paragraph_positions);
  }

  $text = str_replace (array ("\n", "  "), " ", $content);
  $text = strip_tags ($text);
  $number_of_words = sizeof (explode (" ", $text));

  if (sizeof ($paragraph_positions) > $position && sizeof ($paragraph_positions) >= $obj->get_paragraph_number_minimum() && $number_of_words >= $obj->get_minimum_words()) {
    $content_position = $paragraph_positions [$position];

    $block_class_name = get_block_class_name ();

    $display_for_devices = $obj->get_display_for_devices ();

    $device_class = "";
    if ($obj->get_detection_client_side ()) {
          if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES) $device_class = " ai-desktop";
      elseif ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES) $device_class = " ai-tablet-phone";
      elseif ($display_for_devices == AD_DISPLAY_TABLET_DEVICES) $device_class = " ai-tablet";
      elseif ($display_for_devices == AD_DISPLAY_PHONE_DEVICES) $device_class = " ai-phone";
      elseif ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES) $device_class = " ai-desktop-tablet";
      elseif ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES) $device_class = " ai-desktop-phone";
    }

    if ($content_position >= strlen ($content) - 1) {
      if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $content = $content = $content . ai_getAdCode ($obj); else
        $content = $content . "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block . $device_class . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>";
    } else {
        if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $content = substr_replace ($content, ai_getAdCode ($obj), $content_position + 1, 0); else
          $content = substr_replace ($content, "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block . $device_class . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>", $content_position + 1, 0);
      }
  }

  return $content;
}

function ai_generateDivBefore ($block, $content, $obj){
  $block_class_name = get_block_class_name ();

  $display_for_devices = $obj->get_display_for_devices ();

  $device_class = "";
  if ($obj->get_detection_client_side ()) {
        if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES) $device_class = " ai-desktop";
    elseif ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES) $device_class = " ai-tablet-phone";
    elseif ($display_for_devices == AD_DISPLAY_TABLET_DEVICES) $device_class = " ai-tablet";
    elseif ($display_for_devices == AD_DISPLAY_PHONE_DEVICES) $device_class = " ai-phone";
    elseif ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES) $device_class = " ai-desktop-tablet";
    elseif ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES) $device_class = " ai-desktop-phone";
  }

  if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) return ai_getAdCode ($obj) . $content; else
    return "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block . $device_class . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>" . $content;
}

function ai_generateDivAfter ($block, $content, $obj){
  $block_class_name = get_block_class_name ();

  $display_for_devices = $obj->get_display_for_devices ();

  $device_class = "";
  if ($obj->get_detection_client_side ()) {
        if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES) $device_class = " ai-desktop";
    elseif ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES) $device_class = " ai-tablet-phone";
    elseif ($display_for_devices == AD_DISPLAY_TABLET_DEVICES) $device_class = " ai-tablet";
    elseif ($display_for_devices == AD_DISPLAY_PHONE_DEVICES) $device_class = " ai-phone";
    elseif ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES) $device_class = " ai-desktop-tablet";
    elseif ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES) $device_class = " ai-desktop-phone";
  }

  if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) return $content . ai_getAdCode ($obj); else
    return $content . "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block . $device_class . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>";
}

function ai_generateDivManual ($block, $content, $obj, $ad_number){

  if (preg_match_all("/{adinserter (.+?)}/", $content, $tags)){

    $block_class_name = get_block_class_name ();

    $display_for_devices = $obj->get_display_for_devices ();

    $device_class = "";
    if ($obj->get_detection_client_side ()) {
          if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES) $device_class = " ai-desktop";
      elseif ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES) $device_class = " ai-tablet-phone";
      elseif ($display_for_devices == AD_DISPLAY_TABLET_DEVICES) $device_class = " ai-tablet";
      elseif ($display_for_devices == AD_DISPLAY_PHONE_DEVICES) $device_class = " ai-phone";
      elseif ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES) $device_class = " ai-desktop-tablet";
      elseif ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES) $device_class = " ai-desktop-phone";
    }

    foreach ($tags [1] as $tag) {
       $ad_tag = strtolower (trim ($tag));
       $ad_name = strtolower (trim ($obj->get_ad_name()));
       if ($ad_tag == $ad_name || $ad_tag == $ad_number) {
        if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $ad_code = ai_getAdCode ($obj); else
          $ad_code = "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block . $device_class . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>";
        $content = preg_replace ("/{adinserter " . $tag . "}/", $ad_code, $content);
       }
    }
  }

  return $content;
}

*/


function process_shortcodes ($atts) {
  global $block_object;

  $parameters = shortcode_atts (array (
    "block" => "",
    "name" => "",
  ), $atts);
  if (is_numeric ($parameters ['block'])) $block = intval ($parameters ['block']); else $block = 0;
  if ($block < 1 && $block > AD_INSERTER_BLOCKS) {
    $block = 0;
  } elseif ($parameters ['name'] != '') {
      $shortcode_name = strtolower ($parameters ['name']);
      for ($counter = 1; $counter <= AD_INSERTER_BLOCKS; $counter ++) {
        $obj = $block_object [$counter];
        $ad_name = strtolower (trim ($obj->get_ad_name()));
        if ($shortcode_name == $ad_name) {
          $block = $counter;
          break;
        }
      }
    }

  if ($block != 0) {
    $obj = $block_object [$block];

    if ($obj->get_enable_manual ()) {
      $display_for_users = $obj->get_display_for_users ();

      if ($display_for_users == AD_DISPLAY_LOGGED_IN_USERS && !is_user_logged_in ()) return "";
      if ($display_for_users == AD_DISPLAY_NOT_LOGGED_IN_USERS && is_user_logged_in ()) return "";

      $display_for_devices = $obj->get_display_for_devices ();

      if ($obj->get_detection_server_side ()) {
        if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES && !AI_DESKTOP) return "";
        if ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES && !AI_MOBILE) return "";
        if ($display_for_devices == AD_DISPLAY_TABLET_DEVICES && !AI_TABLET) return "";
        if ($display_for_devices == AD_DISPLAY_PHONE_DEVICES && !AI_PHONE) return "";
        if ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES && !(AI_DESKTOP || AI_TABLET)) return "";
        if ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES && !(AI_DESKTOP || AI_PHONE)) return "";
      }

      if (!$obj->check_block_counter ()) return "";

      if (is_page() || is_single()) {
        if (!$obj->check_date ()) return "";
      }

      $block_class_name = get_block_class_name ();

      $device_class = "";
      if ($obj->get_detection_client_side ()) {
            if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES) $device_class = " ai-desktop";
        elseif ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES) $device_class = " ai-tablet-phone";
        elseif ($display_for_devices == AD_DISPLAY_TABLET_DEVICES) $device_class = " ai-tablet";
        elseif ($display_for_devices == AD_DISPLAY_PHONE_DEVICES) $device_class = " ai-phone";
        elseif ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES) $device_class = " ai-desktop-tablet";
        elseif ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES) $device_class = " ai-desktop-phone";
      }

      if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) $ad_code = ai_getAdCode ($obj); else
        $ad_code = "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block . $device_class . "' style='" . $obj->get_alignmet_style() . "'>" . ai_getAdCode ($obj) . "</div>";
      return ($ad_code);
    }
  }
  return "";
}


class ai_widget extends WP_Widget {

  function __construct () {
    parent::__construct (
      false,                                  // Base ID
      'Ad Inserter',               // Name
      array (                                 // Args
        'classname'   => 'ai_widget',
        'description' => 'Ad Inserter code block widget.')
    );
  }

  function widget ($args, $instance) {
    global $block_object;

    // Widget output

    $title = !empty ($instance ['widget-title']) ? $instance ['widget-title'] : '';
    $block = !empty ($instance ['block']) ? $instance ['block'] : 1;

    $ad = $block_object [$block];
    ai_widget_draw ($block, $ad, $args, $title);
  }

  function form ($instance) {
    global $block_object;

    // Output admin widget options form

    $widget_title = !empty ($instance ['widget-title']) ? $instance ['widget-title'] : '';
    $block = !empty ($instance ['block']) ? $instance ['block'] : 1;

    $obj = $block_object [$block];

    $title = '[' . $block . '] ' . $obj->get_ad_name();
    if (!empty ($widget_title)) $title .= ' - ' . $widget_title

    ?>
    <input id="<?php echo $this->get_field_id ('title'); ?>" name="<?php echo $this->get_field_name ('title'); ?>" type="hidden" value="<?php echo esc_attr ($title); ?>">

    <p>
      <label for="<?php echo $this->get_field_id ('widget-title'); ?>">Title:</label>
      <input id="<?php echo $this->get_field_id ('widget-title'); ?>" name="<?php echo $this->get_field_name ('widget-title'); ?>" type="text" value="<?php echo esc_attr ($widget_title); ?>" style="width: 90%;">
    </p>

    <p>
      <label for="<?php echo $this->get_field_id ('block'); ?>">Block:</label>
      <select id="<?php echo $this->get_field_id ('block'); ?>" name="<?php echo $this->get_field_name('block'); ?>" style="width: 88%;">
        <?php
          for ($block_index = 1; $block_index <= AD_INSERTER_BLOCKS; $block_index ++) {
            $obj = $block_object [$block_index];
        ?>
        <option value='<?php echo $block_index; ?>' <?php if ($block_index == $block) echo 'selected="selected"'; ?>><?php echo $obj->get_ad_name(); ?></option>
        <?php } ?>
      </select>
    </p>
    <?php
  }

  function update ($new_instance, $old_instance) {
    // Save widget options
    $instance = $old_instance;

    $instance ['widget-title'] = (!empty ($new_instance ['widget-title'])) ? strip_tags ($new_instance ['widget-title']) : '';
    $instance ['title'] = (!empty ($new_instance ['title'])) ? strip_tags ($new_instance ['title']) : '';
    $instance ['block'] = (!empty ($new_instance ['block'])) ? $new_instance ['block'] : 1;

    return $instance;
  }
}


// OLD WIDGETS - DEPRECATED

//function ai_widget ($args, $parameters) {
//  global $block_object;

//  $block = $parameters ['block'];
//  $ad = $block_object [$block];
//  ai_widget_draw ($block, $ad, $args);
//}


// Fix because widgets that share callback functions don't get displayed

function ai_widget1 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget2 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget3 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget4 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget5 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget6 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget7 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget8 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget9 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget10 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget11 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget12 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget13 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget14 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget15 ($args, $parameters) {
  ai_widget ($args, $parameters);
}

function ai_widget16 ($args, $parameters) {
  ai_widget ($args, $parameters);
}
// OLD WIDGETS END


function ai_widget_draw ($block, $obj, $args, $title = '') {

  $display_for_users = $obj->get_display_for_users ();

  if ($display_for_users == AD_DISPLAY_LOGGED_IN_USERS && !is_user_logged_in ()) return;
  if ($display_for_users == AD_DISPLAY_NOT_LOGGED_IN_USERS && is_user_logged_in ()) return;

  $display_for_devices = $obj->get_display_for_devices ();

  if ($obj->get_detection_server_side ()) {
    if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES && !AI_DESKTOP) return;
    if ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES && !AI_MOBILE) return;;
    if ($display_for_devices == AD_DISPLAY_TABLET_DEVICES && !AI_TABLET) return;
    if ($display_for_devices == AD_DISPLAY_PHONE_DEVICES && !AI_PHONE) return;
    if ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES && !(AI_DESKTOP || AI_TABLET)) return;
    if ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES && !(AI_DESKTOP || AI_PHONE)) return;
  }

//  if ($obj->get_display_type () != AD_SELECT_WIDGET) return;

  //if empty data, continue next
  if($obj->get_ad_data()==AD_EMPTY_DATA){
     return;
  }

  if(is_front_page ()){
     if (!$obj->get_display_settings_home()) return;
  }
  elseif(is_page()){
     if (!$obj->get_display_settings_page()) return;

     $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
     $selected_blocks = explode (",", $meta_value);

     $enabled_on_text = $obj->get_ad_enabled_on_which_pages ();
     if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
       if (in_array ($obj->number, $selected_blocks)) return;
     }
     elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
       if (!in_array ($obj->number, $selected_blocks)) return;
     }
  }
  elseif(is_single()){
     if (!$obj->get_display_settings_post()) return;

     $meta_value = get_post_meta (get_the_ID (), '_adinserter_block_exceptions', true);
     $selected_blocks = explode (",", $meta_value);

     $enabled_on_text = $obj->get_ad_enabled_on_which_posts ();
     if ($enabled_on_text == AD_ENABLED_ON_ALL_EXCEPT_ON_SELECTED) {
       if (in_array ($obj->number, $selected_blocks)) return;
     }
     elseif ($enabled_on_text == AD_ENABLED_ONLY_ON_SELECTED) {
       if (!in_array ($obj->number, $selected_blocks)) return;
     }
  }
  elseif(is_category()){
     if (!$obj->get_display_settings_category()) return;
  }
  elseif(is_search()){
     if (!$obj->get_display_settings_search()) return;
  }
  elseif(is_archive()){
     if (!$obj->get_display_settings_archive()) return;
  }

  if (!$obj->check_category ()) return;

  if (!$obj->check_tag ()) return;

  if (!$obj->check_url ()) return;

  if (!$obj->check_referer ()) return;

  if (!$obj->check_block_counter ()) return;

  $block_class_name = get_block_class_name ();

  $device_class = "";
  if ($obj->get_detection_client_side ()) {
        if ($display_for_devices == AD_DISPLAY_DESKTOP_DEVICES) $device_class = "ai-desktop";
    elseif ($display_for_devices == AD_DISPLAY_MOBILE_DEVICES) $device_class = "ai-tablet-phone";
    elseif ($display_for_devices == AD_DISPLAY_TABLET_DEVICES) $device_class = "ai-tablet";
    elseif ($display_for_devices == AD_DISPLAY_PHONE_DEVICES) $device_class = "ai-phone";
    elseif ($display_for_devices == AD_DISPLAY_DESKTOP_TABLET_DEVICES) $device_class = "ai-desktop-tablet";
    elseif ($display_for_devices == AD_DISPLAY_DESKTOP_PHONE_DEVICES) $device_class = "ai-desktop-phone";
  }

  if ($device_class != "") echo "<div class='" . $device_class . "'>";
  echo $args ['before_widget'];

  if (!empty ($title)) {
    echo $args ['before_title'], apply_filters ('widget_title', $title), $args ['after_title'];
  }

  if ($obj->get_alignment_type() == AD_ALIGNMENT_NO_WRAPPING) echo ai_getAdCode ($obj); else
    echo "<div class='" . $block_class_name . " " . $block_class_name . "-" . $block . "' style='" . $obj->get_alignmet_style (false) . "'>" . ai_getAdCode ($obj) . "</div>";

  echo $args ['after_widget'];
  if ($device_class != "") echo "</div>";
}
