<?php

$options = get_option('hko_options');
$blekastad_front = '#';

if (is_array($options) && array_key_exists('mb_front', $options)) {
    $blekastad_front = get_permalink($options['mb_front']);
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary sub-menu">
    <div class="container-fluid align-items-baseline align-items-lg-center">
        <div class="navbar-brand d-flex">
            <span class="first"></span>
            <a class="font-italic text-white" href="<?= $blekastad_front; ?>">
                Milada Blekastad
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
