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
    require_once get_template_directory() . '/inc/breadcrumbs.php';
    require_once get_template_directory() . '/inc/nav-walker.php';
});


add_action('wp_enqueue_scripts', function () {
    $dist_uri = get_template_directory_uri() . '/assets/dist/';
    $dist_dir = get_template_directory() . '/assets/dist/';

    is_user_logged_in() ? wp_enqueue_script('jquery') : wp_dequeue_script('jquery');

    wp_deregister_script('wp-embed');

    wp_enqueue_script('main', $dist_uri . 'app.js', [], filemtime($dist_dir . 'app.js'), true);
    wp_enqueue_style('main', $dist_uri . 'app.css', [], filemtime($dist_dir . 'app.css'));

    if (is_page_template('page-templates/page-browse-db.php')) {
        wp_enqueue_script('table', $dist_uri . 'filter-table.js', [], filemtime($dist_dir . 'filter-table.js'), true);
        wp_enqueue_style('table', $dist_uri . 'filter-table.css', [], filemtime($dist_dir . 'filter-table.css'));
    }
});


add_action('template_redirect', function () {
    global $post;

    if (!$post || $post->post_name != 'browse') {
        return;
    }

    $db = isset($_GET['db']) && !empty($_GET['db']) ? $_GET['db'] : false;

    $options = [
        'bl_letter' => ICL_LANGUAGE_CODE . '_mb_db',
        'tgm_letter' => ICL_LANGUAGE_CODE . '_tgm_db',
        'sachs_letter' => ICL_LANGUAGE_CODE . '_sachs_db',
        'pol_letter' => ICL_LANGUAGE_CODE . '_pol_db',
    ];

    if (isset($options[$db])) {
        $url = get_permalink(carbon_get_theme_option($options[$db]));
        exit(wp_redirect($url));
    }

    exit(wp_redirect(home_url('projekty')));
});


function custom_pagination()
{
    global $wp_query;

    $big = 999999999;

    $pages =  paginate_links([
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'current' => max(1, get_query_var('paged')),
        'format' => '?paged=%#%',
        'next_text' => 'Další &rarr;',
        'prev_next' => true,
        'prev_text' => '&larr; Předchozí',
        'total' => $wp_query->max_num_pages,
        'type' => 'array',
    ]);


    $pagination = '<ul class="flex flex-wrap space-x-4">';
    foreach ((array) $pages as $page) {
        if (preg_match('/\bcurrent\b/', $page)) {
            $pagination .= "<li>$page</li>";
        } else {
            $pagination .= "<li class='underline'>$page</li>";
        }
    }

    $pagination .= '</ul>';

    return $pagination;
}


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
    global $post;

    if (!$post) {
        return;
    }

    $show = false;

    if (is_page_template('page-templates/page-blekastad-front.php')) {
        $show = true;
    } else if (get_post_meta(get_queried_object_id(), 'bl_submenu', true) == 'on') {
        $show = true;
    } else if ($post->post_name == 'letter' && isset($_GET['type']) && $_GET['type'] == 'bl_letter') {
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

    $languages = pll_the_languages([
        'raw' => 1,
        'hide_current' => 0
    ]);

    $output = [];

    foreach ($languages as $lang) {
        $is_disabled = $lang['current_lang'] || $lang['no_translation'];
        ob_start(); ?>
        <a href="<?= ($is_disabled) ? '#' : $lang['url']; ?>" class="uppercase text-sm <?= ($is_disabled) ? 'cursor-not-allowed text-gray-400 hover:text-gray-400' : 'hover:text-red-700'; ?>" aria-disabled="<?= ($is_disabled) ? 'true' : 'false'; ?>">
            <?= $lang['slug'] ?>
        </a>
        <?php
        $output[] = ob_get_clean();
    }

    return implode('/', $output);
}


function get_all_posts()
{
    $the_query = new WP_Query([
        'order' => 'ASC',
        'orderby' => 'title',
        'post_type' => ['post', 'page'],
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ]);

    $results = [];

    while ($the_query->have_posts()) {
        $the_query->the_post();
        $parent = wp_get_post_parent_id(get_the_ID());
        $parent = $parent ? get_the_title($parent) . ': ' : '';
        $results[get_the_ID()] = $parent . get_the_title();
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
    <article class="w-full my-4 md:px-5 md:w-6/12 xl:w-4/12 front">
        <h2 class="mb-3 text-2xl border-b-2">
            <a href="<?= $permalink; ?>">
                <?= $title; ?>
            </a>
        </h2>
        <div class="text-sm prose">
            <?= $content; ?>
        </div>
    </article>
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
    $id = isset($_GET['id']) ? (int) $_GET['id'] : false;

    if ($type && $id) {
        $letter = get_content_from_url(admin_url("admin-ajax.php?action=get_single_hiko_letter&type={$type}&id=$id"));
        $letter = json_decode($letter, true);
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


function format_letter_object($data, $element)
{
    $result = "<{$element} class='mb-1'>{$data['name']}";

    if (!empty($data['marked']) && $data['marked'] != $data['name']) {
        $result .= '<span class="block pl-3 text-gray-500">Marked as: ' . $data['marked'] . '</span>';
    }

    if (isset($data['salutation']) && !empty($data['salutation'])) {
        $result .= '<span class="block pl-3 text-gray-500">Salutation: ' . $data['salutation'] . '</span>';
    }

    $result .= "</{$element}>";

    return $result;
}

function get_letter_title($letter)
{
    $author = empty($letter['l_author']) ? '' : $letter['l_author'][0]['simple_name'];
    $recipient = empty($letter['recipient']) ? '' : $letter['recipient'][0]['simple_name'];
    $origin = empty($letter['origin']) ? '' : $letter['origin'][0]['name'];
    $destination = empty($letter['dest']) ? '' : $letter['dest'][0]['name'];
    $title = '';

    $title .= $letter['date_day'] ? $letter['date_day'] . '. ' : '? ';
    $title .= $letter['date_month'] ? $letter['date_month'] . '. ' : '? ';
    $title .= $letter['date_year'] ? $letter['date_year'] . ' ' : '? ';
    $title .= $author ? "$author " : '';
    $title .= $origin ? "($origin) " : '';
    $title .= $recipient || $destination ? 'to ' : '';
    $title .= $recipient ? "$recipient " : '';
    $title .= $destination ? "($destination) " : '';

    return $title;
}
