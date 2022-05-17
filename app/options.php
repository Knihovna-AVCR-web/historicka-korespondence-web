<?php

namespace App;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function () {
    Container::make('theme_options', 'Nastavení webu')
        ->add_fields([
            Field::make('select', ICL_LANGUAGE_CODE . '_mb_db', 'Databáze MB')
                ->add_options(function () {
                    return getAllPosts();
                }),
            Field::make('select', ICL_LANGUAGE_CODE . '_tgm_db', 'Databáze TGM')
                ->add_options(function () {
                    return getAllPosts();
                }),
            Field::make('select', ICL_LANGUAGE_CODE . '_sachs_db', 'Databáze Sachs')
                ->add_options(function () {
                    return getAllPosts();
                }),
            Field::make('select', ICL_LANGUAGE_CODE . '_pol_db', 'Databáze Polanus')
                ->add_options(function () {
                    return getAllPosts();
                }),
        ]);
});
