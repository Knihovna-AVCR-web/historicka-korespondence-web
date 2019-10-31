<?php

get_header();

$query_news = new WP_Query([
    'posts_per_page' => 3,
    'post_type' => 'post',
    'category_name' => 'Aktuálně'
]);

$news_link = get_category_link(get_cat_ID('Aktuálně'));

$news_title = __('Aktuálně', 'hiko');

while ($query_news->have_posts()) {
    $query_news->the_post();
    ob_start();
    ?>
    <h6>
        <a href="<?= get_permalink(); ?>">
            <?= get_the_title(); ?>
        </a>
    </h6>
<?php
    $news_content = ob_get_clean();
}
wp_reset_postdata();
var_dump($news_content);
the_post();

$blocks = parse_blocks(get_the_content());

?>

<div class="jumbotron-intro">

    <img class="img-fluid img-main lazy" data-sizes="(max-width: 1400px) 100vw, 1400px" data-srcset="
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_200.jpg 200w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_579.jpg 579w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_831.jpg 831w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_1041.jpg 1041w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_1221.jpg 1221w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_1386.jpg 1386w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_1537.jpg 1537w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_1686.jpg 1686w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_1816.jpg 1816w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_1950.jpg 1950w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_2057.jpg 2057w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_2175.jpg 2175w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_2287.jpg 2287w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_2397.jpg 2397w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_2503.jpg 2503w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_2557.jpg 2557w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_2559.jpg 2559w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_2560.jpg 2560w" data-src="<?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_2560.jpg" alt="Korespondence" role="presentation">

</div>

<div class="row bg-dark-500">
    <?php output_block_by_name($blocks, 'carbon-fields/uvod'); ?>
</div>

<div class="row my-5 py-3 lh-lg">
    <div class="container">
        <div class="row featured">
            <?php
            output_block_by_name($blocks, 'carbon-fields/uvodni-box');
            echo output_intro_box(
                $news_link,
                $news_title,
                $news_content
            );
            ?>
        </div>
    </div>
</div>

<div class="row my-5 py-3">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-auto">
                <a href="https://lib.cas.cz" target="_blank">
                    <img src="<?= get_template_directory_uri() . '/assets/img/'; ?>load.svg" data-src="<?= get_template_directory_uri() . '/assets/img/'; ?>knav.png" alt="Knihovna AV ČR" class="my-2 lazy" style="min-height:24px; min-width: 24px;">
                </a>
            </div>
            <div class="col-auto">
                <a href="http://www.avcr.cz/" target="_blank">
                    <img src="<?= get_template_directory_uri() . '/assets/img/'; ?>load.svg" data-src="<?= get_template_directory_uri() . '/assets/img/'; ?>av.png" alt="Akademie věd ČR" class="my-2 lazy" style="min-height:24px; min-width: 24px;">
                </a>
            </div>
            <div class="col-auto">
                <a href="http://www.avcr.cz/cs/strategie/vyzkumne-programy/prehled-programu" target="_blank">
                    <img src="<?= get_template_directory_uri() . '/assets/img/'; ?>load.svg" data-src="<?= get_template_directory_uri() . '/assets/img/'; ?>av21.png" alt="Strategie AV21" class="my-2 lazy" style="min-height:24px; min-width: 24px;">
                </a>
            </div>
            <div class="col-auto" target="_blank">
                <a href="https://www.mua.cas.cz/">
                    <img src="<?= get_template_directory_uri() . '/assets/img/'; ?>load.svg" data-src="<?= get_template_directory_uri() . '/assets/img/'; ?>mua.png" alt="Masyrykův ústav a archiv AV ČR" class="my-2 lazy" style="min-height:24px; min-width: 24px;">
                </a>
            </div>
            <div class="col-auto" target="_blank">
                <a href="https://www.flu.cas.cz/">
                    <img src="<?= get_template_directory_uri() . '/assets/img/'; ?>load.svg" data-src="<?= get_template_directory_uri() . '/assets/img/'; ?>ip.png" alt="Filozofický ústav AV ČR" class="my-2 lazy" style="min-height:24px; min-width: 24px;">
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer();
