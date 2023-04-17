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

        $this->defaults = [];
        $this->settings = [];

        parent::__construct();

        add_filter('acf/field_wrapper_attributes', [$this, '_alterFieldWrapper'], 10, 2);
    }

    public function _alterFieldWrapper($wrapper, $field)
    {
        if ($field['type'] !== $this->name) {
            return $wrapper;
        }

        if (!empty($field['value'])) {
            $wrapper['id'] = 'f-' . $field['value'];
        }

        return $wrapper;
    }

    function render_field($field)
    {
        $value = $field['value'] ?? '';
        $value = $value ?: substr(hash('sha256', (microtime() . uniqid('', true))), 0, 12);

        ?>
        <style> .acf-field[data-type="ntz_unique_id"] {display: none !important;}</style>
        <?php

        printf('<input type="hidden" name="%s" value="%s"><span id="f-%s"></span>',
            esc_attr($field['name']),
            esc_attr($value),
            esc_attr($value)
        );
    }
}