<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<div class="container archive-layout">
    <section>
        <header class="archive-head">
            <div class="archive-head-text">
                <h1><?php the_archive_title(); ?></h1>
                <p>Son yenilənmə: <?php echo esc_html(wp_date('d M Y, H:i')); ?></p>
                <?php the_archive_description('<div>', '</div>'); ?>
            </div>
            <div class="archive-weather" data-weather-archive data-city="Baku,AZ" aria-label="Bakı hava məlumatı">
                <div class="aw-icon" data-aw-icon aria-hidden="true">
                    <span class="aw-sun-body"></span>
                    <span class="aw-sun-rays"></span>
                </div>
                <div class="aw-data">
                    <strong class="aw-temp" data-aw-temp>--°</strong>
                    <span class="aw-desc" data-aw-desc>Bakı</span>
                </div>
            </div>
        </header>

        <div class="archive-list">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php millisfera_render_post_card(get_post(), 'large'); ?>
            <?php endwhile; else : ?>
                <p>Bu bölmədə məzmun tapılmadı.</p>
            <?php endif; ?>
        </div>

        <div class="pagination"><?php the_posts_pagination(['mid_size' => 1]); ?></div>
    </section>

    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
