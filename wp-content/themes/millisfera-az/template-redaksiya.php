<?php
/**
 * Template Name: Redaksiya
 */
if (!defined('ABSPATH')) exit;
get_header();

$site = preg_replace('/\.az$/i', '', wp_strip_all_tags(get_bloginfo('name')));
$phone = '+994-77-101-4436';
$whatsapp_link = 'https://wa.me/994771014436';
?>

<div class="about-page">

    <section class="about-hero">
        <div class="container about-hero-inner">
            <div class="about-hero-text">
                <span class="about-kicker">REDAKSİYA</span>
                <h1><?php echo esc_html($site); ?><span>.az</span> redaksiya heyəti</h1>
                <p>Platformanın redaksiya fəaliyyəti operativ xəbər axını, məzmun nəzarəti və oxucu əlaqələrinin düzgün idarə olunması prinsipi ilə qurulub.</p>
            </div>
            <div class="about-hero-badge">
                <div class="about-badge-ring"></div>
                <div class="about-badge-core">
                    <span class="about-badge-year"><?php echo esc_html(wp_date('Y')); ?></span>
                    <span class="about-badge-label">Heyət</span>
                </div>
            </div>
        </div>
    </section>

    <section class="container about-stats">
        <div class="about-stat">
            <strong>Təsisçi</strong>
            <span>Emil Müzəffərli</span>
        </div>
        <div class="about-stat">
            <strong>Platforma</strong>
            <span>Xəbər bloqu</span>
        </div>
        <div class="about-stat">
            <strong>VÖEN</strong>
            <span>4402407802</span>
        </div>
        <div class="about-stat">
            <strong>Əlaqə</strong>
            <span><?php echo esc_html($phone); ?></span>
        </div>
    </section>

    <section class="about-team-section">
        <div class="container">
            <div class="about-section-label">Heyət</div>
            <h2 class="about-team-title">Redaksiya strukturu</h2>
            <div class="about-team-grid">
                <div class="about-team-card">
                    <strong>Emil Müzəffərli</strong>
                    <span>Təsisçi</span>
                </div>
                <div class="about-team-card">
                    <strong>Millisfera.az</strong>
                    <span>Operativ xəbər axını və məzmun idarəçiliyi</span>
                </div>
                <div class="about-team-card">
                    <strong>Əlaqə xətti</strong>
                    <span><?php echo esc_html($phone); ?></span>
                </div>
                <div class="about-team-card">
                    <strong>WhatsApp</strong>
                    <span><a href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noopener">Redaksiya ilə yazışın</a></span>
                </div>
            </div>
        </div>
    </section>

    <section class="container about-section">
        <div class="about-section-label">Prinsiplər</div>
        <div class="about-mission-grid">
            <div class="about-mission-text">
                <h2>Redaksiya yanaşmamız</h2>
                <p>Redaksiya xəbərlərin düzgün, operativ və oxucu üçün aydın formada təqdim olunmasına üstünlük verir.</p>
                <p>Məlumat dəqiqliyi, mövzu aktuallığı və ictimai fayda əsas redaksiya meyarlarıdır.</p>
            </div>
            <div class="about-values">
                <div class="about-value">
                    <div class="about-value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <div>
                        <strong>Dəqiqlik</strong>
                        <p>Məzmunun mümkün qədər etibarlı mənbələrə söykənməsi hədəflənir.</p>
                    </div>
                </div>
                <div class="about-value">
                    <div class="about-value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div>
                        <strong>Operativlik</strong>
                        <p>Vacib hadisələr sürətli şəkildə xəbər axınına əlavə olunur.</p>
                    </div>
                </div>
                <div class="about-value">
                    <div class="about-value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <div>
                        <strong>Oxucu əlaqəsi</strong>
                        <p>Oxucu müraciətləri və düzəliş bildirişləri nəzərə alınır.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
