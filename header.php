<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?php get_site_title(); ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= home_url('/'); ?>favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= home_url('/'); ?>favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= home_url('/'); ?>favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= home_url('/'); ?>favicon/site.webmanifest">
    <link rel="mask-icon" href="<?= home_url('/'); ?>favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="<?= home_url('/'); ?>favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="<?= home_url('/'); ?>favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <script type="text/javascript">
    var homeUrl = "<?= esc_url(home_url('/')); ?>";
    </script>
    <?php
    wp_head();
    require_once 'partials/fonts.php';
    require_once 'partials/analytics.php'; ?>
</head>
<body <?php body_class(); ?>>

    <div class="header">
        <?php
        require 'partials/main-nav.php';
        if (is_page_template('page-templates/page-blekastad-front.php') || get_post_meta(get_queried_object_id(), 'bl_submenu', true) == 'on') {
            require 'partials/blekastad-nav.php';
        }
        ?>
    </div>

    <div class="container-fluid">
