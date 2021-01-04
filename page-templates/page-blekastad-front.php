<?php

/*
Template Name: Blekastad Front Page
*/

get_header();

$db_url = get_permalink(carbon_get_theme_option('mb_db'));

$blocks = parse_blocks(get_the_content());

?>

<div class="jumbotron-intro">
    <img
    class="img-fluid img-main lazy"
    data-sizes="(max-width: 2560px) 100vw, 2560px"
    data-srcset="
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_525.jpg 525w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_747.jpg 747w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_936.jpg 936w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_1099.jpg 1099w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_1245.jpg 1245w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_1524.jpg 1524w,
    <?= get_template_directory_uri() . '/assets/img/'; ?>blekastad_bg_hgwpso_c_scale,w_2010.jpg 2010w,
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

<div class="py-3 my-5 row lh-lg">
    <div class="container">
        <div class="row featured">
            <div class="col-lg-4 col-md-6">
                <div class="sticky featured-box">
                    <p class="h3"><?php _e('Korespondence', 'hiko'); ?></p>
                    <p class="text-primary display-5 font-italic">
                        <?php _e('Milady Blekastad', 'hiko'); ?>
                    </p>
                </div>
            </div>
            <?php output_block_by_name($blocks, 'carbon-fields/uvodni-box'); ?>
        </div>
    </div>
</div>

<?php get_footer();
