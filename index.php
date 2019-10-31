<?php

get_header();

the_post();

require 'partials/entry-header.php';

echo do_shortcode('[breadcrumbs]');

?>

<h1>
    <?php the_title(); ?>
</h1>

<?php

the_content();

cmb2_output_gallery('hk_gallery');

require 'partials/entry-footer.php';

get_footer();
