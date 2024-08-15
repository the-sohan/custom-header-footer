<?php
namespace CustomHeaderFooterBuilder\Admin;

class Ajax {

    public function __construct() {
        add_action('wp_ajax_sehf_toggle_template_status', [$this, 'toggle_template_status']);
        add_action('admin_init', [$this, 'handle_bulk_actions']);
    }

    public function toggle_template_status() {
        if (isset($_POST['post_id'])) {
            $post_id = intval($_POST['post_id']);
            $enabled = get_post_meta($post_id, 'sehf_enabled', true);

            if ($enabled) {
                delete_post_meta($post_id, 'sehf_enabled');
                $status = 'disabled';
            } else {
                $post_type = get_post_type($post_id);
                $posts = get_posts([
                    'post_type' => $post_type,
                    'meta_key' => 'sehf_enabled',
                    'meta_value' => '1',
                    'posts_per_page' => -1
                ]);

                foreach ($posts as $post) {
                    delete_post_meta($post->ID, 'sehf_enabled');
                }

                update_post_meta($post_id, 'sehf_enabled', '1');
                $status = 'enabled';
            }

            wp_send_json_success(['status' => $status]);
        } else {
            wp_send_json_error('Invalid post ID');
        }
    }

    public function handle_bulk_actions() {
        if (isset($_GET['sehf_action']) && isset($_GET['post'])) {
            $action = $_GET['sehf_action'];
            $post_id = intval($_GET['post']);

            if ($action === 'enable') {
                update_post_meta($post_id, 'sehf_enabled', '1');
            } elseif ($action === 'disable') {
                delete_post_meta($post_id, 'sehf_enabled');
            }

            wp_redirect(remove_query_arg(['sehf_action', 'post']));
            exit;
        }
    }
}
