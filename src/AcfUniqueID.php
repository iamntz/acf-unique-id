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
            'unique_id_length' => 4,
            'unique_id_debug' => 1,
            'unique_id_groups_count' => 4,
            'unique_id_separator' => '-',
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
            'max' => 256,
        ]);

        acf_render_field_setting($field, [
            'label' => __('How many groups?'),
            'type' => 'number',
            'name' => 'unique_id_groups_count',
        ]);

        acf_render_field_setting($field, [
            'label' => __('Unique ID separator'),
            'type' => 'text',
            'name' => 'unique_id_separator',
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

        $value = [];

        for ($i = 0; $i < $field['unique_id_length']; $i++) {
            $str = hash('sha256', ($i . maybe_serialize($field) . microtime() . uniqid('', true)));

            $value[] = substr($str, 0, $field['unique_id_length']);
        }

        return implode($field['unique_id_separator'], $value);
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