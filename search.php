<?php

get_header();

require 'partials/entry-header.php';

global $wp_query;

?>

<h1>
    <?php _e('Výsledky vyhledávání pro:', 'hiko'); ?> <?= get_search_query(); ?>
</h1>
<p>
    <?php _e('Počet výsledků', 'hiko'); ?>: <?= $wp_query->found_posts; ?>
</p>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <div class="bb-light pb-1 my-4">
            <h3>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>">
                <?php _e('Více', 'hiko') ?>
            </a>

        </div>
    <?php endwhile; ?>
<?php else : ?>
    <p>
        <?php _e('Zadaný výraz nebyl nalezen. Zkuste to znovu.', 'hiko'); ?>
    </p>
    <?php get_search_form(); ?>
<?php endif;

require 'partials/entry-footer.php';

get_footer();
