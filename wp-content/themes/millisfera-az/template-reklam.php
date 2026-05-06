<?php
/**
 * Template Name: Reklam
 */
if (!defined('ABSPATH')) exit;
get_header();
$site = preg_replace('/\.az$/i', '', wp_strip_all_tags(get_bloginfo('name')));
$phone = '+994-77-101-4436';
$tel_link = 'tel:+994771014436';
$whatsapp_link = 'https://wa.me/994771014436';
?>

<div class="adv-page">

    <!-- Hero -->
    <section class="adv-hero">
        <div class="container adv-hero-inner">
            <span class="about-kicker">Reklam imkanları</span>
            <h1><?php echo esc_html($site); ?>.az-da<br>brendinizi tanıdın</h1>
            <p>Millisfera.az xəbər bloqu sosial şəbəkələrdə aktiv fəaliyyət göstərir və ölkə üzrə geniş oxucu auditoriyasına malikdir. Reklam və əməkdaşlıq üçün bizimlə birbaşa əlaqə saxlayın.</p>
            <a class="button adv-hero-btn" href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noopener">WhatsApp ilə sifariş et</a>
        </div>
    </section>

    <!-- Statistika -->
    <section class="container adv-stats">
        <div class="adv-stat">
            <strong>Geniş</strong>
            <span>Ölkə üzrə oxucu auditoriyası</span>
        </div>
        <div class="adv-stat">
            <strong>Aktiv</strong>
            <span>Sosial media fəaliyyəti</span>
        </div>
        <div class="adv-stat">
            <strong>Online</strong>
            <span>Xəbər bloqu formatı</span>
        </div>
        <div class="adv-stat">
            <strong>Tel</strong>
            <span><?php echo esc_html($phone); ?></span>
        </div>
    </section>

    <!-- Paketlər -->
    <section class="container adv-section">
        <div class="about-section-label">Reklam paketləri</div>
        <h2 class="adv-section-title">Sizə uyğun formatı seçin</h2>
        <div class="adv-packages">

            <div class="adv-package">
                <div class="adv-pkg-header">
                    <div class="adv-pkg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    </div>
                    <span class="adv-pkg-badge">Populyar</span>
                </div>
                <h3>Banner Reklam</h3>
                <p>Saytın yüksək görünən yerlərindəki standart banner formatları.</p>
                <ul class="adv-pkg-list">
                    <li>Leaderboard — 728×90 px</li>
                    <li>Rectangle — 300×250 px</li>
                    <li>Skyscraper — 160×600 px</li>
                    <li>Mobil banner — 320×50 px</li>
                </ul>
                <a class="adv-pkg-btn" href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noopener">Ətraflı öyrən</a>
            </div>

            <div class="adv-package adv-package--featured">
                <div class="adv-pkg-header">
                    <div class="adv-pkg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    </div>
                    <span class="adv-pkg-badge adv-pkg-badge--accent">Tövsiyə</span>
                </div>
                <h3>Sponsorlu Məzmun</h3>
                <p>Brendinizin xəbər formatında təqdim edildiyi native reklam materialı.</p>
                <ul class="adv-pkg-list">
                    <li>Xəbər axınında görünür</li>
                    <li>SEO üstünlüyü</li>
                    <li>Sosial mediada paylaşım</li>
                    <li>30 gün saytda qalır</li>
                </ul>
                <a class="adv-pkg-btn adv-pkg-btn--accent" href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noopener">Sifariş et</a>
            </div>

            <div class="adv-package">
                <div class="adv-pkg-header">
                    <div class="adv-pkg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                    </div>
                </div>
                <h3>Breaking News Banneri</h3>
                <p>Son xəbər lentinin yanında yüksək baxış alan premium yerləşdirmə.</p>
                <ul class="adv-pkg-list">
                    <li>Son xəbər bölməsi</li>
                    <li>Ana səhifə hero bloku</li>
                    <li>Push bildiriş ilə</li>
                    <li>Həftəlik hesabat</li>
                </ul>
                <a class="adv-pkg-btn" href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noopener">Ətraflı öyrən</a>
            </div>

        </div>
    </section>

    <!-- Banner ölçüləri -->
    <section class="adv-sizes-section">
        <div class="container">
            <div class="about-section-label">Banner ölçüləri</div>
            <h2 class="adv-section-title">Standart reklam formatları</h2>
            <div class="adv-sizes-grid">
                <div class="adv-size-card">
                    <div class="adv-size-preview adv-size-leader">728×90</div>
                    <span>Leaderboard</span>
                    <em>Header / Footer</em>
                </div>
                <div class="adv-size-card">
                    <div class="adv-size-preview adv-size-rect">300×250</div>
                    <span>Medium Rectangle</span>
                    <em>Sidebar / Məzmun içi</em>
                </div>
                <div class="adv-size-card">
                    <div class="adv-size-preview adv-size-sky">160×600</div>
                    <span>Wide Skyscraper</span>
                    <em>Sidebar</em>
                </div>
                <div class="adv-size-card">
                    <div class="adv-size-preview adv-size-mob">320×50</div>
                    <span>Mobil Banner</span>
                    <em>Mobil cihazlar</em>
                </div>
            </div>
        </div>
    </section>

    <!-- Əlaqə forması -->
    <section class="container adv-contact">
        <div class="adv-contact-inner">
            <div class="adv-contact-text">
                <div class="about-section-label">Sifariş</div>
                <h2>Reklam sifarişi verin</h2>
                <p>Aşağıdakı məlumatları doldurun və ya birbaşa telefon/WhatsApp vasitəsilə bizimlə əlaqə saxlayın.</p>
                <div class="adv-contact-info">
                    <a href="<?php echo esc_url($tel_link); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.08 4.18 2 2 0 0 1 4.06 2h3a2 2 0 0 1 2 1.72c.13.96.35 1.9.66 2.81a2 2 0 0 1-.45 2.11L8 9.91a16 16 0 0 0 6.09 6.09l1.27-1.27a2 2 0 0 1 2.11-.45c.91.31 1.85.53 2.81.66A2 2 0 0 1 22 16.92z"/></svg>
                        <?php echo esc_html($phone); ?>
                    </a>
                    <a href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noopener">
                        WhatsApp
                    </a>
                </div>
            </div>
            <form class="adv-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                <div class="adv-form-row">
                    <input type="text" name="adv_name" placeholder="Ad Soyad *" required>
                    <input type="text" name="adv_company" placeholder="Şirkət adı">
                </div>
                <div class="adv-form-row">
                    <input type="email" name="adv_email" placeholder="E-poçt *" required>
                    <input type="tel" name="adv_phone" placeholder="Telefon">
                </div>
                <select name="adv_type">
                    <option value="">Reklam növü seçin</option>
                    <option>Banner Reklam</option>
                    <option>Sponsorlu Məzmun</option>
                    <option>Breaking News Banneri</option>
                    <option>Digər</option>
                </select>
                <textarea name="adv_message" rows="4" placeholder="Qeyd / Əlavə məlumat"></textarea>
                <button class="button" type="submit">Sorğu göndər</button>
            </form>
        </div>
    </section>

</div>

<?php get_footer(); ?>
