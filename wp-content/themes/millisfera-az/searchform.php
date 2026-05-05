<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="sr-only" for="search-field">Axtar</label>
    <input id="search-field" type="search" placeholder="Xəbər axtar..." value="<?php echo esc_attr(get_search_query()); ?>" name="s">
    <button type="submit">Axtar</button>
</form>
