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

<h1 class="my-5 mx-3">
    <?php the_title(); ?>
</h1>
<script>
    var lettersSuffix = '<?= carbon_get_post_meta(get_the_ID(), 'index_endpoint'); ?>';
</script>
<div class="row main-content mb-5" id="letters">
    <div class="col-lg-3">
        <div id="letters-filter" class="d-none mb-3">
            <?php foreach ($selectData as $key => $val) : ?>
                <div class="filter mb-4">
                    <label for="author" class="mb-1 d-block text-primary text-uppercase">
                        <?= $val; ?>
                    </label>
                    <select id="<?= $key; ?>"></select>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-lg-9">
        <p id="counter" class="d-none h6">
            Showing <span id="search-count"></span> items from <span id="total-count"></span> total items
        </p>
        <div id="letters-table"></div>
    </div>
</div>

<?php

get_footer();
