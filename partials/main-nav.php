<?php
$menu_items = wp_get_nav_menu_items(get_nav_menu_locations()['main-menu']);
?>
<div x-data="{ miniSearchOpen: false, mobileMenuOpen: false, searchOpen: false }" class="relative bg-white">
    <div class="flex flex-wrap items-start justify-between w-full p-5 shadow-md xl:items-end">
        <a href="<?= home_url() ?>" class="flex items-center py-2 mr-6">
            <img src="<?= get_template_directory_uri() . '/assets/img/logo.png'; ?>" alt="<?= bloginfo('name') ?>" class="hidden w-16 h-auto mr-6 sm:block">
            <div class="w-40 text-xl">
                <span class="block text-red-700">
                    <?php _e('Historická korespondence', 'hiko'); ?>
                </span>
                <span class="block">
                    <?php _e('online', 'hiko'); ?>
                </span>
            </div>
        </a>
        <button class="p-2 border text-brown-dark border-brown-dark xl:hidden" @click="mobileMenuOpen = !mobileMenuOpen">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <nav class="hidden xl:flex xl:items-center">
            <ul class="flex flex-col h-full xl:items-end xl:justify-end xl:flex-row">
                <?php foreach ((array) $menu_items as $item) : ?>
                    <li class="p-3">
                        <?php if (($item->type !== 'taxonomy' && $item->object_id == get_the_ID()) || ($item->type === 'taxonomy' && single_cat_title('', false) === $item->title)) : ?>
                            <a class="text-sm text-red-700" href="<?= $item->url; ?>" <?= !empty($item->target) ? 'target="' . esc_attr($item->target) . '"' : '' ?>>
                                <?= $item->title; ?>
                            </a>
                        <?php else : ?>
                            <a class="text-sm hover:text-red-700" href="<?= $item->url; ?>" <?= !empty($item->target) ? 'target="' . esc_attr($item->target) . '"' : '' ?>>
                                <?= $item->title; ?>
                            </a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
                <li class="p-3">
                    <button type="button" @click="searchOpen = !searchOpen" class="flex w-5 text-sm cursor-pointer text-brown-dark hover:text-red-700">
                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                        </svg>
                    </button>
                </li>
                <li class="p-3">
                    <?= language_switcher(); ?>
                </li>
            </ul>
        </nav>
        <div x-show="searchOpen" class="w-full py-4 mx-auto" style="display:none;">
            <form>
                <label for="search" class="sr-only"><?php _e('Hledat', 'hiko'); ?></label>
                <input type="search" name="s" id="search" placeholder="<?php _e('Hledat', 'hiko'); ?>" autofocus class="w-full p-2 text-xl transition appearance-none lg:text-2xl ring-1 ring-brown-dark ring-opacity-50">
            </form>
        </div>
    </div>
    <div x-show="mobileMenuOpen" x-transition:enter="duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="duration-100 ease-in" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute inset-x-0 top-0 px-6 pb-6 transition origin-top-right transform bg-white shadow-md xl:hidden" style="display: none;">
        <div class="flex items-start justify-between my-4">
            <a href="<?= home_url() ?>" class="w-40 mr-6 text-lg">
                <span class="block text-red-700">
                    <?php _e('Historická korespondence', 'hiko'); ?>
                </span>
                <span class="block">
                    <?php _e('online', 'hiko'); ?>
                </span>
            </a>
            <button class="p-2 border text-brown-dark border-brown-dark" @click="mobileMenuOpen = !mobileMenuOpen">
                <span class="sr-only">Close menu</span>
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav class="flex flex-col">
            <?php foreach ($menu_items as $item) : ?>
                <a href="<?= $item->url; ?>" class="block py-2 text-sm hover:text-red-700" <?= $item->target; ?>>
                    <?= $item->title; ?>
                </a>
            <?php endforeach; ?>
            <button type="button" @click="miniSearchOpen = !miniSearchOpen" class="flex w-5 py-2 text-sm cursor-pointer text-brown-dark hover:text-red-700">
                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                </svg>
            </button>
            <div>
            <?= language_switcher(); ?>
            </div>
        </nav>
        <div x-show="miniSearchOpen" class="w-full py-4 mx-auto" style="display:none;">
            <form>
                <label for="search" class="sr-only"><?php _e('Hledat', 'hiko'); ?></label>
                <input type="search" name="s" id="search" placeholder="<?php _e('Hledat', 'hiko'); ?>" autofocus class="w-full p-2 text-xl transition appearance-none lg:text-2xl ring-1 ring-brown-dark ring-opacity-50">
            </form>
        </div>
    </div>
</div>
