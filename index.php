<?php get_header(); ?>

<?php while (have_posts()) : ?>
    <?php

    the_post();

    require 'partials/entry-header.php';

    echo do_shortcode('[breadcrumbs]'); ?>

    <h1>
        <?php the_title(); ?>
    </h1>

    <?php

    the_content();

    cmb2_output_gallery('hk_gallery');

    require 'partials/entry-footer.php'; ?>

<?php endwhile;

get_footer();
