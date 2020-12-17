<?php

require_once get_template_directory() . '/inc/wp-settings.php';

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    register_nav_menu('main-menu', 'Main Menu');
    register_nav_menu('blekastad-menu', 'Blekastad Menu');

    require_once get_template_directory() . '/vendor/autoload.php';

    \Carbon_Fields\Carbon_Fields::boot();

    require_once get_template_directory() . '/inc/ajax.php';
    require_once get_template_directory() . '/inc/custom-fields.php';
    require_once get_template_directory() . '/inc/theme-options.php';
    require_once get_template_directory() . '/inc/navbar-walker.php';
    require_once get_template_directory() . '/inc/breadcrumbs.php';
});


add_action('wp_enqueue_scripts', function () {
    $dist_uri = get_template_directory_uri() . '/assets/dist/';
    $dist_dir = get_template_directory() . '/assets/dist/';

    is_user_logged_in() ? wp_enqueue_script('jquery') : wp_dequeue_script('jquery');

    wp_enqueue_script('main', $dist_uri . 'app.js', [], filemtime($dist_dir . 'app.js'), true);
    wp_enqueue_style('main', $dist_uri . 'app.css', [], filemtime($dist_dir . 'app.css'));
});


add_action('template_redirect', function () {
    global $post;

    $slug = $post->post_name;

    if ($slug != 'browse') {
        return;
    }

    $db = isset($_GET['db']) && !empty($_GET['db']) ? $_GET['db'] : false;

    if ($db == 'bl_letter') {
        $url = get_permalink(carbon_get_theme_option('mb_db'));
        exit(wp_redirect($url));
    } else {
        exit(wp_redirect(home_url('projekty')));
    }
});


function nonbreaking_spaces($content)
{
    $content = str_replace(
        [
            ' k ', ' K ',
            ' o ', ' O ',
            ' s ', ' S ',
            ' u ', ' U ',
            ' v ', ' V ',
            ' z ', ' Z ',
        ],
        [
            ' k&nbsp;', ' K&nbsp;',
            ' o&nbsp;', ' O&nbsp;',
            ' s&nbsp;', ' S&nbsp;',
            ' u&nbsp;', ' U&nbsp;',
            ' v&nbsp;', ' V&nbsp;',
            ' z&nbsp;', ' Z&nbsp;',
        ],
        $content
    );

    return $content;
}
add_filter('the_title', 'nonbreaking_spaces');
add_filter('the_content', 'nonbreaking_spaces');
add_filter('the_excerpt', 'nonbreaking_spaces');


function show_blekastad_nav()
{
    $show = false;

    global $post;

    $slug = $post->post_name;

    if (is_page_template('page-templates/page-blekastad-front.php')) {
        $show = true;
    } else if (get_post_meta(get_queried_object_id(), 'bl_submenu', true) == 'on') {
        $show = true;
    } else if ($slug == 'letter' && isset($_GET['type']) && $_GET['type'] == 'bl_letter') {
        $show = true;
    }

    if ($show) {
        require_once get_template_directory() . '/partials/blekastad-nav.php';
    }
}


function language_switcher()
{
    if (!function_exists('pll_the_languages')) {
        return false;
    }

    if (!is_user_logged_in()) {
        return false;
    }

    $languages = pll_the_languages([
        'raw' => 1,
        'hide_current' => 0
    ]);

    $output = [];

    foreach ($languages as $lang) {
        $is_disabled = $lang['current_lang'] || $lang['no_translation'];
        ob_start(); ?>
        <span>
            <a href="<?= ($is_disabled) ? '#' : $lang['url']; ?>" class="text-uppercase <?= ($is_disabled) ? 'disabled text-muted' : 'text-body'; ?>" aria-disabled="<?= ($is_disabled) ? 'true' : 'false'; ?>">
                <?= $lang['slug'] ?>
            </a>
        </span>
        <?php
        $output[] = ob_get_clean();
    }

    return implode('/', $output);
}


function get_all_posts()
{
    $results = [];
    $the_query = new WP_Query([
        'order' => 'ASC',
        'orderby' => 'title',
        'post_type' => ['post', 'page'],
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ]);

    while ($the_query->have_posts()) {
        $the_query->the_post();
        $results[get_the_ID()] = get_the_title();
    }

    wp_reset_postdata();

    return $results;
}


function get_esc_setted_value($value)
{
    if (isset($value)) {
        return esc_html($value);
    }

    return '';
}


