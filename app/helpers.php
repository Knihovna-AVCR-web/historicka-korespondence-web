<?php

namespace App;

use WP_Query;

function assets()
{
    $assets = json_decode(
        file_get_contents(get_template_directory() . '/public/mix-manifest.json'),
        true
    );

    return collect($assets)
        ->map(function ($asset) {
            return get_template_directory_uri() . '/public' . $asset;
        })
        ->toArray();
}

function imageUrl($fileName)
{
    return get_template_directory_uri() . '/public/images/' . $fileName;
}

function nonbreakingSpaces($content)
{
    $content = str_replace(
        [
            ' k ', ' K ',
            ' o ', ' O ',
            ' s ', ' S ',
            ' u ', ' U ',
            ' v ', ' V ',
            ' z ', ' Z ',
            ' 7 ',
        ],
        [
            ' k&nbsp;', ' K&nbsp;',
            ' o&nbsp;', ' O&nbsp;',
            ' s&nbsp;', ' S&nbsp;',
            ' u&nbsp;', ' U&nbsp;',
            ' v&nbsp;', ' V&nbsp;',
            ' z&nbsp;', ' Z&nbsp;',
            ' 7&nbsp;',
        ],
        $content
    );

    return $content;
}

function getAllPosts()
{
    $query = new WP_Query([
        'order' => 'ASC',
        'orderby' => 'title',
        'post_type' => ['post', 'page'],
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ]);

    $results = [];

    collect($query->posts)
        ->each(function ($item) use (&$results) {
            $parent = wp_get_post_parent_id($item->ID);
            $parentTitle = $parent ? get_the_title($parent) . ': ' : '';
            $results[$item->ID] = $parentTitle . $item->post_title;
        });

    return $results;
}

function getContent($url)
{
    $whitelist = [
        '127.0.0.1',
        '::1',
    ];

    if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
        return @file_get_contents($url);
    }

    return @file_get_contents(
        $url,
        false,
        stream_context_create([
            'http' => ['method' => 'GET'], 'ssl' => ['verify_peer' => false, 'allow_self_signed' => true]
        ])
    );
}
