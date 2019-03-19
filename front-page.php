<?php

get_header();

$query_news = new WP_Query([
    'posts_per_page' => 3,
    'post_type' => 'post',
    'category_name' => 'Aktuálně'
]);

$fp_meta = get_post_meta(get_queried_object_id());
$fp_meta_boxes = get_post_meta(get_queried_object_id(), 'box_group', true);
$fp_link = get_post_meta(get_queried_object_id(), 'hp_link', true);

if ($fp_link != '') {
    $fp_link = get_permalink($fp_meta['hp_link']['0']);
}

?>

<div class="jumbotron-intro">
    
    <img
    class="img-fluid img-main lazy"
    data-sizes="(max-width: 1400px) 100vw, 1400px"
    data-srcset="
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
    <?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_2560.jpg 2560w" 
    data-src="<?= get_template_directory_uri() . '/assets/img/'; ?>main_bg_urfh37_c_scale,w_2560.jpg"
    alt="Korespondence" role="presentation">
    
</div>


<div class="row bg-dark-500">
    <div class="container">
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <div class="row">
                <div class="col-12 jumbotron text-center mb-0">
                    <p class="lead">
                        <?= $fp_meta['hp_intro']['0']; ?>
                    </p>
                    <a href="<?= $fp_link; ?>" class="btn btn-outline-white btn-sm text-uppercase btn-state-primary px-4 mt-4" style="font-size:16px">
                        <?php _e('Více', 'hiko'); ?>&nbsp;&nbsp;&raquo;
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<div class="row my-5 py-3 lh-lg">
    <div class="container">
        <div class="row featured">
            
            <?php foreach ($fp_meta_boxes as $box) : ?>
                <div class="col-lg-4 col-md-6">
                    <div class="featured-box">
                        <h3 class="title">
                            <?php if (array_key_exists('url', $box) && $box['url'] != '') : ?>
                                <a href="<?= get_permalink($box['url']); ?>">
                                    <?= get_esc_setted_value($box['title']); ?>
                                </a>
                            <?php else : ?>
                                <?= get_esc_setted_value($box['title']); ?>
                            <?php endif; ?>
                        </h3>
                        <?php if ($box['descr'] != '') : ?>
                            <p>
                                <?= esc_html($box['descr']); ?>
                                <?php if (array_key_exists('url', $box) && $box['url'] != '') : ?>
                                    <a href="<?= get_permalink($box['url']); ?>">
                                        <?php _e('Více', 'hiko'); ?> »
                                    </a>
                                <?php endif; ?>
                            </p>
                        <?php elseif ($box['desc-html'] != '') : ?>
                            <?= $box['desc-html']; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
        </div>
    </div>
    
    
</div>

<div class="row bg-light lh-lg">
    <div class="container">
        <div class="row my-5 py-3">
            <div class="col-12 text-center">
                <h3 class="mb-4 h2"><?php _e('Aktuálně', 'hiko'); ?></h3>
            </div>
            <div class="row featured featured-news">
                <?php while ($query_news->have_posts()) : ?>
                    <?php $query_news->the_post(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="featured-box">
                            <h6 class="title">
                                <a href="<?= get_permalink(); ?>">
                                    <?= get_the_title(); ?>
                                </a>
                            </h6>
                            <p>
                                <?= get_the_excerpt(); ?>
                                <br>
                                <a href="<?= get_permalink(); ?>" class="float-right">
                                    <?php _e('Více', 'hiko'); ?> »
                                </a>
                            </p>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
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
