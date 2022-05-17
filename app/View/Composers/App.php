<?php

namespace App\View\Composers;

use Log1x\Navi\Navi;
use Roots\Acorn\View\Composer;

class App extends Composer
{
    protected static $views = [
        '*',
    ];

    public function with()
    {
        return [
            'assets' => \App\assets(),
            'navigation' => (new Navi())->build('primary_navigation'),
            'siteName' => get_bloginfo('name', 'display'),
        ];
    }
}
