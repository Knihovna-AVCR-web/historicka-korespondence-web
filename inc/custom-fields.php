<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;
use Carbon_Fields\Container;

function hk_intro_box()
{
    Block::make('Úvodní box')
    ->add_fields([
        Field::make('text', 'title', 'Titulek'),
        Field::make('rich_text', 'content', 'Obsah'),
        Field::make('select', 'link', 'Odkazovaná stránka')->add_options('get_all_posts')
    ])
    ->set_render_callback(
        function ($block) {
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="featured-box">
                    <h3 class="title">
                        <a href="<?= get_permalink($block['link']); ?>">
                            <?= get_esc_setted_value($block['title']); ?>
                        </a>
                    </h3>

                    <?= apply_filters('the_content', $block['content']); ?>
                </div>
            </div>
            <?php
        }
    );
}
add_action('carbon_fields_register_fields', 'hk_intro_box');


function hk_home_page_intro()
{
    Block::make('Úvod')
    ->add_fields([
        Field::make('textarea', 'content', 'Úvod'),
        Field::make('select', 'link', 'Úvodní odkaz')->add_options('get_all_posts')
    ])
    ->set_render_callback(
        function ($block) {
            ?>
            <div class="container">

                    <div class="row">
                        <div class="col-12 jumbotron text-center mb-0">
                            <p class="lead">
                                <?= $block['content']; ?>
                            </p>
                            <a href="<?= get_permalink($block['link']); ?>" class="btn btn-outline-white btn-sm text-uppercase btn-state-primary px-4 mt-4" style="font-size:16px">
                                <?php _e('Více', 'hiko'); ?>&nbsp;&nbsp;&raquo;
                            </a>
                        </div>
                    </div>

            </div>
            <?php
        }
    );
}
add_action('carbon_fields_register_fields', 'hk_home_page_intro');


if (file_exists(dirname(__FILE__) . '/cmb2/init.php')) {
    require_once dirname(__FILE__) . '/cmb2/init.php';
}


function cmb2_blekastad_front_metaboxes()
{
    $prefix = 'bf_';

    $cmb = new_cmb2_box([
        'id' => $prefix . 'metabox',
        'title' => 'Obsah hlavní stránky MB',
        'object_types' => ['page'],
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,
        'show_on' => [
            'key' => 'page-template',
            'value' => 'page-templates/page-blekastad-front.php'
        ],
    ]);

    $box_group = $cmb->add_field([
        'id' => $prefix . 'box_group',
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
}
add_action('cmb2_admin_init', 'cmb2_blekastad_front_metaboxes');


function cmb2_general_metaboxes()
{
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
        'id' => 'bl_submenu',
        'type' => 'checkbox',
    ]);

    $cmb->add_field([
        'name' => 'Galerie',
        'id' => 'hk_gallery',
        'type' => 'file_list',
        'query_args' => ['type' => 'image'],
    ]);
}
add_action('cmb2_admin_init', 'cmb2_general_metaboxes');
