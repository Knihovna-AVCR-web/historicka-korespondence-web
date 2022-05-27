<?php

namespace App;

use Carbon_Fields\Field;
use Carbon_Fields\Container;

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', 'Nastavení DB')
        ->where('post_template', '=', 'page-letters.blade.php')
        ->add_fields([
            Field::make('select', 'db', 'Databáze')
                ->add_options(function () {
                    return [
                        'blekastad' => 'Blekastad',
                        'tgm' => 'TGM',
                        'sachs' => 'Sachs',
                        'polanus' => 'Polanus',
                    ];
                }),
        ]);
});
