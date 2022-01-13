<!DOCTYPE html>
<html <?php language_attributes(); ?> class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri(); ?>/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri(); ?>/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri(); ?>/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= get_template_directory_uri(); ?>/assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?= get_template_directory_uri(); ?>/assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="<?= get_template_directory_uri(); ?>/assets/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="<?= get_template_directory_uri(); ?>/assets/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <script type="text/javascript">
    var homeUrl = "<?= esc_url(home_url('/')); ?>";
    var ajaxUrl = '<?= admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
    wp_head();
    require_once 'partials/fonts.php';
    ?>
</head>
<body <?php body_class('h-full flex flex-col font-merriweather text-brown-dark'); ?>>
    <header class="z-10 pt-1 bg-brown">
        <?php
        require 'partials/main-nav.php';
        show_blekastad_nav();
        ?>
    </header>
    <main class="mb-24">
