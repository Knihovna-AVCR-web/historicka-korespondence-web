<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class Pagination extends Component
{
    public $links = [];

    public function __construct()
    {
        $this->paginate();
    }

    public function render()
    {
        return $this->view('components.pagination');
    }

    protected function paginate()
    {
        $maxPages = 999999999;

        $this->links = collect(paginate_links([
            'base' => str_replace($maxPages, '%#%', esc_url(get_pagenum_link($maxPages))),
            'current' => max(1, get_query_var('paged')),
            'format' => '?paged=%#%',
            'next_text' => 'Další &rarr;',
            'prev_next' => true,
            'prev_text' => '&larr; Předchozí',
            'total' => $GLOBALS['wp_query']->max_num_pages,
            'type' => 'array',
        ]))
            ->map(function ($link) {
                if (preg_match('/\bcurrent\b/', $link)) {
                    return "<li>{$link}</li>";
                }

                return "<li class='underline'>{$link}</li>";
            })
            ->toArray();
    }
}
