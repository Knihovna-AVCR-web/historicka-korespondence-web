<?php

/*
Template Name: Browse DB
*/

$selectData = [
    'author' => 'Author',
    'recipient' => 'Recipient',
    'origin' => 'Origin',
    'destination' => 'Destination',
];

get_header();

the_post();
?>

<script>
    var lettersSuffix = '<?= carbon_get_post_meta(get_the_ID(), 'index_endpoint'); ?>';
    var letterType = '<?= carbon_get_post_meta(get_the_ID(), 'single_endpoint'); ?>';
</script>

<div class="px-5 mx-auto mt-12">
    <div class="mb-8 prose">
        <h1>
            <?php the_title(); ?>
        </h1>
    </div>
    <div class="flex flex-wrap mb-5" id="letters">
        <div id="letters-filter" class="w-full mb-5 md:w-3/12 md:pr-6 none">
            <?php foreach ($selectData as $key => $val) : ?>
                <label for="author" class="block mb-1 text-red-700 uppercase">
                    <?= $val; ?>
                </label>
                <select id="<?= $key; ?>" class="mb-4"></select>
            <?php endforeach; ?>
            <label for="from-year" class="block mb-1 text-red-700 uppercase">From</label>
            <input type="number" class="mb-4 ss-like-input" id="from-year" autocomplete="off">
            <label for="to-year" class="block mb-1 text-red-700 uppercase">To</label>
            <input type="number" class="mb-4 ss-like-input" id="to-year" autocomplete="off">
        </div>
        <div class="w-full md:w-9/12">
            <p id="counter" class="text-lg none">
                Showing <span id="search-count"></span> items from <span id="total-count"></span> total items
            </p>
            <div id="letters-table"></div>
        </div>
    </div>
</div>

<?php

get_footer();
