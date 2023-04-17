<?php

use iamntz\acf\unique_id\AcfUniqueID;

!defined('ABSPATH') && die();

/*
Plugin Name: ACF Unique ID Field
Author: Ionuț Staicu
Version: 1.0.0
Author URI: https://ionutstaicu.com
*/

if (!defined('ABSPATH')) {
    exit;
}

define('ACF_UN_VERSION', '1.0.0');

define('ACF_UN_BASEFILE', __FILE__);
define('ACF_UN_URL', plugin_dir_url(__FILE__));
define('ACF_UN_PATH', plugin_dir_path(__FILE__));
define('ACF_UN_RELATIVE_PATH', dirname(plugin_basename(__FILE__)));


add_action('acf/include_field_types', function () {
    require_once __DIR__ . '/src/AcfUniqueID.php';
    new AcfUniqueID();
}, 10, 1);