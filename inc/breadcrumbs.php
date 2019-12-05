<?php

function breadcrumbs()
{
    ob_start();
    ?>

    <nav aria-label="breadcrumb" class="breadcrumbs">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= home_url('/'); ?>">
                    <?php _e('Úvod', 'hiko'); ?>
                </a>
            </li>

            <?php if (is_category()) : ?>
                <li class="breadcrumb-item active">
                    <?= get_the_category()[0]->name; ?>
                </li>
            <?php elseif (is_single()) : ?>
                <?php if (has_category()) : ?>
                    <li class="breadcrumb-item">
                        <a href="<?= get_category_link(get_the_category()[0]->term_id); ?>">
                            <?= get_the_category()[0]->name; ?>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="breadcrumb-item active">
                    <?= get_the_title(); ?>
                </li>
            <?php elseif (is_page()) : ?>
                <?php global $post; ?>
                <?php if ($post->post_parent) : ?>
                    <li class="breadcrumb-item">
                        <a href="<?= get_permalink($post->post_parent); ?>">
                            <?= get_the_title($post->post_parent); ?>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="breadcrumb-item active">
                    <?= get_the_title(); ?>
                </li>
            <?php endif; ?>
        </ol>

    </nav>
    <?php
    return ob_get_clean();
}
add_shortcode('breadcrumbs', 'breadcrumbs');
