<form method="get" action="<?= esc_url(home_url('/')); ?>" class="form-inline">
    <div class="form-group">
        <label for="s" class="sr-only"><?php _e('Hledat', 'hiko'); ?></label>
        <input type="text" class="form-control form-control-sm" name="s" placeholder="<?php _e('Hledat', 'hiko'); ?>">
        <input type="submit" class="btn btn-sm btn-outline-primary" name="submit">
    </div>
</form>
