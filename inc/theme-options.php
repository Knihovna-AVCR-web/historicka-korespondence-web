<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function () {
    Container::make('theme_options', 'Nastavení webu')
        ->add_fields([
            Field::make('select', ICL_LANGUAGE_CODE . '_mb_front', 'Úvodní stránka MB')
                ->add_options('get_all_posts'),
            Field::make('select', ICL_LANGUAGE_CODE . '_mb_db', 'Databáze MB')
                ->add_options('get_all_posts'),
            Field::make('select', ICL_LANGUAGE_CODE . '_tgm_db', 'Databáze TGM')
                ->add_options('get_all_posts'),
            Field::make('select', ICL_LANGUAGE_CODE . '_sachs_db', 'Databáze Sachs')
                ->add_options('get_all_posts'),
            Field::make('select', ICL_LANGUAGE_CODE . '_pol_db', 'Databáze Polanus')
                ->add_options('get_all_posts'),
            Field::make('text', 'contact_email', 'Kontaktní e-mail')
                ->set_attribute('pattern', '[a-zA-Z0-9.!#$%&amp;’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+')
        ]);
});
