<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;
use Carbon_Fields\Container;

add_action('carbon_fields_register_fields', function () {
    Block::make('Úvodní box')
        ->add_fields([
            Field::make('text', 'title', 'Titulek'),
            Field::make('rich_text', 'content', 'Obsah'),
            Field::make('select', 'link', 'Odkazovaná stránka')->add_options('get_all_posts')
        ])
        ->set_render_callback(
            function ($block) {
                echo output_intro_box(
                    get_permalink($block['link']),
                    get_esc_setted_value($block['title']),
                    apply_filters('the_content', $block['content'])
                );
            }
        );
});

add_action('carbon_fields_register_fields', function () {
    Block::make('Úvod')
        ->add_fields([
            Field::make('textarea', 'content', 'Úvod'),
            Field::make('select', 'link', 'Úvodní odkaz')->add_options('get_all_posts')
        ])
        ->set_render_callback(
            function ($block) { ?>
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
});

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', 'Nastavení DB')
        ->where('post_template', '=', 'page-templates/page-browse-db.php')
        ->add_fields([
            Field::make('text', 'index_endpoint', 'Index endpoint'),
            Field::make('text', 'single_endpoint', 'Single endpoint'),
        ]);
});


if (file_exists(dirname(__FILE__) . '/cmb2/init.php')) {
    require_once dirname(__FILE__) . '/cmb2/init.php';
}


add_action('cmb2_admin_init', function () {
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
});
