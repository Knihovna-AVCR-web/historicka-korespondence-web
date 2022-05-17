<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class PageBlekastad extends Composer
{
    public function with()
    {
        return [
            'dbUrl' => $this->dbUrl(),
        ];
    }

    protected function dbUrl()
    {
        $pageId = carbon_get_theme_option(ICL_LANGUAGE_CODE . '_mb_db');

        return $pageId
            ? get_permalink($pageId)
            : '';
    }
}
