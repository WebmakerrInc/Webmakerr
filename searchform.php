<form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative" role="search">
    <label class="screen-reader-text" for="webmakerr-search-field"><?php esc_html_e('Search for:', 'webmakerr'); ?></label>
    <input
        type="search"
        id="webmakerr-search-field"
        name="s"
        class="border border-dark/10 px-4 py-2 text-sm rounded-full"
        value="<?php echo esc_attr(get_search_query()); ?>"
        placeholder="<?php esc_attr_e('Search', 'webmakerr'); ?>"
    >
    <button type="submit" class="absolute right-2 top-2" aria-label="<?php esc_attr_e('Submit search', 'webmakerr'); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="text-dark/70 size-5" aria-hidden="true">
            <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
        </svg>
    </button>
</form>
