<?php

if (file_exists(dirname(__FILE__) . '/cmb2/init.php')) {
    require_once dirname(__FILE__) . '/cmb2/init.php';
}


function cmb2_homepage_metaboxes()
{
    $prefix = 'hp_';

    $cmb = new_cmb2_box([
        'id' => 'hp_metabox',
        'title' => 'Obsah úvodní stránky',
        'object_types' => ['page'],
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,
        'show_on' => [
            'key' => 'page-template',
            'value' => 'page-home.php'
        ],
    ]);

    $cmb->add_field([
        'name' => 'Úvod',
        'id' => $prefix . 'intro',
        'type' => 'textarea',
    ]);

    $cmb->add_field([
        'name' => 'Úvodní odkaz',
        'id' => $prefix . 'link',
        'type' => 'select',
        'show_option_none' => true,
        'options' => get_all_posts(),
    ]);

    $box_group = $cmb->add_field([
        'id' => 'box_group',
        'type' => 'group',
        'name' => 'Boxy',
        'options' => [
            'group_title' => 'Box č. {#}',
            'add_button' => 'Přidat další',
            'remove_button' => 'Odebrat'
        ],
    ]);

    $cmb->add_group_field(
        $box_group,
        [
            'name' => 'Hlavní titulek',
            'id' => 'title',
            'type' => 'text',
            'attributes' => [
                'required' => 'required',
            ],
        ]
    );

    $cmb->add_group_field(
        $box_group,
        [
            'name' => 'Popisek',
            'id' => 'descr',
            'type' => 'textarea_small',
        ]
    );

    $cmb->add_group_field(
        $box_group,
        [
            'name' => 'Odkazovaná stránka',
            'id' => 'url',
            'type' => 'select',
            'show_option_none' => true,
            'options' => get_all_posts(),
        ]
    );

    $cmb->add_group_field(
        $box_group,
        [
            'name' => 'HTML popisek',
            'id' => 'desc-html',
            'type' => 'wysiwyg',
            'options' => [
                'wpautop' => false,
                'media_buttons' => false,
            ]
        ]
    );
}
add_action('cmb2_admin_init', 'cmb2_homepage_metaboxes');


function cmb2_general_metaboxes()
{
    $prefix = 'bl_';

    $cmb = new_cmb2_box([
        'id' => 'hk_metabox',
        'title' => 'Nastavení obsahu',
        'object_types' => ['page', 'post'],
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,
    ]);

    $cmb->add_field([
        'name' => 'Blekastad podmenu',
        'id' => $prefix . 'submenu',
        'type' => 'checkbox',
    ]);
}
add_action('cmb2_admin_init', 'cmb2_general_metaboxes');
