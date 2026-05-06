<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<div class="container single-wrap">
    <section class="single-main">
        <?php while (have_posts()) : the_post();
            $category = millisfera_primary_category_link();
            $tags = get_the_tags();
            ?>
            <nav class="breadcrumb" aria-label="breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Ana səhifə</a>
                <span class="breadcrumb-sep" aria-hidden="true">/</span>
                <a href="<?php echo esc_url($category['url']); ?>"><?php echo esc_html($category['name']); ?></a>
                <span class="breadcrumb-sep" aria-hidden="true">/</span>
                <span><?php the_title(); ?></span>
            </nav>

            <a class="kicker" href="<?php echo esc_url($category['url']); ?>"><?php echo esc_html($category['name']); ?></a>
            <h1 class="single-title"><?php the_title(); ?></h1>

            <?php if (has_excerpt()) : ?>
                <p class="single-summary"><?php echo esc_html(get_the_excerpt()); ?></p>
            <?php endif; ?>

            <div class="meta">
                <span><?php the_author_posts_link(); ?></span>
                <span><?php echo esc_html(millisfera_format_date()); ?></span>
                <span>Yenilənmə: <?php echo esc_html(millisfera_format_date((int) get_post_modified_time('U'))); ?></span>
                <span><?php echo esc_html(millisfera_read_time()); ?> dəq oxu</span>
            </div>

            <?php if (has_post_thumbnail()) : ?>
                <figure class="single-hero">
                    <?php the_post_thumbnail('full', ['loading' => 'eager']); ?>
                </figure>
            <?php endif; ?>

            <div class="share-rail" aria-label="Paylaşım linkləri">
                <a class="share-fb" target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode(get_permalink()); ?>">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12.073h2.54V9.844c0-2.504 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562v1.902h2.773l-.443 2.89h-2.33v6.988C20.343 21.201 24 17.064 24 12.073z"/></svg>
                    <span>Facebook</span>
                </a>
                <a class="share-x" target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode(get_permalink()); ?>&text=<?php echo rawurlencode(get_the_title()); ?>">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    <span>X</span>
                </a>
                <a class="share-tg" target="_blank" rel="noopener" href="https://t.me/share/url?url=<?php echo rawurlencode(get_permalink()); ?>&text=<?php echo rawurlencode(get_the_title()); ?>">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor" aria-hidden="true"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.96 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                    <span>Telegram</span>
                </a>
            </div>

            <article class="post-content">
                <?php the_content(); ?>
            </article>

            <?php if (!empty($tags)) : ?>
                <div class="tag-list">
                    <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag)); ?>">#<?php echo esc_html($tag->name); ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <section class="author-box">
                <h3><?php the_author(); ?></h3>
                <p><?php echo esc_html(get_the_author_meta('description') ?: 'Müəllif bio məlumatı əlavə edilməyib.'); ?></p>
            </section>

            <div class="post-nav">
                <div><?php previous_post_link('%link', '← %title'); ?></div>
                <div><?php next_post_link('%link', '%title →'); ?></div>
            </div>

            <?php
            $related_query = new WP_Query([
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'post__not_in' => [get_the_ID()],
                'ignore_sticky_posts' => true,
                'category__in' => wp_get_post_categories(get_the_ID()),
            ]);

            if ($related_query->have_posts()) :
                ?>
                <section class="section">
                    <header class="section-head">
                        <h2>Oxşar xəbərlər</h2>
                    </header>
                    <div class="feed-grid">
                        <?php foreach ($related_query->posts as $related_post) {
                            millisfera_render_post_card($related_post, 'compact');
                        } ?>
                    </div>
                </section>
            <?php endif; wp_reset_postdata(); ?>

            <?php comments_template(); ?>
        <?php endwhile; ?>
    </section>

    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
