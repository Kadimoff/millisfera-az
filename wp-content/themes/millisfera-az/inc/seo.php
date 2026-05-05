<?php
if (!defined('ABSPATH')) {
    exit;
}

// ── Title separator ───────────────────────────────────────────────────────────
add_filter('document_title_separator', static fn(): string => '—');

add_filter('document_title_parts', function (array $parts): array {
    if (!is_front_page()) {
        $parts['site'] = get_bloginfo('name');
    }
    return $parts;
});

// ── Main SEO head output ──────────────────────────────────────────────────────
function millisfera_seo_head(): void
{
    if (is_admin()) {
        return;
    }

    global $post;

    $site_name    = get_bloginfo('name');
    $site_url     = home_url('/');
    $fallback_img = get_template_directory_uri() . '/assets/fallback.svg';

    if (is_singular() && $post instanceof WP_Post) {
        $ctx = [
            'type'      => 'article',
            'title'     => get_the_title($post),
            'desc'      => millisfera_seo_description($post),
            'url'       => (string) get_permalink($post),
            'image'     => millisfera_seo_image($post, $fallback_img),
            'published' => get_the_date('c', $post),
            'modified'  => get_the_modified_date('c', $post),
            'author'    => get_the_author_meta('display_name', (int) $post->post_author),
            'section'   => millisfera_primary_category_link((int) $post->ID)['name'],
            'keywords'  => millisfera_seo_keywords($post),
        ];
    } elseif (is_category() || is_tag() || is_tax()) {
        $term = get_queried_object();
        $name = $term instanceof WP_Term ? $term->name : '';
        $raw  = $term instanceof WP_Term ? wp_strip_all_tags($term->description) : '';
        $ctx  = [
            'type'     => 'website',
            'title'    => $name,
            'desc'     => $raw ?: ($name . ' kateqoriyasındakı son xəbərlər — ' . $site_name),
            'url'      => $term instanceof WP_Term ? (string) get_term_link($term) : $site_url,
            'image'    => $fallback_img,
            'keywords' => array_filter([$name, $site_name, 'xəbər']),
        ];
    } elseif (is_home() || is_front_page()) {
        $ctx = [
            'type'     => 'website',
            'title'    => $site_name,
            'desc'     => get_bloginfo('description') ?: $site_name . ' — Son xəbərlər, analiz, video.',
            'url'      => $site_url,
            'image'    => $fallback_img,
            'keywords' => [$site_name, 'xəbər', 'son xəbər', 'Azərbaycan xəbərləri'],
        ];
    } elseif (is_page() && $post instanceof WP_Post) {
        $ctx = [
            'type'     => 'website',
            'title'    => get_the_title($post),
            'desc'     => millisfera_seo_description($post),
            'url'      => (string) get_permalink($post),
            'image'    => millisfera_seo_image($post, $fallback_img),
            'keywords' => [$site_name, get_the_title($post)],
        ];
    } else {
        return;
    }

    $desc     = mb_strimwidth(trim($ctx['desc']), 0, 160, '…');
    $keywords = implode(', ', array_unique(array_filter((array) ($ctx['keywords'] ?? []))));
    $og_title = $ctx['title'] . ($ctx['title'] !== $site_name ? ' — ' . $site_name : '');

    echo "\n<!-- SEO: Millisfera AZ -->\n";

    // Basic
    if ($desc)     printf('<meta name="description" content="%s">' . "\n", esc_attr($desc));
    if ($keywords) printf('<meta name="keywords" content="%s">' . "\n", esc_attr($keywords));
    printf('<link rel="canonical" href="%s">' . "\n", esc_url($ctx['url']));
    echo '<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">' . "\n";

    // Open Graph
    printf('<meta property="og:type" content="%s">' . "\n",        esc_attr($ctx['type']));
    printf('<meta property="og:title" content="%s">' . "\n",       esc_attr($og_title));
    printf('<meta property="og:description" content="%s">' . "\n", esc_attr($desc));
    printf('<meta property="og:url" content="%s">' . "\n",         esc_url($ctx['url']));
    printf('<meta property="og:site_name" content="%s">' . "\n",   esc_attr($site_name));
    echo '<meta property="og:locale" content="az_AZ">' . "\n";
    printf('<meta property="og:image" content="%s">' . "\n",       esc_url($ctx['image']));
    echo '<meta property="og:image:width" content="1200">' . "\n";
    echo '<meta property="og:image:height" content="675">' . "\n";

    // Article-specific OG
    if ($ctx['type'] === 'article' && isset($ctx['published'])) {
        printf('<meta property="article:published_time" content="%s">' . "\n", esc_attr($ctx['published']));
        printf('<meta property="article:modified_time" content="%s">' . "\n",  esc_attr($ctx['modified'] ?? ''));
        if (!empty($ctx['author']))  printf('<meta property="article:author" content="%s">' . "\n",  esc_attr($ctx['author']));
        if (!empty($ctx['section'])) printf('<meta property="article:section" content="%s">' . "\n", esc_attr($ctx['section']));
        foreach (get_the_tags($post->ID) ?: [] as $tag) {
            printf('<meta property="article:tag" content="%s">' . "\n", esc_attr($tag->name));
        }
    }

    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    printf('<meta name="twitter:title" content="%s">' . "\n",       esc_attr($og_title));
    printf('<meta name="twitter:description" content="%s">' . "\n", esc_attr($desc));
    printf('<meta name="twitter:image" content="%s">' . "\n",       esc_url($ctx['image']));

    echo "<!-- /SEO -->\n\n";

    // JSON-LD
    millisfera_seo_jsonld($ctx, $post ?? null, $site_name, $site_url);
}
add_action('wp_head', 'millisfera_seo_head', 1);

