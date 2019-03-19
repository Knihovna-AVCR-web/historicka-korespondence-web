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

get_search_form();

require 'partials/entry-footer.php';

get_footer();
