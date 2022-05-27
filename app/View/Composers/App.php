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
            'navigation' => (new Navi())->build('main-menu'),
            'siteName' => get_bloginfo('name', 'display'),
            'languages' => $this->getLanguages(),
            'blekastadNavigation' => $this->blekastadNavigation(),
        ];
    }

    protected function getLanguages()
    {
        if (!function_exists('pll_the_languages')) {
            return [];
        }

        return collect(pll_the_languages(['raw' => 1, 'hide_current' => 0]))
            ->map(function ($language) {
                return [
                    'name' => $language['slug'],
                    'url' => $language['url'],
                    'disabled' => $language['current_lang'] || $language['no_translation'],
                ];
            })
            ->values()
            ->toArray();
    }

    protected function blekastadNavigation()
    {
        if (!is_page()) {
            return [];
        }

        if ($GLOBALS['post']->post_parent) {
            if (get_page_template_slug($GLOBALS['post']->post_parent) === 'page-blekastad.blade.php') {
                return (new Navi())->build('blekastad-menu');
            }
        }

        if (is_page_template('page-blekastad.blade.php')) {
            return (new Navi())->build('blekastad-menu');
        }

        return [];
    }
}
