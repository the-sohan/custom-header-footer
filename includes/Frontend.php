<?php
namespace CustomHeaderFooterBuilder;

class Frontend {

    public function __construct() {
        add_action('wp_loaded', [$this, 'add_custom_header']);
        add_action('wp_loaded', [$this, 'add_custom_footer']);
    }

    public function add_custom_header() {
        add_action('wp_head', [$this, 'get_custom_header']);
    }

    public function add_custom_footer() {
        add_action('wp_footer', [$this, 'get_custom_footer']);
    }

    public function get_custom_header() {
        $header_id = $this->get_enabled_template('sehf_header');
        if ($header_id) {
            $this->render_elementor_content($header_id);
        }
    }

    public function get_custom_footer() {
        $footer_id = $this->get_enabled_template('sehf_footer');
        if ($footer_id) {
            $this->render_elementor_content($footer_id);
        }
    }

    public function render_elementor_content($post_id) {
        if (class_exists('Elementor\Plugin')) {
            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($post_id);
        } else {
            echo apply_filters('the_content', get_post_field('post_content', $post_id));
        }
    }

    public function get_enabled_template($post_type) {
        $template_posts = get_posts([
            'post_type' => $post_type,
            'meta_key' => 'sehf_enabled',
            'meta_value' => '1',
            'posts_per_page' => 1
        ]);

        if ($template_posts) {
            return $template_posts[0]->ID;
        }

        return null;
    }
}
