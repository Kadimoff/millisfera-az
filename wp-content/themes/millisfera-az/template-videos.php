<?php
/*
Template Name: Video Səhifəsi
*/
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$paged = max(1, (int) get_query_var('paged'));
$video_term = millisfera_video_category();
$args = [
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 12,
    'paged' => $paged,
    'ignore_sticky_posts' => true,
];

if ($video_term instanceof WP_Term) {
    $args['cat'] = (int) $video_term->term_id;
}

$video_query = new WP_Query($args);
?>
<div class="container">
    <header class="page-head">
        <h1>Video Xəbərlər</h1>
        <p>Ən son video reportajlar və xəbər görüntüləri.</p>
    </header>

    <section class="video-section">
        <div class="video-grid" style="grid-template-columns:repeat(3,minmax(0,1fr));">
            <?php if ($video_query->have_posts()) :
                foreach ($video_query->posts as $video_post) : ?>
                    <article class="video-card">
                        <a href="<?php echo esc_url(get_permalink($video_post)); ?>">
                            <figure class="thumb">
                                <?php
                                if (has_post_thumbnail($video_post)) {
                                    echo get_the_post_thumbnail($video_post, 'millisfera_card', ['loading' => 'lazy']);
                                } else {
                                    ?>
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/fallback.svg'); ?>" alt="<?php echo esc_attr(get_the_title($video_post)); ?>" loading="lazy">
                                    <?php
                                }
                                ?>
                                <span class="video-badge">▶ Video</span>
                            </figure>
                        </a>
                        <div class="card-content">
                            <h3><a href="<?php echo esc_url(get_permalink($video_post)); ?>"><?php echo esc_html(get_the_title($video_post)); ?></a></h3>
                        </div>
                    </article>
                <?php endforeach;
            else : ?>
                <p>Video məzmun tapılmadı.</p>
            <?php endif; ?>
        </div>
    </section>

    <div class="pagination" style="margin-top:1rem;">
        <?php
        echo wp_kses_post(paginate_links([
            'total' => (int) $video_query->max_num_pages,
            'current' => $paged,
            'prev_text' => '←',
            'next_text' => '→',
        ]));
        ?>
    </div>
</div>
<?php
wp_reset_postdata();
get_footer();
