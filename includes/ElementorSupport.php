<?php
namespace CustomHeaderFooterBuilder;

class ElementorSupport {

    public function __construct() {
        add_action('init', [$this, 'add_elementor_support']);
    }

    public function add_elementor_support() {
        add_post_type_support('sehf_header', 'elementor');
        add_post_type_support('sehf_footer', 'elementor');
    }
}
