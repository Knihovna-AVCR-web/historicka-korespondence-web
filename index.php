<!doctype html>
<html <?php language_attributes(); ?> class="h-full">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php echo view('partials/favicons')->render(); ?>
  <?php wp_head(); ?>
</head>

<body <?php body_class('flex flex-col h-full m-0 bg-gray-100'); ?>>
  <?php wp_body_open(); ?>
  <?php do_action('get_header'); ?>
  <?php echo view(app('sage.view'), app('sage.data'))->render(); ?>
  <?php do_action('get_footer'); ?>
  <?php wp_footer(); ?>
</body>

</html>