// ── Helpers ───────────────────────────────────────────────────────────────────

function millisfera_seo_description(WP_Post $post): string
{
    if (!empty($post->post_excerpt)) {
        return wp_strip_all_tags($post->post_excerpt);
    }

    $text = wp_strip_all_tags(
        apply_filters('the_content', $post->post_content)
    );
    $text = preg_replace('/\s+/', ' ', $text) ?? '';

    return trim(mb_strimwidth($text, 0, 220, ''));
}

function millisfera_seo_image(WP_Post $post, string $fallback): string
{
    if (has_post_thumbnail($post->ID)) {
        $src = wp_get_attachment_image_src(
            (int) get_post_thumbnail_id($post->ID),
            'millisfera_hero'
        );
        if ($src && !empty($src[0])) {
            return $src[0];
        }
    }

    // First image in content
    if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $post->post_content, $m)) {
        return $m[1];
    }

    return $fallback;
}

function millisfera_seo_keywords(WP_Post $post): array
{
    $kw = [];

    // WP tags
    foreach (get_the_tags($post->ID) ?: [] as $tag) {
        $kw[] = $tag->name;
    }

    // Categories
    foreach (get_the_category($post->ID) ?: [] as $cat) {
        $kw[] = $cat->name;
    }

    // Site name
    $kw[] = get_bloginfo('name');

    // Significant title words
    $stopwords = millisfera_seo_stopwords();
    foreach (preg_split('/\s+/', $post->post_title) ?: [] as $word) {
        $word = trim($word, '.,!?:;-"\'«»()[]{}');
        if (mb_strlen($word) > 3 && !in_array(mb_strtolower($word), $stopwords, true)) {
            $kw[] = $word;
        }
    }

    // Auto-extracted from content
    foreach (millisfera_seo_extract_keywords($post->post_content, 8) as $w) {
        $kw[] = $w;
    }

    return array_unique(array_filter($kw));
}

