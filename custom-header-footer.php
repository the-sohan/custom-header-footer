<?php
/*
 * Plugin Name: SR Header Footer Builder
 * Description: A Simple Elementor-based custom header and footer builder.
 * Version: 1.0
 * Author: Sohan Chowdhury
 * Text Domain: custom-header-footer
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Include required files
require_once __DIR__ . '/includes/PostTypes.php';
require_once __DIR__ . '/includes/ElementorSupport.php';
require_once __DIR__ . '/includes/Assets.php';
require_once __DIR__ . '/includes/Frontend.php';
require_once __DIR__ . '/includes/Admin/Menu.php';
require_once __DIR__ . '/includes/Admin/Columns.php';
require_once __DIR__ . '/includes/Admin/Ajax.php';

// Initialize the plugin components
function chfb_initialize_plugin() {
    new \CustomHeaderFooterBuilder\PostTypes();
    new \CustomHeaderFooterBuilder\ElementorSupport();
    new \CustomHeaderFooterBuilder\Assets();
    new \CustomHeaderFooterBuilder\Frontend();
    new \CustomHeaderFooterBuilder\Admin\Menu();
    new \CustomHeaderFooterBuilder\Admin\Columns();
    new \CustomHeaderFooterBuilder\Admin\Ajax();
}

add_action('plugins_loaded', 'chfb_initialize_plugin');



