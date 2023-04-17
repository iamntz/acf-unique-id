<?php
/*
Plugin Name: ACF Unique ID Field
Author: Ionuț Staicu
Version: 1.0.0
Author URI: https://ionutstaicu.com
*/

use iamntz\acf\unique_id\AcfUniqueID;

!defined('ABSPATH') && die();

if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/include_field_types', function () {
    require_once __DIR__ . '/src/AcfUniqueID.php';

    new AcfUniqueID();
}, 10, 1);