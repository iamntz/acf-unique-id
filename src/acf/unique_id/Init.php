<?php

namespace iamntz\acf\unique_id;

!defined('ABSPATH') && die();

class Init
{
    public function __construct() {
        add_action('acf/include_field_types',  [$this, 'register_field']);
    }

    public function register_field()
    {
        new AcfUniqueID();
    }
}