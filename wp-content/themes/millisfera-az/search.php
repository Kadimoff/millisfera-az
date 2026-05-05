<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<div class="container search-layout">
    <section>
        <header class="page-head">
            <h1>Axtarış nəticələri</h1>
            <p>"<?php echo esc_html(get_search_query()); ?>" üçün nəticələr.</p>
            <?php get_search_form(); ?>
        </header>

        <div class="archive-list">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php millisfera_render_post_card(get_post(), 'compact'); ?>
            <?php endwhile; else : ?>
                <p>Axtardığınız sözə uyğun nəticə tapılmadı.</p>
            <?php endif; ?>
        </div>

        <div class="pagination"><?php the_posts_pagination(['mid_size' => 1]); ?></div>
    </section>

    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
