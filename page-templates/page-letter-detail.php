<?php

/*
* Template Name: Letter detail
*/

get_header();

the_post();

$db = isset($_GET['type']) ? $_GET['type'] : '';

$letter = get_single_letter_meta();

?>

<?php if (empty($letter)) : ?>
    <?php require get_template_directory() . '/partials/letter-404.php'; ?>
<?php else : ?>
    <div class="row main-content my-5">
        <div class="col-md-3">
            <a href="<?= home_url("browse?db={$db}") ?>" class="text-primary h3 d-block mb-3">Back to list</a>
        </div>
        <div class="col-md-9">
            <?php require get_template_directory() . '/partials/letter-single.php'; ?>
        </div>
    </div>
<?php endif;

get_footer();
