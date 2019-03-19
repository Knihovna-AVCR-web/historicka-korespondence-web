<nav class="navbar navbar-expand-lg navbar-light bg-white main-menu">
    <div class="container-fluid align-items-baseline py-2">
        <a class="navbar-brand d-flex" href="<?= home_url() ?>">
            <img src="<?= get_template_directory_uri() . '/assets/img/logo.png'; ?>" alt="Logo" height="85" width="69">
            <div>
                <span class="text-primary">
                    <?php _e('Historická<br>korespondence', 'hiko'); ?>
                </span>
                <br>
                <span class="text-body">
                    <?php _e('online', 'hiko'); ?>
                </span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainMenuContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end main-menu-content mt-4" id="mainMenuContent">
            <?php
            wp_nav_menu([
                'walker' => new NavbarWalker(),
                'menu' => 'main-menu',
                'theme_location' => 'main-menu',
                'items_wrap' => '<ul class="navbar-nav">%3$s</ul>',
                'container' => ''
            ]);
            ?>
            <span class="language-switcher">
                <?= language_switcher(); ?>
            </span>
        </div>
    </div>
</nav>
