<?php

/*
Template Name: Browse DB
*/

get_header();

the_post();

?>

<h1 class="my-5 mx-3">
    <?php the_title(); ?>
</h1>
<div class="row main-content mb-5" id="letters">
    <div class="col-md-3">
        <div class="filters">
            <filter-lists :letters="filteredData" :active-filter="activeFilter"></filter-lists>
        </div>
    </div>
    <div class="col-md-9">
        <div class="loading mb-5" v-if="loading && !error">
            Loading...
        </div>

        <div v-if="error" class="error alert alert-warning mb-5">
            {{ error }}
        </div>

        <filter-table :letters="filteredData"></filter-table>
    </div>

</div>

<?php

get_footer();
