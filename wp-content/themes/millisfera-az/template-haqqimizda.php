<?php
/**
 * Template Name: Haqqımızda
 */
if (!defined('ABSPATH')) exit;
get_header();
$site = preg_replace('/\.az$/i', '', wp_strip_all_tags(get_bloginfo('name')));
?>

<div class="about-page">

    <!-- Hero -->
    <section class="about-hero">
        <div class="container about-hero-inner">
            <div class="about-hero-text">
                <span class="about-kicker">HAQQIMIZDA</span>
                <h1><?php echo esc_html($site); ?><span>.az</span> haqqında</h1>
                <p>Millisfera.az 2025-ci ildə yaradılmış xəbər bloqudur. Məqsədimiz xəbərləri operativ, düzgün və qərəzsiz şəkildə onlayn çatdırmaqdır.</p>
            </div>
            <div class="about-hero-badge">
                <div class="about-badge-ring"></div>
                <div class="about-badge-core">
                    <span class="about-badge-year"><?php echo esc_html(wp_date('Y')); ?></span>
                    <span class="about-badge-label">Fəaliyyətdə</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistika -->
    <section class="container about-stats">
        <div class="about-stat">
            <strong>500K+</strong>
            <span>Geniş oxucu auditoriyası</span>
        </div>
        <div class="about-stat">
            <strong>2025</strong>
            <span>Yaradılma ili</span>
        </div>
        <div class="about-stat">
            <strong>VÖEN</strong>
            <span>4402407802</span>
        </div>
        <div class="about-stat">
            <strong>Emil</strong>
            <span>Təsisçi: Emil Müzəffərli</span>
        </div>
    </section>

    <!-- Missiya -->
    <section class="container about-section">
        <div class="about-section-label">Missiyamız</div>
        <div class="about-mission-grid">
            <div class="about-mission-text">
                <h2>Xəbərləri operativ və qərəzsiz çatdırmaq</h2>
                <p>Platformada əsasən ölkədə və dünyada baş verən aktual hadisələr, eləcə də xüsusi araşdırma materialları paylaşılır.</p>
                <p>Millisfera.az xəbər bloqu vergi ödəyicisidir və müstəqil fəaliyyət göstərir. Sosial şəbəkələrdə də aktivik: bizi Instagram, Facebook, TikTok və YouTube platformaları üzərindən izləyə bilərsiniz.</p>
            </div>
            <div class="about-values">
                <div class="about-value">
                    <div class="about-value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div>
                        <strong>Müstəqil fəaliyyət</strong>
                        <p>Millisfera.az xəbər bloqu müstəqil fəaliyyət göstərir və vergi ödəyicisidir.</p>
                    </div>
                </div>
                <div class="about-value">
                    <div class="about-value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div>
                        <strong>Operativlik</strong>
                        <p>Oxuculara xəbərləri vaxtında və onlayn şəkildə çatdırırıq.</p>
                    </div>
                </div>
                <div class="about-value">
                    <div class="about-value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                    <div>
                        <strong>Düzgünlük</strong>
                        <p>Məlumatların düzgün təqdim olunmasına və oxucu etimadına önəm veririk.</p>
                    </div>
                </div>
                <div class="about-value">
                    <div class="about-value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                    </div>
                    <div>
                        <strong>Sosial aktivlik</strong>
                        <p>Facebook, Instagram və YouTube üzərindən oxucularla əlaqədə qalırıq.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Redaksiya -->
    <section class="about-team-section">
        <div class="container">
            <div class="about-section-label">Təsisçi</div>
            <h2 class="about-team-title">Millisfera.az rəhbərliyi</h2>
            <div class="about-team-grid">
                <div class="about-team-card">
                    <strong>Emil Müzəffərli</strong>
                    <span>Təsisçi</span>
                </div>
                <div class="about-team-card">
                    <strong>VÖEN: 4402407802</strong>
                    <span>Rəsmi vergi qeydiyyatı</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Əlaqə CTA -->
    <section class="container about-cta">
        <div class="about-cta-inner">
            <div>
                <h3>Bizimlə əlaqə saxlayın</h3>
                <p>Xəbər göndərmək, əməkdaşlıq təklifi və ya hər hansı sual üçün +994-77-101-4436 nömrəsi ilə əlaqə saxlayın.</p>
            </div>
            <div class="about-cta-btns">
                <a class="button" href="<?php echo esc_url(home_url('/elaqe')); ?>">Əlaqə</a>
                <a class="button button--outline" href="<?php echo esc_url('https://wa.me/994771014436'); ?>" target="_blank" rel="noopener">WhatsApp</a>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
