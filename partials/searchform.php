<form method="get" action="<?= esc_url(home_url('/')); ?>" class="flex max-w-lg">
    <label for="s" class="sr-only">
        <?php _e('Hledat', 'hiko'); ?>
    </label>
    <input type="search" class="flex-1 p-3 overflow-hidden shadow" name="s" value="<?= esc_html(get_search_query()); ?>">
    <button type="submit" class="p-3 text-white shadow appearance-none bg-brown-dark">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" class="w-6" fill="currentColor">
            <path d="M3.5 0c-1.93 0-3.5 1.57-3.5 3.5s1.57 3.5 3.5 3.5c.59 0 1.17-.14 1.66-.41a1 1 0 0 0 .13.13l1 1a1.02 1.02 0 1 0 1.44-1.44l-1-1a1 1 0 0 0-.16-.13c.27-.49.44-1.06.44-1.66 0-1.93-1.57-3.5-3.5-3.5zm0 1c1.39 0 2.5 1.11 2.5 2.5 0 .66-.24 1.27-.66 1.72-.01.01-.02.02-.03.03a1 1 0 0 0-.13.13c-.44.4-1.04.63-1.69.63-1.39 0-2.5-1.11-2.5-2.5s1.11-2.5 2.5-2.5z" />
        </svg>
    </button>
</form>
