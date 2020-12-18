<?php
get_header();
require 'partials/entry-header.php';
global $wp_query;
?>

<article class="prose">
    <h1>
        <?php _e('Výsledky vyhledávání pro:', 'hiko'); ?> <?= get_search_query(); ?>
    </h1>
    <p>
        <?php _e('Počet výsledků', 'hiko'); ?>: <?= $wp_query->found_posts; ?>
    </p>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <section>
                <h2>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <?php the_excerpt(); ?>
            </section>
        <?php endwhile; ?>
    <?php else : ?>
        <p>
            <?php _e('Zadaný výraz nebyl nalezen. Zkuste to znovu.', 'hiko'); ?>
        </p>
        <?php get_template_part('partials/searchform'); ?>
    <?php endif; ?>
</article>

<div class="my-6">
        <?= custom_pagination(); ?>
    </div>
<?php
require 'partials/entry-footer.php';
get_footer();
