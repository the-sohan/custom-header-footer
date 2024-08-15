<?php
namespace CustomHeaderFooterBuilder\Admin;

class Menu {

    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
    }

    public function add_admin_menu() {
        add_menu_page(
            __('Header & Footer', 'custom-header-footer'), // Page title
            __('SR Header & Footer Builder', 'custom-header-footer'), // Menu title
            'manage_options',                              // Capability
            'sehf_menu',                                   // Menu slug
            '',                                            // Function (empty because this is just a container for submenus)
            'dashicons-admin-generic',                     // Icon URL
            20                                             // Position
        );
    }
}
