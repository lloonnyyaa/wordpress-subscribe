<?php

/*
  Plugin Name: Subscribe
  Description: Subscribe to blog articles
  Version: 1.0.0
  Author: Viaduct
  Author URI: http://viaduct.pro
  Text Domain: vd-subscribe
 */

namespace vds;

use vds\component\Plugin;

if (!defined('WPINC')) {
    die;
}

require_once 'vendor/autoload.php';

add_action('init', function() {
    Plugin::$path = plugin_dir_path(__FILE__) . 'src/';
    Plugin::$url = plugin_dir_url(__FILE__) . 'src/';
    Plugin::run();
});


