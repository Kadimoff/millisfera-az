<?php
if (!defined('ABSPATH')) {
    exit;
}

function millisfera_format_date(int $timestamp = 0): string
{
    $time = $timestamp > 0 ? $timestamp : get_post_time('U');

    return wp_date('d M Y, H:i', $time);
}

function millisfera_primary_category_link(int $post_id = 0): array
{
    $post_id = $post_id ?: get_the_ID();
    $categories = get_the_category($post_id);

    if (empty($categories)) {
        return [
            'name' => 'Xəbər',
            'url' => home_url('/'),
        ];
    }

    return [
        'name' => $categories[0]->name,
        'url' => get_category_link($categories[0]),
    ];
}

function millisfera_read_time(int $post_id = 0): int
{
    $post_id = $post_id ?: get_the_ID();
    $content = (string) get_post_field('post_content', $post_id);
    $word_count = str_word_count(wp_strip_all_tags($content));

    return max(1, (int) ceil($word_count / 220));
}

function millisfera_top_categories(int $limit = 9): array
{
    $preferred_slugs = [
        'umumi',
        'siyaset',
        'iqtisadiyyat',
        'kriminal',
        'dunya',
        'ozal',
        'reportaj',
        'cemiyyet',
        'idman',
        'medeniyyet-sou',
        'hadise',
        'media',
    ];

    $categories = [];
    foreach ($preferred_slugs as $slug) {
        $term = get_term_by('slug', $slug, 'category');
        if ($term instanceof WP_Term && (int) $term->count > 0) {
            $categories[] = $term;
        }
    }

    if (count($categories) < $limit) {
        $seen = array_map(static fn(WP_Term $term): int => (int) $term->term_id, $categories);
        $fallback = get_categories([
            'hide_empty' => true,
            'orderby' => 'count',
            'order' => 'DESC',
            'number' => $limit,
            'exclude' => $seen,
        ]);

        $categories = array_merge($categories, $fallback);
    }

    return array_slice($categories, 0, $limit);
}

function millisfera_sports_category(): ?WP_Term
{
    $slugs = ['idman', 'spor', 'sport'];

    foreach ($slugs as $slug) {
        $term = get_term_by('slug', $slug, 'category');
        if ($term instanceof WP_Term) {
            return $term;
        }
    }

    return null;
}

function millisfera_video_category(): ?WP_Term
{
    $slugs = ['video', 'videolar'];

    foreach ($slugs as $slug) {
        $term = get_term_by('slug', $slug, 'category');
        if ($term instanceof WP_Term) {
            return $term;
        }
    }

    return null;
}

function millisfera_render_post_card(WP_Post $post, string $size = 'compact'): void
{
    $category = millisfera_primary_category_link((int) $post->ID);
    $thumbnail_size = 'millisfera_card';

    if ($size === 'large') {
        $thumbnail_size = 'large';
    } elseif ($size === 'hero') {
        $thumbnail_size = 'full';
    }
    ?>
    <article <?php post_class('card', $post->ID); ?>>
        <a href="<?php echo esc_url(get_permalink($post)); ?>" aria-label="<?php echo esc_attr(get_the_title($post)); ?>">
            <figure class="thumb">
                <?php
                if (has_post_thumbnail($post)) {
                    echo get_the_post_thumbnail($post, $thumbnail_size, ['loading' => 'lazy']);
                } else {
                    ?>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/fallback.svg'); ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>" loading="lazy">
                    <?php
                }
                ?>
            </figure>
        </a>
        <div class="card-content">
            <a class="kicker" href="<?php echo esc_url($category['url']); ?>"><?php echo esc_html($category['name']); ?></a>
            <h3><a href="<?php echo esc_url(get_permalink($post)); ?>"><?php echo esc_html(get_the_title($post)); ?></a></h3>
            <div class="meta">
                <span><?php echo esc_html(millisfera_format_date((int) get_post_time('U', false, $post))); ?></span>
                <span><?php echo esc_html(millisfera_read_time((int) $post->ID)); ?> dəq oxu</span>
            </div>
        </div>
    </article>
    <?php
}
