<?php

get_header();

require 'partials/entry-header.php'; ?>

<h1>
    <?php _e('Nenalezeno', 'hiko'); ?>
</h1>
<p>
    <?php _e('Zadaná stránka nebyla nalezena.', 'hiko'); ?>
</p>

<?php

get_template_part('partials/searchform');

require 'partials/entry-footer.php';

get_footer();
