<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function hk_theme_options()
{
    Container::make('theme_options', 'Nastavení stránky')
    ->add_fields([
        Field::make('select', 'mb_front', 'Úvodní stránka MB')
        ->add_options('get_all_posts'),
        Field::make('select', 'mb_db', 'Databáze MB')
        ->add_options('get_all_posts')
    ]);
}
add_action('carbon_fields_register_fields', 'hk_theme_options');
