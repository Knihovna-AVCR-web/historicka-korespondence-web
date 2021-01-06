<?php
get_header();
require 'partials/entry-header.php';
echo do_shortcode('[breadcrumbs]'); ?>

<article class="prose">
    <h1>
        <?php single_cat_title() ?>
    </h1>
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <section>
            <h2>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>
            <p class="text-sm">
                <?php the_date(); ?>
            </p>
            <?php the_excerpt(); ?>
        </section>
    <?php endwhile;  ?>
</article>
<div class="my-6">
    <?= custom_pagination(); ?>
</div>
<?php
require 'partials/entry-footer.php';
get_footer();
