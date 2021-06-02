<?php
/**
 * Plugin Name:       MB Latest Music
 * Plugin URI:        https://github.com/mb-dev-75/mb-latest-music
 * Description:       Share a track from your latest musical project
 * Version:           1.0.0
 * Author:            MB
 * Author URI:        https://github.com/mb-dev-75/
 * License:           MIT
 * Text Domain:       mb-latest-music
 * Domain Path:       /languages
 */

// Security
if(!defined('ABSPATH' )) {
  exit;
}
// Loading scripts (CSS et JS)
require_once(plugin_dir_path(__FILE__).'/includes/mb-latest-music-scripts.php');

// Loading class
require_once(plugin_dir_path(__FILE__).'/includes/mb-latest-music-class.php');

// Widget register
function register_mb_latest_music() {
  register_widget('mb_Latest_Music_Widget');
}

add_action('widgets_init', 'register_mb_latest_music');
