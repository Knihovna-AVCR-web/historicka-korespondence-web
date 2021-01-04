<?php

$img_dir = get_template_directory_uri() . '/assets/img/';

$query_news = new WP_Query([
    'posts_per_page' => 3,
    'post_type' => 'post',
    'category_name' => 'Aktuálně'
]);

$news_content = '';
while ($query_news->have_posts()) {
    $query_news->the_post();
    ob_start(); ?>
    <h3>
        <a href="<?= get_permalink(); ?>">
            <?= get_the_title(); ?>
            <span class="text-sm">
                <?= ' (' . get_the_date() . ')'; ?>
            </span>
        </a>
    </h3>
    <?php $news_content .= ob_get_clean();
}
wp_reset_postdata();

get_header();

the_post();

$blocks = parse_blocks(get_the_content());

?>
<img class="w-full lazy" data-sizes="(max-width: 1400px) 100vw, 1400px" data-srcset="
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_200.jpg 200w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_579.jpg 579w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_831.jpg 831w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_1041.jpg 1041w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_1221.jpg 1221w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_1386.jpg 1386w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_1537.jpg 1537w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_1686.jpg 1686w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_1816.jpg 1816w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_1950.jpg 1950w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_2057.jpg 2057w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_2175.jpg 2175w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_2287.jpg 2287w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_2397.jpg 2397w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_2503.jpg 2503w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_2557.jpg 2557w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_2559.jpg 2559w,
    <?= $img_dir; ?>main_bg_urfh37_c_scale,w_2560.jpg 2560w" data-src="<?= $img_dir; ?>main_bg_urfh37_c_scale,w_2560.jpg" alt="" role="presentation">

<div class="px-5 py-12 bg-brown">
    <div class="max-w-4xl mx-auto text-xl italic text-center text-white">
        <?php output_block_by_name($blocks, 'carbon-fields/uvod'); ?>
    </div>
</div>
<div class="container px-5 py-3 mx-auto">
    <div class="flex flex-wrap my-5 overflow-hidden md:-mx-5">
        <?php
        output_block_by_name($blocks, 'carbon-fields/uvodni-box');
        echo output_intro_box(
            get_category_link(get_cat_ID('Aktuálně')),
            __('Aktuálně', 'hiko'),
            $news_content
        );
        ?>
    </div>
</div>
<div class="container flex flex-wrap justify-between px-5 mx-auto mt-24">
    <a href="https://lib.cas.cz" target="_blank">
        <img data-src="<?= $img_dir; ?>knav.png" alt="Knihovna AV ČR" class="m-2 lazy" style="min-height:24px; min-width: 24px;">
    </a>
    <a href="http://www.avcr.cz/" target="_blank">
        <img data-src="<?= $img_dir; ?>av.png" alt="Akademie věd ČR" class="m-2 lazy" style="min-height:24px; min-width: 24px;">
    </a>
    <a href="http://www.avcr.cz/cs/strategie/vyzkumne-programy/prehled-programu" target="_blank">
        <img data-src="<?= $img_dir; ?>av21.png" alt="Strategie AV21" class="m-2 lazy" style="min-height:24px; min-width: 24px;">
    </a>
    <a href="https://www.mua.cas.cz/" target="_blank">
        <img data-src="<?= $img_dir; ?>mua.png" alt="Masyrykův ústav a archiv AV ČR" class="m-2 lazy" style="min-height:24px; min-width: 24px;">
    </a>
    <a href="https://www.flu.cas.cz/" target="_blank">
        <img data-src="<?= $img_dir; ?>ip.png" alt="Filozofický ústav AV ČR" class="m-2 lazy" style="min-height:24px; min-width: 24px;">
    </a>
</div>

<?php get_footer();
