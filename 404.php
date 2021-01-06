<?php
get_header();
require 'partials/entry-header.php'; ?>

<article class="prose">
    <h1>
        <?php _e('Nenalezeno', 'hiko'); ?>
    </h1>
    <p>
        <?php _e('Zadaná stránka nebyla nalezena.', 'hiko'); ?>
    </p>
    <?php get_template_part('partials/searchform'); ?>
</article>

<?php
require 'partials/entry-footer.php';
get_footer();
