<?php
if (!defined('ABSPATH')) {
    exit;
}

require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/seo.php';

function millisfera_theme_setup(): void
{
    load_theme_textdomain('millisfera-az', get_template_directory() . '/languages');

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height' => 56,
        'width' => 220,
        'flex-height' => true,
        'flex-width' => true,
    ]);
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    add_image_size('millisfera_hero', 1200, 675, true);
    add_image_size('millisfera_card', 640, 400, true);
    add_image_size('millisfera_small', 480, 300, true);

    register_nav_menus([
        'primary' => 'Əsas menyu',
        'footer' => 'Footer menyu',
    ]);
}
add_action('after_setup_theme', 'millisfera_theme_setup');

function millisfera_remove_global_styles(): void
{
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
    remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
}
add_action('after_setup_theme', 'millisfera_remove_global_styles', 100);
add_filter('should_load_global_styles', '__return_false');

function millisfera_widgets_init(): void
{
    register_sidebar([
        'name' => 'Sağ panel',
        'id' => 'sidebar-main',
        'description' => 'Xəbər detalları və arxiv üçün sağ panel.',
        'before_widget' => '<section class="widget">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ]);
}
add_action('widgets_init', 'millisfera_widgets_init');

function millisfera_enqueue_assets(): void
{
    $style_file = get_stylesheet_directory() . '/style.css';
    $script_file = get_template_directory() . '/js/theme.js';

    wp_enqueue_style(
        'millisfera-style',
        get_stylesheet_uri(),
        [],
        file_exists($style_file) ? (string) filemtime($style_file) : null
    );

    wp_enqueue_script(
        'millisfera-script',
        get_template_directory_uri() . '/js/theme.js',
        [],
        file_exists($script_file) ? (string) filemtime($script_file) : null,
        true
    );

    wp_localize_script('millisfera-script', 'millisferaTheme', [
        'menuOpen' => 'Menyu aç',
        'menuClose' => 'Menyunu bağla',
        'themeToDark' => 'Qaranlıq rejimi aktiv et',
        'themeToLight' => 'İşıqlı rejimi aktiv et',
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('millisfera_nonce'),
        'weatherNonce' => wp_create_nonce('millisfera_weather'),
        'weatherCity' => getenv('OPENWEATHER_CITY') ?: 'Baku,AZ',
        'feedLoading' => 'Xəbərlər yüklənir...',
        'feedEnd' => 'Bütün xəbərlər göstərildi.',
    ]);
}
add_action('wp_enqueue_scripts', 'millisfera_enqueue_assets');

function millisfera_performance_tweaks(): void
{
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    add_filter('emoji_svg_url', '__return_false');
}
add_action('init', 'millisfera_performance_tweaks');

function millisfera_dequeue_block_assets(): void
{
    if (!is_admin()) {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('classic-theme-styles');
        remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
        remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
    }
}
add_action('wp_enqueue_scripts', 'millisfera_dequeue_block_assets', 100);

function millisfera_excerpt_length(): int
{
    return 22;
}
add_filter('excerpt_length', 'millisfera_excerpt_length', 999);

function millisfera_excerpt_more(): string
{
    return '...';
}
add_filter('excerpt_more', 'millisfera_excerpt_more');

function millisfera_ajax_load_more_posts(): void
{
    check_ajax_referer('millisfera_nonce', 'nonce');

    $page = isset($_POST['page']) ? max(1, absint($_POST['page'])) : 1;
    $exclude_raw = isset($_POST['exclude']) ? sanitize_text_field(wp_unslash($_POST['exclude'])) : '';
    $exclude_ids = array_filter(array_map('absint', explode(',', $exclude_raw)));

    $query = new WP_Query([
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 12,
        'paged' => $page,
        'ignore_sticky_posts' => true,
        'post__not_in' => $exclude_ids,
    ]);

    ob_start();
    if ($query->have_posts()) {
        foreach ($query->posts as $post) {
            millisfera_render_post_card($post, 'compact');
        }
    }
    $html = ob_get_clean();
    wp_reset_postdata();

    wp_send_json_success([
        'html' => $html,
        'count' => (int) $query->post_count,
    ]);
}
add_action('wp_ajax_millisfera_load_more_posts', 'millisfera_ajax_load_more_posts');
add_action('wp_ajax_nopriv_millisfera_load_more_posts', 'millisfera_ajax_load_more_posts');

function millisfera_ajax_weather(): void
{
    check_ajax_referer('millisfera_weather', 'nonce');

    $api_key = getenv('OPENWEATHER_API_KEY') ?: '';
    if ($api_key === '') {
        wp_send_json_error(['message' => 'OpenWeather API açarı tapılmadı.'], 500);
    }

    $city = isset($_GET['city'])
        ? sanitize_text_field(wp_unslash($_GET['city']))
        : (getenv('OPENWEATHER_CITY') ?: 'Baku,AZ');
    $city = $city !== '' ? $city : 'Baku,AZ';

    $cache_key = 'millisfera_weather_' . md5($city);
    $cached = get_transient($cache_key);
    if (is_array($cached)) {
        wp_send_json_success($cached);
    }

    $response = wp_remote_get(
        add_query_arg([
            'q' => $city,
            'appid' => $api_key,
            'units' => 'metric',
            'lang' => 'az',
        ], 'https://api.openweathermap.org/data/2.5/weather'),
        ['timeout' => 8]
    );

    if (is_wp_error($response)) {
        wp_send_json_error(['message' => $response->get_error_message()], 502);
    }

    $body = json_decode((string) wp_remote_retrieve_body($response), true);
    if (!is_array($body) || (int) ($body['cod'] ?? 0) !== 200) {
        wp_send_json_error(['message' => 'Hava məlumatı alınmadı.'], 502);
    }

    $main = $body['main'] ?? [];
    $weather = $body['weather'][0] ?? [];
    $wind = $body['wind'] ?? [];
    $payload = [
        'city'        => (string) ($body['name'] ?? $city),
        'temp'        => isset($main['temp'])       ? (int) round((float) $main['temp'])       : null,
        'feels_like'  => isset($main['feels_like']) ? (int) round((float) $main['feels_like']) : null,
        'humidity'    => isset($main['humidity'])   ? (int) $main['humidity']                  : null,
        'wind'        => isset($wind['speed'])      ? (int) round((float) $wind['speed'] * 3.6) : null,
        'description' => ucfirst((string) ($weather['description'] ?? 'Hava')),
        'icon_code'   => (string) ($weather['icon'] ?? ''),
        'updated'     => wp_date('H:i'),
    ];

    set_transient($cache_key, $payload, 10 * MINUTE_IN_SECONDS);
    wp_send_json_success($payload);
}
add_action('wp_ajax_millisfera_weather', 'millisfera_ajax_weather');
add_action('wp_ajax_nopriv_millisfera_weather', 'millisfera_ajax_weather');
