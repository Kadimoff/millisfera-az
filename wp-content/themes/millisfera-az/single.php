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
                <a class="share-wa" target="_blank" rel="noopener" href="https://wa.me/?text=<?php echo rawurlencode(get_the_title() . ' ' . get_permalink()); ?>">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                    <span>WhatsApp</span>
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
            $related_posts = $related_query->posts;

            if (count($related_posts) < 3) {
                $fallback_query = new WP_Query([
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 3 - count($related_posts),
                    'post__not_in' => array_merge([get_the_ID()], wp_list_pluck($related_posts, 'ID')),
                    'ignore_sticky_posts' => true,
                ]);
                $related_posts = array_merge($related_posts, $fallback_query->posts);
                wp_reset_postdata();
            }

            if (!empty($related_posts)) :
                ?>
                <section class="section">
                    <header class="section-head">
                        <h2>Oxşar xəbərlər</h2>
                    </header>
                    <div class="feed-grid">
                        <?php foreach ($related_posts as $related_post) {
                            millisfera_render_post_card($related_post, 'compact');
                        } ?>
                    </div>
                </section>
            <?php endif; wp_reset_postdata(); ?>
        <?php endwhile; ?>
    </section>

    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
