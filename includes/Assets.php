<?php
namespace CustomHeaderFooterBuilder;

class Assets {

    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_styles']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
    }

    public function enqueue_frontend_styles() {
        // Load Elementor styles and scripts if Elementor is active
        if (class_exists('Elementor\Plugin')) {
            $elementor_instance = \Elementor\Plugin::instance();
            $elementor_instance->frontend->enqueue_styles();
            $elementor_instance->frontend->enqueue_scripts();
        }

        // Load Gutenberg block library styles for the frontend
        if (function_exists('has_blocks')) {
            wp_enqueue_style('wp-block-library'); // Core block styles
            wp_enqueue_style('wp-block-library-theme'); // Theme block styles
            wp_enqueue_style('wp-blocks'); // Additional block styles
        }

        // Load plugin frontend styles
        wp_enqueue_style('sehf_style', plugin_dir_url(__FILE__) . '../assets/css/style.css');
    }

    public function enqueue_admin_scripts($hook_suffix) {
        if ($hook_suffix === 'edit.php') {
            // Load plugin admin scripts and styles
            wp_enqueue_script('sehf-admin-script', plugin_dir_url(__FILE__) . '../assets/js/sehf-admin.js', ['jquery'], null, true);
            wp_enqueue_style('sehf-admin-style', plugin_dir_url(__FILE__) . '../assets/css/sehf-admin.css');

            // Load Gutenberg block library styles for the admin area
            wp_enqueue_style('wp-block-library'); // Core block styles
            wp_enqueue_style('wp-edit-blocks'); // Gutenberg editor block styles

            // Localize script to pass AJAX URL and nonce to JavaScript
            wp_localize_script('sehf-admin-script', 'sehfAjax', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce('sehf_nonce')
            ]);
        }
    }
}
