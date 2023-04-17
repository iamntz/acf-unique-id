<?php


namespace iamntz\acf\unique_id;

!defined('ABSPATH') && die();

final class AcfUniqueID extends \acf_field
{
    function __construct()
    {
        $this->name = 'ntz_unique_id';
        $this->label = __('Unique ID');
        $this->category = 'basic';

        $this->defaults = [
            'unique_id_length' => 12,
            'unique_id_debug' => false,
        ];

        $this->settings = [];

        parent::__construct();
    }

    public function render_field_settings($field)
    {
        acf_render_field_setting($field, [
            'label' => __('Unique ID length'),
            'type' => 'number',
            'name' => 'unique_id_length',
        ]);

        acf_render_field_setting($field, [
            'label' => __('Enable Debug'),
            'instructions' => 'Enabling this will show the field value as a text input instead of a hidden input.',
            'name' => 'unique_id_debug',
            'type' => 'true_false',
            'ui' => 1,
        ]);
    }

    public function update_value($value, $post_id, $field)
    {
        if (!empty($value)) {
            return $value;
        }

        return substr(hash('sha256', (maybe_serialize($field) . microtime() . uniqid('', true))), 0, $field['unique_id_length']);
    }

    function render_field($field)
    {
        if (!$field['unique_id_debug']) {
            echo '<style> .acf-field[data-type="ntz_unique_id"] {display: none !important;}</style>';
        }

        printf('<input type="%s" name="%s" value="%s"><span id="f-%s"></span>',
            $field['unique_id_debug'] ? 'text' : 'hidden',
            esc_attr($field['name']),
            esc_attr($field['value']),
            esc_attr($field['value'])
        );
    }
}