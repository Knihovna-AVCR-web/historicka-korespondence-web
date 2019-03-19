<?php

/*
Template Name: Blekastad Front Page
*/

get_header();


$fp_meta = get_post_meta(get_queried_object_id());
$fp_meta_boxes = get_post_meta(get_queried_object_id(), 'bf_box_group', true);

$db_url = get_permalink(carbon_get_theme_option('mb_db'));

?>

<div class="jumbotron-intro">
    <img
    class="img-fluid img-main lazy"
    data-sizes="(max-width: 2560px) 100vw, 2560px"
    data-srcset="
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_200.jpg 200w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_525.jpg 525w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_747.jpg 747w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_936.jpg 936w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_1099.jpg 1099w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_1245.jpg 1245w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_1391.jpg 1391w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_1524.jpg 1524w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_1648.jpg 1648w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_1774.jpg 1774w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_1908.jpg 1908w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_2010.jpg 2010w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_2116.jpg 2116w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_2231.jpg 2231w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_2332.jpg 2332w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_2428.jpg 2428w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_2535.jpg 2535w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_2559.jpg 2559w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_2560.jpg 2560w"
    data-src="<?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_2560.jpg"
    alt="Milada Blekastad" role="presentation">

    <div class="search-box-container">
        <div class="search-box">
            <a href="<?= $db_url; ?>" class="btn btn-primary">
                <?php _e('Vstup do databáze', 'hiko'); ?>&nbsp;&nbsp;&raquo;
            </a>
        </div>
    </div>
</div>

<div class="row my-5 py-3 lh-lg">
    <div class="container">
        <div class="row featured">
            <div class="col-lg-4 col-md-6">
                <div class="featured-box sticky">
                    <p class="h3"><?php _e('Korespondence', 'hiko'); ?></p>
                    <p class="text-primary display-5 font-italic">
                        <?php _e('Milady Blekastad', 'hiko'); ?>
                    </p>
                </div>
            </div>

            <?php if (is_array($fp_meta_boxes)) : ?>
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
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer();
