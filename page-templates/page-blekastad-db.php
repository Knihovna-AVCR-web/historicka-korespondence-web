<?php

/*
Template Name: Blekastad DB
*/

get_header();

?>

<?php while (have_posts()) : ?>
<?php the_post(); ?>

<h1 class="my-5 mx-3">
    <?php the_title(); ?>
</h1>

<div class="row main-content mb-5" id="letters">

    <div class="col-md-3">
        <router-link to="/" v-if="isInArray('letter', $route.name)" :class="'router-link-active text-primary h3 d-block mb-3'">
            Back to results
        </router-link>

        <div class="filters" v-if="isInArray('home', $route.name)">
            <filter-lists :letters="filteredData" :active-filter="activeFilter"></filter-lists>
        </div>
    </div>

    <div class="col-md-9">
        <div class="loading mb-5" v-if="loading && isInArray('home', $route.name)">
            Loading...
        </div>

        <div v-if="error && isInArray('home', $route.name)" class="error alert alert-warning mb-5">
            {{ error }}
        </div>

        <div v-if="letterErr && isInArray('letter', $route.name)" class="error alert alert-warning mb-5">
            {{ letterErr }}
        </div>

        <filter-table :letters="filteredData" v-if="isInArray('home', $route.name)">

        </filter-table>

        <letter-detail :letter="letter" v-if="letter && isInArray('letter', $route.name) && !letterErr">
        </letter-detail>

    </div>

</div>

<?php endwhile;

get_footer();
