<?php
/**
 * Template Name: Məxfilik
 */
if (!defined('ABSPATH')) exit;
get_header();

$site = get_bloginfo('name');
$phone = '+994-77-101-4436';
$whatsapp_link = 'https://wa.me/994771014436';
?>

<div class="about-page">

    <section class="about-hero">
        <div class="container about-hero-inner">
            <div class="about-hero-text">
                <span class="about-kicker">MƏXFİLİK</span>
                <h1><?php echo esc_html($site); ?><span>.az</span> məxfilik siyasəti</h1>
                <p>Bu səhifə sayt istifadəsi zamanı toplanan əsas texniki məlumatlar, əlaqə üsulları və ümumi məxfilik prinsipləri barədə qısa məlumat verir.</p>
            </div>
            <div class="about-hero-badge">
                <div class="about-badge-ring"></div>
                <div class="about-badge-core">
                    <span class="about-badge-year">SSL</span>
                    <span class="about-badge-label">Qorunur</span>
                </div>
            </div>
        </div>
    </section>

    <section class="container about-section">
        <div class="about-section-label">Əsas müddəalar</div>
        <div class="about-mission-grid">
            <div class="about-mission-text">
                <h2>Məlumatlardan istifadə prinsipi</h2>
                <p>Sayt ziyarəti zamanı yaranan texniki məlumatlar xidmətin işləkliyi, təhlükəsizlik və istifadə təcrübəsinin yaxşılaşdırılması məqsədilə emal oluna bilər.</p>
                <p>Oxucu tərəfindən birbaşa təqdim edilən məlumatlar yalnız müraciətə cavab verilməsi, əlaqə saxlanılması və xidmətin icrası məqsədi ilə istifadə olunur.</p>
                <p>Üçüncü tərəf platformalarına yönləndirən sosial media və xarici keçidlər həmin platformaların öz qaydalarına tabedir.</p>
            </div>
            <div class="about-values">
                <div class="about-value">
                    <div class="about-value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div>
                        <strong>Təhlükəsizlik</strong>
                        <p>Texniki və inzibati tədbirlər vasitəsilə məlumatların qorunması hədəflənir.</p>
                    </div>
                </div>
                <div class="about-value">
                    <div class="about-value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <div>
                        <strong>Əlaqə</strong>
                        <p>Məxfiliklə bağlı suallar üçün bizimlə birbaşa əlaqə saxlaya bilərsiniz.</p>
                    </div>
                </div>
                <div class="about-value">
                    <div class="about-value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <div>
                        <strong>Şəffaflıq</strong>
                        <p>İstifadəçilərə əsas məxfilik prinsipləri aydın və qısa formada təqdim olunur.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container about-cta">
        <div class="about-cta-inner">
            <div>
                <h3>Əlavə sualınız var?</h3>
                <p>Məxfilik və məlumat istifadəsi ilə bağlı suallar üçün <?php echo esc_html($phone); ?> nömrəsinə zəng edə və ya WhatsApp üzərindən yaza bilərsiniz.</p>
            </div>
            <div class="about-cta-btns">
                <a class="button" href="<?php echo esc_url(home_url('/elaqe')); ?>">Əlaqə</a>
                <a class="button button--outline" href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" rel="noopener">WhatsApp</a>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
