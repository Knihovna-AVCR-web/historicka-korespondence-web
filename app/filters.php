<?php

namespace App;

use WP_Error;

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical', 10, 0);
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
add_filter('emoji_svg_url', '__return_false');

add_filter('script_loader_tag', function ($url) {
    if (is_admin() || strpos($url, '.js') === false) {
        return $url;
    }

    return str_replace(' src', ' defer src', $url);
}, 10);

add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');
    remove_meta_box('dashboard_primary', 'dashboard', 'core');
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');
});

add_action('wp_before_admin_bar_render', function () {
    $GLOBALS['wp_admin_bar']->remove_menu('comments');
});

function remove_wp_version_strings($src)
{
    parse_str(parse_url($src, PHP_URL_QUERY), $query);

    if (!empty($query['ver']) && $query['ver'] === $GLOBALS['wp_version']) {
        $src = remove_query_arg('ver', $src);
    }

    return $src;
}
add_filter('script_loader_src', __NAMESPACE__ . '\\remove_wp_version_strings');
add_filter('style_loader_src', __NAMESPACE__ . '\\remove_wp_version_strings');
add_filter('the_title', __NAMESPACE__ . '\\nonbreakingSpaces');
add_filter('the_content', __NAMESPACE__ . '\\nonbreakingSpaces');
add_filter('the_excerpt', __NAMESPACE__ . '\\nonbreakingSpaces');

add_filter('rest_authentication_errors', function ($result) {
    if ($result === true || is_wp_error($result)) {
        return $result;
    }

    if (is_user_logged_in()) {
        return $result;
    }

    return new WP_Error(
        'rest_not_logged_in',
        'You are not currently logged in.',
        [
            'status' => 401,
        ]
    );
});
