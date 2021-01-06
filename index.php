<?php
get_header();
the_post();
require 'partials/entry-header.php';
echo do_shortcode('[breadcrumbs]');
?>

<article class="py-5 prose border-t-2 border-b-2 border-red-700">
    <h1>
        <?php the_title(); ?>
    </h1>
    <?php the_content(); ?>
</article>

<?php
require 'partials/entry-footer.php';
get_footer();
