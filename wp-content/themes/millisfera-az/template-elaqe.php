<?php
/**
 * Template Name: Əlaqə
 */
if (!defined('ABSPATH')) exit;
get_header();

$site = preg_replace('/\.az$/i', '', wp_strip_all_tags(get_bloginfo('name')));
$phone = '+994-77-101-4436';
$tel_link = 'tel:+994771014436';
$whatsapp_link = 'https://wa.me/994771014436';
$facebook_link = 'https://www.facebook.com/share/18UNQkckkV/';
$instagram_link = 'https://www.instagram.com/millisfera?igsh=MXRmeWVyMnpsaWpjeA==';
$youtube_link = 'https://youtube.com/@millisfera?si=4V-BudZomUk08qv8';
?>

<div class="about-page">

    <section class="about-hero">
        <div class="container about-hero-inner">
            <div class="about-hero-text">
                <span class="about-kicker">ƏLAQƏ</span>
                <h1><?php echo esc_html($site); ?><span>.az</span> ilə əlaqə</h1>
                <p>Xəbər göndərmək, əməkdaşlıq təklifi paylaşmaq və ya hər hansı sualınızı çatdırmaq üçün bizimlə birbaşa əlaqə saxlaya bilərsiniz.</p>
            </div>
            <div class="about-hero-badge">
                <div class="about-badge-ring"></div>
                <div class="about-badge-core">
                    <span class="about-badge-year">24/7</span>
                    <span class="about-badge-label">Əlaqə</span>
                </div>
            </div>
        </div>
    </section>

    <section class="container about-stats">
        <div class="about-stat">
            <strong>Telefon</strong>
            <span><?php echo esc_html($phone); ?></span>
        </div>
        <div class="about-stat">
            <strong>WhatsApp</strong>
            <span>Sürətli yazışma</span>
        </div>
        <div class="about-stat">
            <strong>VÖEN</strong>
            <span>4402407802</span>
        </div>
        <div class="about-stat">
            <strong>Sosial media</strong>
            <span>Facebook, Instagram, YouTube</span>
        </div>
    </section>

    <section class="container about-section">
        <div class="about-section-label">Əlaqə kanalları</div>
        <div class="about-team-grid">
            <div class="about-team-card">
                <strong>Telefon</strong>
                <span><a href="<?php echo esc_url($tel_link); ?>"><?php echo esc_html($phone); ?></a></span>
            </div>
            <div class="about-team-card">
                <strong>WhatsApp</strong>
                <span><a href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noopener">Birbaşa yazın</a></span>
            </div>
            <div class="about-team-card">
                <strong>Facebook</strong>
                <span><a href="<?php echo esc_url($facebook_link); ?>" target="_blank" rel="noopener">Səhifəyə keçid</a></span>
            </div>
            <div class="about-team-card">
                <strong>Instagram</strong>
                <span><a href="<?php echo esc_url($instagram_link); ?>" target="_blank" rel="noopener">@millisfera</a></span>
            </div>
            <div class="about-team-card">
                <strong>YouTube</strong>
                <span><a href="<?php echo esc_url($youtube_link); ?>" target="_blank" rel="noopener">Kanalı izləyin</a></span>
            </div>
            <div class="about-team-card">
                <strong>Reklam və əməkdaşlıq</strong>
                <span><a href="<?php echo esc_url(home_url('/reklam')); ?>">Reklam səhifəsinə keçin</a></span>
            </div>
        </div>
    </section>

    <section class="container about-section">
        <div class="about-section-label">Qeyd</div>
        <div class="about-mission-grid">
            <div class="about-mission-text">
                <h2>Müraciətlərinizi rahat şəkildə göndərin</h2>
                <p>Redaksiya ilə bağlı suallar, xəbər materialları, düzəliş bildirişləri və əməkdaşlıq təklifləri üçün əlaqə kanallarımız aktivdir.</p>
                <p>Ən operativ cavab üçün WhatsApp və telefon əlaqəsindən istifadə edə bilərsiniz.</p>
            </div>
            <div class="about-values">
                <div class="about-value">
                    <div class="about-value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.08 4.18 2 2 0 0 1 4.06 2h3a2 2 0 0 1 2 1.72c.13.96.35 1.9.66 2.81a2 2 0 0 1-.45 2.11L8 9.91a16 16 0 0 0 6.09 6.09l1.27-1.27a2 2 0 0 1 2.11-.45c.91.31 1.85.53 2.81.66A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div>
                        <strong>Birbaşa əlaqə</strong>
                        <p>Telefon və WhatsApp üzərindən sürətli geri dönüş imkanı.</p>
                    </div>
                </div>
                <div class="about-value">
                    <div class="about-value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <div>
                        <strong>Xəbər göndərişi</strong>
                        <p>Oxucu müraciətləri və xəbər məlumatları redaksiyaya çatdırıla bilər.</p>
                    </div>
                </div>
                <div class="about-value">
                    <div class="about-value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
                    </div>
                    <div>
                        <strong>Əməkdaşlıq</strong>
                        <p>Media, reklam və sponsorlu materiallar üçün ayrıca əlaqə mümkündür.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
