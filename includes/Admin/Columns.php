<?php
namespace CustomHeaderFooterBuilder\Admin;

class Columns {
    
    public function __construct() {
        add_filter('manage_sehf_header_posts_columns', [$this, 'add_custom_columns']);
        add_filter('manage_sehf_footer_posts_columns', [$this, 'add_custom_columns']);
        add_action('manage_sehf_header_posts_custom_column', [$this, 'custom_column_content'], 10, 2);
        add_action('manage_sehf_footer_posts_custom_column', [$this, 'custom_column_content'], 10, 2);
    }

    /**
     * Add custom columns to Headers and Footers post lists.
     *
     * @param array $columns Existing columns.
     * @return array Modified columns.
     */
    public function add_custom_columns($columns) {
        $columns['sehf_enabled'] = 'Status';
        return $columns;
    }

    /**
     * Display content in custom columns.
     *
     * @param string $column The column name.
     * @param int $post_id The post ID.
     */
    public function custom_column_content($column, $post_id) {
        if ($column === 'sehf_enabled') {
            $enabled = get_post_meta($post_id, 'sehf_enabled', true);
            $checked = $enabled ? 'checked' : '';

            echo '<label class="sehf-switch">';
            echo '<input type="checkbox" class="sehf-toggle" data-post-id="' . esc_attr($post_id) . '" ' . $checked . '>';
            echo '<span class="sehf-slider"></span>';
            echo '</label>';
        }
    }

}







