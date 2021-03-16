<?php
/**
@package WPGrabber
Plugin Name: WPGrabber Lite
Plugin URI: http://wpgrabber.ru
Description: WordPess Grabber plugin
Version: 2.0.5 Lite (19.11.2014)
Author: GrabTeam
Author URI: http://wpgrabber.ru
*/
  if (defined('WPGRABBER_VERSION')) {
    die('На сайте активирован плагин WPGrabber версии '.WPGRABBER_VERSION.'. Пожалуйста, деактивируйте его перед активацией данного плагина.');
  }
  define('WPGRABBER_VERSION', '2.0.6 Lite');

  define('WPGRABBER_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
  define('WPGRABBER_PLUGIN_URL', plugin_dir_url( __FILE__ ));
  define('WPGRABBER_PLUGIN_FILE', __FILE__);

  require WPGRABBER_PLUGIN_DIR.'init.php';
?>