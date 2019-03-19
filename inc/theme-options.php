<?php



function hko_register_theme_options_metabox()
{
    
    $prefix = 'hko_';
    
    $cmb_options = new_cmb2_box([
        'id' => $prefix . 'option_metabox',
        'title' => 'Nastavení stránky',
        'object_types' => ['options-page'],

        'option_key'      => $prefix . 'options', // The option key and admin menu page slug.
        // 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
        // 'menu_title'      => esc_html__('Options', 'myprefix' ), // Falls back to 'title' (above).
        // 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
        // 'capability'      => 'manage_options', // Cap required to view options-page.
        // 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
        // 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
        // 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
        // 'save_button'     => esc_html__('Save Theme Options', 'myprefix' ), // The text for the options-page save button. Defaults to 'Save'.
    ]);
    

    $cmb_options->add_field([
        'name' => 'Úvodní stránka MB',
        'id'   => 'mb_front',
        'type' => 'select',
        'show_option_none' => true,
        'options' => get_all_posts(),
    ]);

    $cmb_options->add_field([
        'name' => 'Databáze MB',
        'id'   => 'mb_db',
        'type' => 'select',
        'show_option_none' => true,
        'options' => get_all_posts(),
    ]);
}
add_action('cmb2_admin_init', 'hko_register_theme_options_metabox');
