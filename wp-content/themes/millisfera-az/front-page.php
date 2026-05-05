<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$latest_query = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 10,
    'ignore_sticky_posts' => true,
]);
$latest_posts = $latest_query->posts;
$exclude_ids = array_map('intval', wp_list_pluck($latest_posts, 'ID'));
$hero_logo_html = has_custom_logo()
    ? get_custom_logo()
    : '<a class="hero-logo-text" href="' . esc_url(home_url('/')) . '">' . esc_html(get_bloginfo('name')) . '</a>';
?>
<div class="container">
    <?php if (!empty($latest_posts)) : ?>
        <section class="breaking" aria-label="Son dəqiqə">
            <div class="breaking-label">Son Dəqiqə</div>
            <div class="breaking-track-wrap">
                <div class="breaking-track">
                    <?php
                    $rolling_ids = array_merge($exclude_ids, $exclude_ids);
                    $total = count($rolling_ids);
                    foreach ($rolling_ids as $i => $post_id) {
                        printf(
                            '<a href="%1$s">%2$s</a>',
                            esc_url(get_permalink($post_id)),
                            esc_html(get_the_title($post_id))
                        );
                        if ($i < $total - 1) {
                            echo '<span class="breaking-sep" aria-hidden="true">·</span>';
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="hero-rotator" data-hero-slider data-interval="2000" aria-label="Son paylaşılan xəbərlər">
            <div class="hero-slider-viewport">
                <?php foreach ($latest_posts as $index => $slide_post) :
                    $slide_category = millisfera_primary_category_link((int) $slide_post->ID);
                    ?>
                    <article class="hero-slide<?php echo $index === 0 ? ' is-active' : ''; ?>" data-slide>
                        <div class="hero-slide-card">
                            <a class="hero-slide-media" href="<?php echo esc_url(get_permalink($slide_post)); ?>" aria-label="<?php echo esc_attr(get_the_title($slide_post)); ?>">
                                <figure>
                                    <?php
                                    if (has_post_thumbnail($slide_post)) {
                                        echo get_the_post_thumbnail($slide_post, 'full', ['loading' => $index === 0 ? 'eager' : 'lazy']);
                                    } else {
                                        ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/fallback.svg'); ?>" alt="<?php echo esc_attr(get_the_title($slide_post)); ?>" loading="lazy">
                                        <?php
                                    }
                                    ?>
                                </figure>
                            </a>
                            <div class="hero-slide-content">
                                <a class="kicker" href="<?php echo esc_url($slide_category['url']); ?>"><?php echo esc_html($slide_category['name']); ?></a>
                                <h2><a href="<?php echo esc_url(get_permalink($slide_post)); ?>"><?php echo esc_html(get_the_title($slide_post)); ?></a></h2>
                                <p><?php echo esc_html(wp_trim_words(get_the_excerpt($slide_post), 22)); ?></p>
                                <div class="meta">
                                    <span><?php echo esc_html(millisfera_format_date((int) get_post_time('U', false, $slide_post))); ?></span>
                                    <span><?php echo esc_html(millisfera_read_time((int) $slide_post->ID)); ?> dəq oxu</span>
                                </div>
                            </div>
                            <div class="hero-logo-badge" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                <?php echo wp_kses_post($hero_logo_html); ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>

                <button type="button" class="hero-nav hero-nav-prev" data-slide-prev aria-label="Əvvəlki xəbər">‹</button>
                <button type="button" class="hero-nav hero-nav-next" data-slide-next aria-label="Növbəti xəbər">›</button>
            </div>

            <div class="hero-slider-dots" aria-label="Slider nəzarəti">
                <?php foreach ($latest_posts as $index => $slide_post) : ?>
                    <button
                        type="button"
                        class="hero-dot<?php echo $index === 0 ? ' is-active' : ''; ?>"
                        data-slide-dot="<?php echo esc_attr((string) $index); ?>"
                        aria-label="<?php echo esc_attr(($index + 1) . '. xəbər'); ?>"
                    ></button>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; wp_reset_postdata(); ?>

    <?php
    $category_sections = millisfera_top_categories(12);
    foreach ($category_sections as $category) :
        $category_query = new WP_Query([
            'post_type' => 'post',
            'post_status' => 'publish',
            'cat' => (int) $category->term_id,
            'posts_per_page' => 9,
            'ignore_sticky_posts' => true,
        ]);

        if (!$category_query->have_posts()) {
            continue;
        }

        $category_posts = $category_query->posts;
        $exclude_ids = array_merge($exclude_ids, array_map('intval', wp_list_pluck($category_posts, 'ID')));
        $has_carousel = count($category_posts) > 3;
        ?>
        <section class="section category-section" <?php echo $has_carousel ? 'data-category-carousel data-interval="3200"' : ''; ?>>
            <header class="section-head">
                <h2><?php echo esc_html($category->name); ?></h2>
                <a href="<?php echo esc_url(get_category_link($category)); ?>">Hamısını gör</a>
            </header>

            <div class="category-carousel" aria-label="<?php echo esc_attr($category->name); ?>">
                <div class="category-news-grid" data-category-track>
                    <?php foreach ($category_posts as $category_post) : ?>
                        <div class="category-card-frame" data-category-item>
                            <?php millisfera_render_post_card($category_post, 'compact'); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
        wp_reset_postdata();
    endforeach;

    $feed_query = new WP_Query([
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 12,
        'paged' => 1,
        'ignore_sticky_posts' => true,
    ]);
    ?>
    <section class="section news-stream-section" aria-label="Son xəbərlər axını">
        <header class="section-head">
            <h2>Xəbər axını</h2>
        </header>

        <div
            class="feed-grid"
            data-infinite-feed
            data-page="1"
            data-max-pages="<?php echo esc_attr((string) $feed_query->max_num_pages); ?>"
            data-exclude=""
        >
            <?php if ($feed_query->have_posts()) :
                foreach ($feed_query->posts as $feed_post) {
                    millisfera_render_post_card($feed_post, 'compact');
                }
            endif; ?>
        </div>

        <div class="feed-status" data-feed-status aria-live="polite"></div>
        <?php if ((int) $feed_query->max_num_pages > 1) : ?>
            <div class="infinite-sentinel" data-infinite-sentinel></div>
        <?php endif; ?>
    </section>
    <?php wp_reset_postdata(); ?>
</div>
<?php
get_footer();
