<?php

class NavbarWalker extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $new_classes = '';

        if (in_array('current-menu-item', $item->classes) || in_array('current-page-ancestor', $item->classes)) {
            $new_classes .= ' active';
        }

        ob_start();
        ?>
        <a class="nav-link" href="<?= $item->url; ?>">
            <?= $item->title; ?>
        </a>
        <?php
        $output .=  '<li class="nav-item py-1 py-lg-0 ' . $new_classes . '">' . ob_get_clean();
    }

    public function end_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $output .= '</li>';
    }
}
