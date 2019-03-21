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
            <?php require get_template_directory() . '/partials/db-sidebar.php';?>
        </div>

        <div class="col-md-9">
            <div class="loading mb-5" v-if="loading && ['home'].indexOf($route.name) > -1">
                Loading...
            </div>

            <div v-if="error && ['home'].indexOf($route.name) > -1" class="error alert alert-warning mb-5">
                {{ error }}
            </div>

            <div v-if="letterErr && ['letter'].indexOf($route.name) > -1" class="error alert alert-warning mb-5">
                {{ letterErr }}
            </div>

            <?php require get_template_directory() . '/partials/db-table.php';?>

            <?php require get_template_directory() . '/partials/letter-detail.php';?>

        </div>
    </div>

<?php endwhile;

get_footer();
