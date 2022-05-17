<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;

class FrontPage extends Composer
{
    protected $blocks = '';

    public function __construct()
    {
        $this->blocks = (array) parse_blocks(get_the_content());
    }

    public function with()
    {
        return [
            'intro' => $this->getBlock('carbon-fields/uvod'),
            'boxes' => $this->getBlock('carbon-fields/uvodni-box'),
            'news' => $this->getNews(),
            'projects' => $this->getProjects(),
        ];
    }

    protected function getBlock($blockName)
    {
        $results = '';
        foreach ($this->blocks as $block) {
            if ($block['blockName'] === $blockName) {
                $results .= render_block($block);
            }
        }

        return $results;
    }

    protected function getNews()
    {
        $query = new WP_Query([
            'posts_per_page' => 3,
            'post_type' => 'post',
            'category_name' => 'Aktuálně',
        ]);

        return collect($query->posts)
            ->map(function ($item) {
                return [
                    'link' => get_permalink($item->ID),
                    'title' => $item->post_title,
                    'date' => date('j. n. Y', strtotime($item->post_date))
                ];
            })
            ->toArray();
    }

    protected function getProjects()
    {
        $query = new WP_Query([
            'posts_per_page' => -1,
            'post_type' => ['page'],
            'post_parent__in' => [
                get_page_by_path('projekty')->ID,
                get_page_by_path('projects')->ID,
            ],
            'order' => 'title',
        ]);

        return collect($query->posts)
            ->map(function ($item) {
                return [
                    'excerpt' => get_the_excerpt($item->ID),
                    'link' => get_permalink($item->ID),
                    'title' => $item->post_title,
                ];
            })
            ->toArray();
    }
}
