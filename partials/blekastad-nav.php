<?php

$blekastad_front = get_permalink(carbon_get_theme_option('mb_front'));

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary sub-menu">
    <div class="container-fluid align-items-baseline align-items-lg-center">
        <div class="navbar-brand d-flex">
            <span class="first"></span>
            <a class="font-italic text-white" href="<?= $blekastad_front; ?>">
                <?php _e('Korespondence Milady Blekastad', 'hiko'); ?>
            </a>
        </div>

        <div class="justify-content-end" id="blekastadMenuContent">
            <?php
            wp_nav_menu([
                'walker' => new NavbarWalker(),
                'menu' => 'blekastad-menu',
                'theme_location' => 'blekastad-menu',
                'items_wrap' => '<ul class="navbar-nav">%3$s</ul>',
                'container' => ''
            ]);
            ?>
        </div>
    </div>
</nav>
