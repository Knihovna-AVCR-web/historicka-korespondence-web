<?php

get_header();

require 'partials/entry-header.php';

echo do_shortcode('[breadcrumbs]');

?>


<h1>
    <?php single_cat_title() ?>
</h1>

<?php while (have_posts()) : ?>
    <?php the_post(); ?>
    <div class="bb-light pb-1 my-4">
        <h3>
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h3>
        <p><?php the_date(); ?></p>
        <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>">
            <?php _e('Více', 'hiko') ?>
        </a>
    </div>
<?php endwhile;

require 'partials/entry-footer.php';

get_footer();
