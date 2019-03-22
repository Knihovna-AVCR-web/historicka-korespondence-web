<?php

function crb_load()
{
    require_once(get_template_directory() . '/vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}
add_action('after_setup_theme', 'crb_load');


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


function hiko_remove_wp_version_strings($src)
{

    global $wp_version;

    parse_str(parse_url($src, PHP_URL_QUERY), $query);

    if (!empty($query['ver']) && $query['ver'] === $wp_version) {
        $src = remove_query_arg('ver', $src);
    }

    return $src;
}
add_filter('script_loader_src', 'hiko_remove_wp_version_strings');
add_filter('style_loader_src', 'hiko_remove_wp_version_strings');


function hiko_remove_version()
{
    return '';
}
add_filter('the_generator', 'hiko_remove_version');

function clean_style_tag($input)
{
    $re = "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!";
    preg_match_all(
        $re,
        $input,
        $matches
    );
    if (empty($matches[2])) {
        return $input;
    }

    $media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
    return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}
add_filter('style_loader_tag', 'clean_style_tag');


function clean_script_tag($input)
{
    $input = str_replace("type='text/javascript' ", '', $input);
    return str_replace("'", '"', $input);
}
//add_filter('script_loader_tag', 'clean_script_tag');


function add_security_headers()
{
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');

    header('X-Frame-Options: DENY');

    header('X-XSS-Protection: 1; mode=block');

    header('X-Content-Type-Options: nosniff');
}
add_action('send_headers', 'add_security_headers', 1);


function hiko_load_scripts()
{
    $custom_js = get_template_directory_uri() . '/assets/dist/custom.min.js';
    $custom_js .= '?v=' . filemtime(get_template_directory() . '/assets/dist/custom.min.js');

    $custom_css = get_template_directory_uri() . '/assets/dist/main.min.css';
    $custom_css .= '?v=' . filemtime(get_template_directory() . '/assets/dist/main.min.css');
    wp_deregister_script('jquery');
    wp_deregister_script('jquery-migrate');
    wp_deregister_script('wp-embed');
    wp_register_script(
        'jquery',
        'https://code.jquery.com/jquery-3.3.1.min.js',
        false,
        null,
        true
    );

    if (is_user_logged_in()) {
        wp_enqueue_script('jquery');
    }

    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap.native@2.0.25/dist/bootstrap-native-v4.min.js',
        [],
        null,
        true
    );
    wp_enqueue_script(
        'lazyload',
        'https://cdn.jsdelivr.net/npm/vanilla-lazyload@10.19.0/dist/lazyload.min.js',
        [],
        null,
        true
    );

    if (!is_front_page()) {
        if (is_user_logged_in()) {
            wp_enqueue_script(
                'vue',
                'https://cdn.jsdelivr.net/npm/vue/dist/vue.js',
                [],
                null,
                true
            );
        } else {
            wp_enqueue_script(
                'vue',
                'https://cdn.jsdelivr.net/npm/vue',
                [],
                null,
                true
            );
        }

        wp_enqueue_script(
            'bbox',
            'https://cdn.jsdelivr.net/npm/baguettebox.js@1.11.0/dist/baguetteBox.min.js',
            [],
            null,
            true
        );
        wp_enqueue_script(
            'axios',
            'https://cdn.jsdelivr.net/npm/axios@0.18.0/dist/axios.min.js',
            [],
            null,
            true
        );
        wp_enqueue_script(
            'vue-router',
            'https://cdn.jsdelivr.net/npm/vue-router@3.0.2/dist/vue-router.min.js',
            [],
            null,
            true
        );
        wp_enqueue_script(
            'lodash',
            'https://cdn.jsdelivr.net/npm/lodash@4.17.11/lodash.min.js',
            [],
            null,
            true
        );

        wp_enqueue_script(
            'main',
            $custom_js,
            ['lazyload', 'axios', 'vue', 'bbox', 'lodash'],
            null,
            true
        );
    } else {
        wp_enqueue_script(
            'main',
            $custom_js,
            ['lazyload',],
            null,
            true
        );
    }

    wp_localize_script('main', 'globals', [
        'url' => home_url('/data/data-1.json'),
        'loading' => __('Načítám', 'hiko'),
        'error' => __('Při načítání dat se vyskytla chyba. Zkuste to ještě jednou', 'hiko'),
        'notLoaded' => ('Požadovaný dopis se nepodařilo načíst'),
        'home' => str_replace(home_url(), '', get_permalink(carbon_get_theme_option('mb_db')))
    ]);

    wp_dequeue_style('wp-block-library');

    if (!is_front_page()) {
        wp_enqueue_style(
            'bbox',
            'https://cdn.jsdelivr.net/npm/baguettebox.js@1.11.0/dist/baguetteBox.min.css'
        );
    }

    wp_enqueue_style(
        'main',
        $custom_css
    );
}
add_action('wp_enqueue_scripts', 'hiko_load_scripts');


function conditional_body_class($classes)
{
    if (is_page_template('page-templates/page-blekastad-front.php')) {
        $classes[] = 'blekastad-front';
    } elseif (is_page_template('page-templates/page-home.php')) {
        $classes[] = 'main-front';
    }

    return $classes;
}
add_filter('body_class', 'conditional_body_class');


function register_all_menus()
{
    register_nav_menu('main-menu', 'Main Menu');
    register_nav_menu('blekastad-menu', 'Blekastad Menu');
}
add_action('init', 'register_all_menus');


function language_switcher()
{
    if (!function_exists('pll_the_languages')) {
        return false;
    }

    $output = [];

    $languages = pll_the_languages([
        'raw' => 1,
        'hide_current' => 0
    ]);

    foreach ($languages as $lang) {
        ob_start();

        $is_disabled = $lang['current_lang'] || $lang['no_translation'];
        ?>

        <span>
            <a
            href="<?= ($is_disabled) ? '#' : $lang['url']; ?>"
            class="text-uppercase <?= ($is_disabled) ? 'disabled text-muted' : 'text-body'; ?>"
            aria-disabled="<?= ($is_disabled) ? 'true' : 'false'; ?>"
            >
                <?= $lang['slug'] ?>
            </a>
        </span>
        <?php
        $output[] = ob_get_clean();
    }

    return implode('/', $output);
}


function get_all_posts()
{
    $results = [];
    $the_query = new WP_Query([
        'order' => 'ASC',
        'orderby' => 'title',
        'post_type' => ['post', 'page'],
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ]);

    while ($the_query->have_posts()) {
        $the_query->the_post();
        $results[get_the_ID()] = get_the_title();
    }

    wp_reset_postdata();

    return $results;
}

function get_esc_setted_value($value)
{
    if (isset($value)) {
        return esc_html($value);
    }

    return '';
}


function get_site_title()
{
    if (is_home()) {
        echo bloginfo('name');
    } else {
        echo wp_title(' | ', false, 'right');
        echo bloginfo('name');
    }
}


function cmb2_output_gallery($file_list_meta_key)
{
    $files = get_post_meta(get_the_ID(), $file_list_meta_key, 1);
    if ($files == '' || !$files) {
        return;
    }
    ?>
    <div class="gallery">

        <?php foreach ((array) $files as $file_id => $file_url) : ?>
            <a
                href="<?= $file_url; ?>"
                data-caption="<?= wp_get_attachment_caption($file_id); ?>"
            >
                <img
                    src="<?= wp_get_attachment_image_src($file_id, 'medium')[0]; ?>"
                    alt="<?= wp_get_attachment_caption($file_id); ?>"
                    class="img-fluid img-thumbnail mr-3 mb-3"
                >
            </a>

        <?php endforeach; ?>
    </div>
    <?php
}

function is_localhost($whitelist = ['127.0.0.1', '::1'])
{
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}


function output_block_by_name($blocks, $block_name)
{
    foreach ($blocks as $block) {
        if ($block['blockName'] == $block_name) {
            echo render_block($block);
        }
    }
}


function encode_string_to_ASCII($string)
{
    $output = '';

    for ($i = 0; $i < strlen($string); $i++) {
        $output .= '&#'.ord($string[$i]).';';
    }

    return $output;
}


function get_encoded_mailto_link($classes)
{
    $email = carbon_get_theme_option('contact_email');

    if (!$email) {
        return '';
    }

    $email = encode_string_to_ASCII($email);
    $mailto = encode_string_to_ASCII('mailto:');

    ob_start();
    ?>

    <a href="<?= $mailto . $email; ?>" class="<?= $classes; ?>">
        <?= $email; ?>
    </a>

    <?php
    return ob_get_clean();
}


require 'inc/custom-fields.php';
require 'inc/theme-options.php';
require 'inc/navbar-walker.php';
require 'inc/breadcrumbs.php';
