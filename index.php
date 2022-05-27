<!doctype html>
<html <?php language_attributes(); ?> class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php echo view('partials/favicons')->render(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class('flex flex-col h-full m-0 font-merriweather text-primary'); ?>>
    <?php wp_body_open(); ?>
    <?php do_action('get_header'); ?>
    <?php echo view(app('sage.view'), app('sage.data'))->render(); ?>
    <?php do_action('get_footer'); ?>
    <?php wp_footer(); ?>
</body>

</html>