function cmb2_output_gallery($file_list_meta_key)
{
    $files = get_post_meta(get_the_ID(), $file_list_meta_key, 1);
    if ($files == '' || !$files) {
        return;
    }
    ?>
    <div class="gallery">
        <?php foreach ((array) $files as $file_id => $file_url) : ?>
            <a href="<?= $file_url; ?>" data-caption="<?= wp_get_attachment_caption($file_id); ?>">
                <img src="<?= wp_get_attachment_image_src($file_id, 'medium')[0]; ?>" alt="<?= wp_get_attachment_caption($file_id); ?>" class="mb-3 mr-3 img-fluid img-thumbnail">
            </a>

        <?php endforeach; ?>
    </div>
    <?php
}


function is_localhost($whitelist = ['127.0.0.1', '::1'])
{
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}


function output_block_by_name($blocks, $block_name)
{
    foreach ($blocks as $block) {
        if ($block['blockName'] == $block_name) {
            echo render_block($block);
        }
    }
}

function output_intro_box($permalink, $title, $content)
{
    ob_start();
    ?>
    <div class="col-lg-4 col-md-6">
        <div class="featured-box">
            <h3 class="title">
                <a href="<?= $permalink; ?>">
                    <?= $title; ?>
                </a>
            </h3>
            <?= $content; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}


function encode_string_to_ASCII($string)
{
    $output = '';

    for ($i = 0; $i < strlen($string); $i++) {
        $output .= '&#' . ord($string[$i]) . ';';
    }

    return $output;
}


function get_encoded_mailto_link($classes)
{
    $email = carbon_get_theme_option('contact_email');

    if (!$email) {
        return '';
    }

    $email = encode_string_to_ASCII($email);
    $mailto = encode_string_to_ASCII('mailto:');

    ob_start();
    ?>

    <a href="<?= $mailto . $email; ?>" class="<?= $classes; ?>">
        <?= $email; ?>
    </a>

    <?php
    return ob_get_clean();
}


function get_content_from_url($url)
{
    if (!is_localhost()) {
        return file_get_contents($url);
    }

    return file_get_contents(
        $url,
        false,
        stream_context_create([
            'http' => ['method' => 'GET'], 'ssl' => ['verify_peer' => false, 'allow_self_signed' => true]
        ])
    );
}


function get_single_letter_meta()
{
    $letter = null;
    $type = isset($_GET['type']) ? $_GET['type'] : false;
    $id = isset($_GET['id']) ?  (int) $_GET['id'] : false;

    if ($type && $id) {
        $letter = get_content_from_url(admin_url("admin-ajax.php?action=get_single_hiko_letter&type={$type}&id=$id"));
        $letter = json_decode($letter, true);
        $letter['document_type'] = get_letter_doc_meta($letter['document_type']);
        $letter['related_resources'] = get_letter_related_resources($letter['related_resources']);
    }

    return $letter;
}


function custom_format_date($day, $month, $year)
{
    $day = $day && $day != 0 ? $day : '?';
    $month = $month && $month != 0 ? $month : '?';
    $year = $year && $year != 0 ? $year : '????';

    if ($year == '????' && $month == '?' && $day == '?') {
        return '?';
    }

    return "{$day}/{$month}/{$year}";
}


function get_letter_object_meta($id, $name, $meta, $type = false)
{
    if ($type) {
        $filtered_meta = array_filter($meta, function ($row) use($id, $type) {
            return ($row['id'] == (string) $id && $row['type'] == $type);
        });

        $filtered_meta = array_values($filtered_meta)[0];
        $filtered_meta['name'] = $name;
        return $filtered_meta;
    }

    $object_meta_index = array_search((string) $id, array_column($meta, 'id'));
    $meta[$object_meta_index]['name'] = $name;
    return $meta[$object_meta_index];

}


function format_letter_object($data, $element)
{
    $result = "<{$element} class='mb-1'>{$data['name']}";

    if (!empty($data['marked']) && $data['marked'] != $data['name']) {
        $result .= '<span class="text-secondary d-block">Marked as: ' . $data['marked'] . '</span>';
    }

    if (isset($data['salutation']) && !empty($data['salutation'])) {
        $result .= '<span class="text-secondary d-block">Salutation: ' . $data['salutation'] . '</span>';
    }

    $result .= "</{$element}>";

    return $result;
}


function get_letter_doc_meta($data)
{
    $result = [
        'copy' => '',
        'preservation' => '',
        'type' => '',
    ];

    if (empty($data)) {
        return $result;
    }

    $data = json_decode($data, true);

    foreach ($data as $item) {
        $result[key($item)] = $item[key($item)];
    }

    return $result;
}


function get_letter_related_resources($resources)
{
    $resources = json_decode($resources, true);

    $result = [];

    foreach ($resources as $resource) {
        if (!empty($resource['title'])) {
            $result[] = $resource;
        }
    }

    return $result;
}
