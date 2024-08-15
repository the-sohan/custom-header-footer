<?php
namespace CustomHeaderFooterBuilder;

class Assets {

    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_elementor_frontend_styles']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
    }

    public function enqueue_elementor_frontend_styles() {
        if (class_exists('Elementor\Plugin')) {
            $elementor_instance = \Elementor\Plugin::instance();
            $elementor_instance->frontend->enqueue_styles();
            $elementor_instance->frontend->enqueue_scripts();
        }

        wp_enqueue_style('sehf_style', plugin_dir_url(__FILE__) . "../assets/css/style.css");
    }

    public function enqueue_admin_scripts($hook_suffix) {
        if ($hook_suffix === 'edit.php') {
            wp_enqueue_script('sehf-admin-script', plugin_dir_url(__FILE__) . '../assets/js/sehf-admin.js', ['jquery'], null, true);
            wp_enqueue_style('sehf-admin-style', plugin_dir_url(__FILE__) . '../assets/css/sehf-admin.css');

            wp_localize_script('sehf-admin-script', 'sehfAjax', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce('sehf_nonce')
            ]);
        }
    }
}