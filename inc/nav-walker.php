<?php

function get_main_menu()
{
    if (!has_nav_menu('main-menu')) {
        return [];
    }

    $result = [];

    foreach (wp_get_nav_menu_items(get_nav_menu_locations()['main-menu']) as $item) {
        if ($item->menu_item_parent === '0') {
            $result[] = [
                'children' => [],
                'id' => $item->ID,
                'target' => !empty($item->target) ? 'target="' . esc_attr($item->target) . '"' : '',
                'title' => $item->title,
                'url' => esc_attr($item->url),
                'type' => $item->type,
            ];
        } else {
            $parent = array_search((int) $item->menu_item_parent, array_column($result, 'id'));
            $result[$parent]['children'][] = [
                'target' => !empty($item->target) ? 'target="' . esc_attr($item->target) . '"' : '',
                'title' => $item->title,
                'url' => esc_attr($item->url),
                'type' => $item->type,
            ];
        }
    }

    return $result;
}
