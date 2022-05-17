<?php

namespace App;

use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function () {
    Block::make('Úvodní box')
        ->add_fields([
            Field::make('text', 'title', 'Titulek'),
            Field::make('rich_text', 'content', 'Obsah'),
            Field::make('select', 'link', 'Odkazovaná stránka')
                ->add_options(function () {
                    return getAllPosts();
                }),
        ])
        ->set_render_callback(
            function ($args) {
                $args['link'] = get_permalink($args['link']);
                echo view('partials.intro-box', $args)->render();
            }
        );
});

add_action('carbon_fields_register_fields', function () {
    Block::make('Úvod')
        ->add_fields([
            Field::make('textarea', 'content', 'Úvod'),
            Field::make('select', 'link', 'Úvodní odkaz')
                ->add_options(function () {
                    return getAllPosts();
                }),
        ])
        ->set_render_callback(
            function ($args) {
                echo view('partials.intro', $args)->render();
            }
        );
});
