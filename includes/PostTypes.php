<?php
namespace CustomHeaderFooterBuilder;

class PostTypes {

    public function __construct() {
        add_action('init', [$this, 'register_post_types']);
    }

    public function register_post_types() {
        register_post_type('sehf_header', [
            'labels' => [
                'name' => __('Headers'),
                'singular_name' => __('Header')
            ],
            'public' => true,
            'show_in_menu' => 'sehf_menu',
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'elementor'],
            'rewrite' => ['slug' => 'header'],
            'has_archive' => false,
        ]);

        register_post_type('sehf_footer', [
            'labels' => [
                'name' => __('Footers'),
                'singular_name' => __('Footer')
            ],
            'public' => true,
            'show_in_menu' => 'sehf_menu',
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'elementor'],
            'rewrite' => ['slug' => 'footer'],
            'has_archive' => false,
        ]);
    }
}
