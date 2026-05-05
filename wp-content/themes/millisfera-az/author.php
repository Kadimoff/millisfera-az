<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
$author = get_queried_object();
?>
<div class="container author-layout">
    <section>
        <header class="page-head">
            <h1><?php echo esc_html($author->display_name ?? 'Yazar'); ?></h1>
            <p><?php echo esc_html(get_the_author_meta('description', (int) ($author->ID ?? 0)) ?: 'Yazar haqqında məlumat əlavə olunmayıb.'); ?></p>
            <div style="margin-top:.7rem;"><?php echo get_avatar((int) ($author->ID ?? 0), 88); ?></div>
        </header>

        <div class="archive-list">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php millisfera_render_post_card(get_post(), 'large'); ?>
            <?php endwhile; else : ?>
                <p>Bu yazara aid məzmun tapılmadı.</p>
            <?php endif; ?>
        </div>

        <div class="pagination"><?php the_posts_pagination(['mid_size' => 1]); ?></div>
    </section>

    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
