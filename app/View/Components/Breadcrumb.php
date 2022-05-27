<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class Breadcrumb extends Component
{
    public $links = [];

    public function __construct()
    {
        $this->links();
    }

    public function render()
    {
        return $this->view('components.breadcrumb');
    }

    protected function links()
    {
        $currentPost = $GLOBALS['post'];

        $this->links[] = [
            'name' => __('Úvod', 'hiko'),
            'url' => home_url(),
        ];

        if (is_page() && $currentPost->post_parent) {
            $this->links[] = [
                'name' => get_the_title($currentPost->post_parent),
                'url' => get_permalink($currentPost->post_parent),
            ];
        }

        if (is_single() && has_category()) {
            $this->links[] = [
                'name' => get_the_category()[0]->name,
                'url' => get_category_link(get_the_category()[0]->term_id),
            ];
        }

        $this->links[] = [
            'name' => is_category() ? get_the_category()[0]->name : get_the_title(),
        ];
    }
}