function millisfera_seo_extract_keywords(string $content, int $limit = 8): array
{
    $text  = wp_strip_all_tags($content);
    $text  = mb_strtolower($text);
    $text  = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $text) ?? '';
    $words = preg_split('/\s+/', $text) ?: [];
    $stop  = millisfera_seo_stopwords();
    $freq  = [];

    foreach ($words as $w) {
        $w = trim($w);
        if (mb_strlen($w) > 3 && !in_array($w, $stop, true)) {
            $freq[$w] = ($freq[$w] ?? 0) + 1;
        }
    }

    arsort($freq);

    return array_keys(array_slice($freq, 0, $limit, true));
}

function millisfera_seo_stopwords(): array
{
    return [
        // Azerbaijani
        'ilə', 'üçün', 'haqqında', 'bunun', 'onun', 'onlar', 'bizim', 'sizin',
        'olan', 'oldu', 'olub', 'edir', 'etdi', 'edildi', 'olacaq', 'deyib',
        'üzrə', 'kimi', 'belə', 'isə', 'daha', 'çox', 'bütün', 'hər', 'həm',
        'ancaq', 'lakin', 'amma', 'çünki', 'əgər', 'elə', 'artıq', 'yenə',
        'baxmayaraq', 'hətta', 'nəticə', 'barədə', 'ətraflı', 'həmçinin',
        // English (may appear in text)
        'that', 'this', 'with', 'from', 'have', 'they', 'will', 'been', 'were',
        'their', 'said', 'also', 'more', 'about', 'into', 'than', 'other',
    ];
}

// ── JSON-LD ───────────────────────────────────────────────────────────────────

function millisfera_seo_jsonld(array $ctx, ?WP_Post $post, string $site_name, string $site_url): void
{
    $logo_url = has_custom_logo()
        ? wp_get_attachment_image_url((int) get_theme_mod('custom_logo'), 'full')
        : null;

    $publisher = [
        '@type' => 'Organization',
        'name'  => $site_name,
        'url'   => $site_url,
    ];
    if ($logo_url) {
        $publisher['logo'] = ['@type' => 'ImageObject', 'url' => $logo_url];
    }

    if ($ctx['type'] === 'article' && $post instanceof WP_Post) {
        $schema = [
            '@context'         => 'https://schema.org',
            '@type'            => 'NewsArticle',
            'headline'         => mb_strimwidth($ctx['title'], 0, 110, '…'),
            'description'      => mb_strimwidth($ctx['desc'], 0, 160, '…'),
            'url'              => $ctx['url'],
            'datePublished'    => $ctx['published'],
            'dateModified'     => $ctx['modified'] ?? $ctx['published'],
            'author'           => ['@type' => 'Person', 'name' => $ctx['author'] ?? $site_name],
            'publisher'        => $publisher,
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => $ctx['url']],
            'inLanguage'       => 'az',
        ];

        if (!str_contains($ctx['image'], 'fallback')) {
            $schema['image'] = [
                '@type'  => 'ImageObject',
                'url'    => $ctx['image'],
                'width'  => 1200,
                'height' => 675,
            ];
        }

        $tags = get_the_tags($post->ID);
        if ($tags) {
            $schema['keywords'] = implode(', ', array_map(static fn($t) => $t->name, $tags));
        }

        if (!empty($ctx['section'])) {
            $schema['articleSection'] = $ctx['section'];
        }

        $word_count = str_word_count(wp_strip_all_tags($post->post_content));
        if ($word_count > 0) {
            $schema['wordCount'] = $word_count;
        }
    } else {
        $schema = [
            '@context'        => 'https://schema.org',
            '@type'           => 'WebSite',
            'name'            => $site_name,
            'url'             => $site_url,
            'description'     => $ctx['desc'],
            'inLanguage'      => 'az',
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => [
                    '@type'       => 'EntryPoint',
                    'urlTemplate' => $site_url . '?s={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    printf(
        '<script type="application/ld+json">%s</script>' . "\n",
        wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
    );
}
