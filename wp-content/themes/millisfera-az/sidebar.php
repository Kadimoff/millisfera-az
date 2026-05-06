<?php
if (!defined('ABSPATH')) {
    exit;
}

$trending = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'orderby' => 'comment_count',
    'order' => 'DESC',
    'ignore_sticky_posts' => true,
]);
$newsletter_status = isset($_GET['newsletter_status']) ? sanitize_key(wp_unslash($_GET['newsletter_status'])) : '';
?>
<aside class="sidebar-sticky">
    <section class="widget widget-weather">
        <div class="sidebar-weather" data-weather-sidebar data-city="Baku,AZ" aria-label="Bakı hava məlumatı">
            <div class="sw-header">
                <div class="sw-icon-wrap">
                    <div class="sw-icon aw-icon" data-sw-icon aria-hidden="true">
                        <span class="aw-sun-body"></span>
                        <span class="aw-sun-rays"></span>
                    </div>
                </div>
                <div class="sw-right">
                    <span class="sw-temp" data-sw-temp>--°</span>
                    <span class="sw-city" data-sw-city>Bakı</span>
                </div>
            </div>
            <div class="sw-footer">
                <span class="sw-desc" data-sw-desc>Hava yüklənir...</span>
                <span class="sw-updated" data-sw-updated></span>
            </div>
            <div class="sw-details">
                <span class="sw-detail" data-sw-humidity>
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2C6 8 4 13 4 16a8 8 0 0016 0c0-3-2-8-8-14z"/></svg>
                    <span>-- %</span>
                </span>
                <span class="sw-detail" data-sw-wind>
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9.59 4.59A2 2 0 1111 8H2m10.59 11.41A2 2 0 1014 16H2m15.73-8.27A2.5 2.5 0 1119.5 12H2"/></svg>
                    <span>-- km/s</span>
                </span>
                <span class="sw-detail" data-sw-feels>
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 14.76V3.5a2.5 2.5 0 00-5 0v11.26a4.5 4.5 0 105 0z"/></svg>
                    <span>--°</span>
                </span>
            </div>
        </div>
    </section>

    <section class="widget widget-trending">
        <div class="trending-head">
            <span class="trending-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 2C13.5 2 12 8 9 11c-2 2-5 3-5 3s3.5.5 5 2c1 1 1.5 3 1.5 3s1-2.5 3-4c1.8-1.4 5-2 5-2s-2.5-.8-4-2.5C13 9 13.5 2 13.5 2z"/></svg>
                Trend
            </span>
            <span class="trending-label">Ən çox oxunan</span>
        </div>
        <div class="trending-list">
            <?php if ($trending->have_posts()) :
                $rank = 1;
                foreach ($trending->posts as $post) : ?>
                    <a class="trending-item" href="<?php echo esc_url(get_permalink($post)); ?>">
                        <span class="trending-rank<?php echo $rank <= 3 ? ' trending-rank--hot' : ''; ?>"><?php echo esc_html($rank); ?></span>
                        <span class="trending-title"><?php echo esc_html(get_the_title($post)); ?></span>
                    </a>
                <?php $rank++; endforeach;
            else : ?>
                <p>Trend məzmun yoxdur.</p>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </section>

    <section class="widget widget-markets">
        <div class="markets-head">
            <span class="markets-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                Bazarlar
            </span>
        </div>
        <div id="investaz-wrap" data-investaz></div>
    </section>

    <?php if (is_active_sidebar('sidebar-main')) : ?>
        <?php dynamic_sidebar('sidebar-main'); ?>
    <?php endif; ?>

    <section class="widget">
        <h3>Bülleten</h3>
        <p>Gündəlik ən vacib xəbərləri e-poçt ilə alın.</p>
        <?php if ($newsletter_status === 'success') : ?>
            <p class="newsletter-status newsletter-status--success">Abunəliyiniz qeydə alındı.</p>
        <?php elseif ($newsletter_status === 'exists') : ?>
            <p class="newsletter-status">Bu e-poçt artıq qeydiyyatdadır.</p>
        <?php elseif ($newsletter_status === 'invalid') : ?>
            <p class="newsletter-status newsletter-status--error">Düzgün e-poçt ünvanı daxil edin.</p>
        <?php endif; ?>
        <form class="newsletter-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
            <input type="hidden" name="action" value="millisfera_newsletter_subscribe">
            <?php wp_nonce_field('millisfera_newsletter_subscribe', 'millisfera_newsletter_nonce'); ?>
            <input class="newsletter-field" type="email" name="newsletter_email" placeholder="E-poçt ünvanınız" required>
            <button class="button newsletter-button" type="submit">Abunə ol</button>
        </form>
    </section>
</aside>
