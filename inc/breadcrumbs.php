<?php

add_shortcode('breadcrumbs', function () {
    ob_start(); ?>
    <nav aria-label="breadcrumb">
        <ol class="flex pb-3 mb-6 text-sm text-red-700 border-b-2 border-red-700">
            <li class="inline-flex items-center">
                <a href="<?= home_url('/'); ?>">
                    <?php _e('Úvod', 'hiko'); ?>
                </a>
                <svg class="w-auto h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </li>
            <?php if (is_category()) : ?>
                <li class="inline-flex items-center text-gray-500">
                    <?= get_the_category()[0]->name; ?>
                </li>
            <?php elseif (is_single()) : ?>
                <?php if (has_category()) : ?>
                    <li class="inline-flex items-center">
                        <a href="<?= get_category_link(get_the_category()[0]->term_id); ?>">
                            <?= get_the_category()[0]->name; ?>
                        </a>
                        <svg class="w-auto h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                <?php endif; ?>
                <li class="inline-flex items-center text-gray-500">
                    <?= get_the_title(); ?>
                </li>
            <?php elseif (is_page()) : ?>
                <?php global $post; ?>
                <?php if ($post->post_parent) : ?>
                    <li class="inline-flex items-center">
                        <a href="<?= get_permalink($post->post_parent); ?>">
                            <?= get_the_title($post->post_parent); ?>
                        </a>
                        <svg class="w-auto h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                <?php endif; ?>
                <li class="inline-flex items-center text-gray-500">
                    <?= get_the_title(); ?>
                </li>
            <?php endif; ?>
        </ol>
    </nav>
    <?php return ob_get_clean();
});
