<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<div class="container archive-layout">
    <section>
        <header class="archive-head">
            <h1>Son xəbərlər</h1>
            <p>Redaksiyanın gündəlik yenilənən xəbər axını.</p>
        </header>

        <div class="archive-list">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php millisfera_render_post_card(get_post(), 'large'); ?>
            <?php endwhile; else : ?>
                <p>Hələlik məzmun tapılmadı.</p>
            <?php endif; ?>
        </div>

        <div class="pagination"><?php the_posts_pagination(['mid_size' => 1]); ?></div>
    </section>

    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
