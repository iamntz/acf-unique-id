<?php
/*
Plugin Name: ACF Unique ID Field
Author: Ionuț Staicu
Version: 1.0.0
Author URI: https://ionutstaicu.com
*/

use iamntz\acf\unique_id\Init;

!defined('ABSPATH') && die();

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/src/acf/unique_id/AcfUniqueID.php';
require_once __DIR__ . '/src/acf/unique_id/Init.php';

new Init();