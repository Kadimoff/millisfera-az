<?php
if (!defined('ABSPATH')) {
    exit;
}

$top_categories = millisfera_top_categories(12);
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
      (function () {
        try {
          var stored = localStorage.getItem('millisfera-theme');
          var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
          var theme = stored || (prefersDark ? 'dark' : 'light');
          document.documentElement.setAttribute('data-theme', theme);
        } catch (e) {}
      })();
    </script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="reading-progress" data-reading-progress></div>
<header class="site-header">
    <div class="utility-bar">
        <div class="container utility-bar-inner">
            <div><?php echo esc_html(wp_date('d F Y, l')); ?></div>
            <div class="utility-links">
                <span class="utility-pill">Canlı xəbər axını</span>
                <a href="<?php echo esc_url(home_url('/haqqimizda')); ?>">Haqqımızda</a>
                <a href="<?php echo esc_url(home_url('/elaqe')); ?>">Əlaqə</a>
                <a href="<?php echo esc_url(home_url('/reklam')); ?>">Reklam</a>
            </div>
        </div>
    </div>
    <div class="container main-bar">
        <div class="branding">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo-link" aria-label="<?php bloginfo('name'); ?> – Ana səhifə">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo.png'); ?>" alt="<?php bloginfo('name'); ?>" class="site-logo site-logo--light" loading="eager">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo-dark.png'); ?>" alt="<?php bloginfo('name'); ?>" class="site-logo site-logo--dark" loading="eager">
            </a>
        </div>

        <nav class="main-nav" aria-label="Əsas menyu">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => '',
                    'fallback_cb' => false,
                    'depth' => 1,
                ]);
            } else {
                foreach ($top_categories as $category) {
                    printf(
                        '<a href="%1$s">%2$s</a>',
                        esc_url(get_category_link($category)),
                        esc_html($category->name)
                    );
                }
            }
            ?>
        </nav>

        <div class="header-actions">
            <button class="icon-btn theme-toggle" type="button" data-theme-toggle aria-label="Qaranlıq rejimi aktiv et">◐</button>
            <button class="icon-btn" type="button" data-search-toggle aria-label="Axtarış aç" aria-expanded="false">⌕</button>
            <button class="icon-btn" type="button" data-menu-toggle aria-expanded="false" aria-label="Menyu aç">☰</button>
        </div>
    </div>

    <div class="mobile-drawer" data-mobile-drawer>
        <div class="container">
            <nav class="drawer-nav" aria-label="Mobil menyu">
                <a class="drawer-link" href="<?php echo esc_url(home_url('/haqqimizda')); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    Haqqımızda
                </a>
                <a class="drawer-link" href="<?php echo esc_url(home_url('/elaqe')); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.22 1.18 2 2 0 012.22 0h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.91 7.91a16 16 0 006.18 6.18l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                    Əlaqə
                </a>
                <a class="drawer-link" href="<?php echo esc_url(home_url('/reklam')); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                    Reklam
                </a>
                <a class="drawer-link" href="<?php echo esc_url(home_url('/redaksiya')); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                    Redaksiya heyyəti
                </a>
            </nav>
        </div>
    </div>
</header>

<div class="search-overlay" data-search-overlay aria-hidden="true" role="dialog" aria-modal="true" aria-label="Axtarış">
    <div class="search-overlay-backdrop" data-search-backdrop></div>
    <div class="search-overlay-box">
        <form class="search-overlay-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <button class="search-overlay-close" type="button" data-search-close aria-label="Bağla">✕</button>
            <input
                class="search-overlay-input"
                type="search"
                name="s"
                placeholder="Xəbər axtar..."
                autocomplete="off"
                autocorrect="off"
                spellcheck="false"
                data-search-input
            >
            <button class="search-overlay-submit" type="submit" aria-label="Axtar">⌕</button>
        </form>
    </div>
</div>

<main class="site-main">
