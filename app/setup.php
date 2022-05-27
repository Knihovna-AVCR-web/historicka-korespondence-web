<?php

namespace App;

use Carbon_Fields\Carbon_Fields;

add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('global-styles');

    if (is_page_template('page-letters.blade.php')) {
        wp_enqueue_script('filter', \App\assets()['/filter.js'], [], null, false);
        wp_enqueue_style('filter', \App\assets()['/filter.css'], false, null);
    }

    wp_enqueue_script('app', \App\assets()['/app.js'], [], null, false);
    wp_enqueue_style('app', \App\assets()['/app.css'], false, null);
}, 100);


add_action('wp_footer', function () {
    wp_dequeue_script('wp-embed');
});


add_action('after_setup_theme', function () {
    Carbon_Fields::boot();

    register_nav_menus([
        'main-menu' => 'Hlavní menu',
        'blekastad-menu' => 'Blekastad Menu',
    ]);

    add_theme_support('title-tag');

    add_theme_support('html5', [
        'caption',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    remove_theme_support('block-templates');
}, 20);
