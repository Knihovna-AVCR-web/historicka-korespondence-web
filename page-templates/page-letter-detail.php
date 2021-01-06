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
    <div class="flex flex-wrap px-5 mx-auto mt-12 mb-5">
        <div id="letters-filter" class="w-full mb-5 md:w-3/12 md:pr-6">
            <a href="<?= home_url("browse?db={$db}") ?>" class="mb-3 text-3xl text-red-700">Back to list</a>
        </div>
        <div class="w-full md:w-9/12">
            <?php require get_template_directory() . '/partials/letter-single.php'; ?>
        </div>
    </div>
<?php endif;

get_footer();
