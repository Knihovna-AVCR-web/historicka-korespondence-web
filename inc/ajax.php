<?php

function index_hiko_letters($type)
{
    $url = "https://historicka-korespondence.cz/administrace/wp-admin/admin-ajax.php?action=public_list_all_letters&type={$type}";
    wp_die(file_get_contents($url));
}
add_action('wp_ajax_nopriv_index_hiko_letters', 'index_hiko_letters');
add_action('wp_ajax_index_hiko_letters', 'index_hiko_letters');


function get_single_hiko_letter($id, $type)
{
    $url = "https://historicka-korespondence.cz/administrace/wp-admin/admin-ajax.php?action=list_public_letters_single&l_type={$type}&pods_id={$id}";
    wp_die(file_get_contents($url));
}
add_action('wp_ajax_nopriv_get_single_hiko_letter', 'get_single_hiko_letter');
add_action('wp_ajax_get_single_hiko_letter', 'get_single_hiko_letter');
