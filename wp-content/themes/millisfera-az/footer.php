<?php
if (!defined('ABSPATH')) {
    exit;
}

$footer_categories = millisfera_top_categories(8);
$millisfera_facebook = 'https://www.facebook.com/share/1GWRuuPedi/';
$millisfera_instagram = 'https://www.instagram.com/millisfera.az?igsh=MXRmeWVyMnpsaWpjeA==';
$millisfera_tiktok = 'https://www.tiktok.com/@millisfera_?_r=1&_t=ZS-969ksB6NzM0';
$millisfera_youtube = 'https://youtube.com/@millisfera?si=VAtn7m0u-j25j5A0';
$millisfera_phone = '+994-77-101-4436';
$millisfera_tel = '+994771014436';
$millisfera_whatsapp = 'https://wa.me/994771014436';
?>
</main>
<footer class="site-footer">
    <div class="container footer-top">
        <div>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo-link" aria-label="<?php bloginfo('name'); ?> – Ana səhifə">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo.png'); ?>" alt="<?php bloginfo('name'); ?>" class="footer-logo site-logo--light" loading="lazy">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo-dark.png'); ?>" alt="<?php bloginfo('name'); ?>" class="footer-logo site-logo--dark" loading="lazy">
            </a>
            <p>Millisfera.az xəbər bloqu sosial şəbəkələrdə aktiv fəaliyyət göstərir və ölkə üzrə geniş oxucu auditoriyasına malikdir.</p>
        </div>

        <div>
            <h4>Kateqoriyalar</h4>
            <div class="footer-list">
                <?php foreach ($footer_categories as $category) : ?>
                    <a href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a>
                <?php endforeach; ?>
            </div>
        </div>

        <div>
            <h4>Korporativ</h4>
            <div class="footer-list">
                <a href="<?php echo esc_url(home_url('/haqqimizda')); ?>">Haqqımızda</a>
                <a href="<?php echo esc_url(home_url('/elaqe')); ?>">Əlaqə</a>
                <a href="<?php echo esc_url(home_url('/reklam')); ?>">Reklam</a>
                <a href="<?php echo esc_url(home_url('/gizlilik')); ?>">Məxfilik</a>
                <a href="<?php echo esc_url('tel:' . $millisfera_tel); ?>"><?php echo esc_html($millisfera_phone); ?></a>
                <a href="<?php echo esc_url($millisfera_whatsapp); ?>" target="_blank" rel="noopener">WhatsApp</a>
            </div>
        </div>

        <div>
            <h4>Sosial media</h4>
            <div class="footer-list">
                <a href="<?php echo esc_url($millisfera_facebook); ?>" target="_blank" rel="noopener">Facebook</a>
                <a href="<?php echo esc_url($millisfera_instagram); ?>" target="_blank" rel="noopener">Instagram</a>
                <a href="<?php echo esc_url($millisfera_tiktok); ?>" target="_blank" rel="noopener">TikTok</a>
                <a href="<?php echo esc_url($millisfera_youtube); ?>" target="_blank" rel="noopener">YouTube</a>
            </div>
        </div>
    </div>

    <div class="container footer-bottom">
        <span>© <?php echo esc_html(wp_date('Y')); ?> <?php bloginfo('name'); ?>. Bütün hüquqlar qorunur.</span>
        <span>Tel: <?php echo esc_html($millisfera_phone); ?></span>
    </div>
</footer>
<nav class="floating-rail" aria-label="Sosial və sürətli keçidlər">
    <a class="rail-button" href="<?php echo esc_url($millisfera_facebook); ?>" target="_blank" rel="noopener" aria-label="Facebook">
        <span aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path fill="#1877F2" d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.235 2.686.235v2.97h-1.514c-1.491 0-1.956.93-1.956 1.886v2.27h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>
        </span>
        <strong>Facebook</strong>
    </a>
    <a class="rail-button" href="<?php echo esc_url($millisfera_instagram); ?>" target="_blank" rel="noopener" aria-label="Instagram">
        <span aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><defs><linearGradient id="ig-g" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" stop-color="#FFC107"/><stop offset="50%" stop-color="#F44336"/><stop offset="100%" stop-color="#9C27B0"/></linearGradient></defs><path fill="url(#ig-g)" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
        </span>
        <strong>Instagram</strong>
    </a>
    <a class="rail-button" href="<?php echo esc_url($millisfera_tiktok); ?>" target="_blank" rel="noopener" aria-label="TikTok">
        <span aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path fill="#111111" d="M16.6 3c.4 1.4 1.2 2.5 2.4 3.3 1 .7 2.2 1.1 3.4 1.1v3.3c-1.6 0-3.2-.4-4.6-1.1v6.4c0 1.4-.4 2.8-1.2 3.9-1.3 1.9-3.5 3.1-5.9 3.1-3.8 0-6.8-3.1-6.8-6.8s3.1-6.8 6.8-6.8c.3 0 .6 0 .9.1v3.4c-.3-.1-.6-.2-.9-.2-1.9 0-3.4 1.5-3.4 3.4s1.5 3.4 3.4 3.4c1.8 0 3.2-1.4 3.4-3.2V3h2.5z"/></svg>
        </span>
        <strong>TikTok</strong>
    </a>
    <a class="rail-button" href="<?php echo esc_url($millisfera_youtube); ?>" target="_blank" rel="noopener" aria-label="YouTube">
        <span aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path fill="#FF0000" d="M23.5 6.2a3.02 3.02 0 0 0-2.13-2.14C19.48 3.56 12 3.56 12 3.56s-7.48 0-9.37.5A3.02 3.02 0 0 0 .5 6.2 31.6 31.6 0 0 0 0 12a31.6 31.6 0 0 0 .5 5.8 3.02 3.02 0 0 0 2.13 2.14c1.89.5 9.37.5 9.37.5s7.48 0 9.37-.5a3.02 3.02 0 0 0 2.13-2.14A31.6 31.6 0 0 0 24 12a31.6 31.6 0 0 0-.5-5.8zM9.55 15.57V8.43L15.82 12l-6.27 3.57z"/></svg>
        </span>
        <strong>YouTube</strong>
    </a>
    <a class="rail-button" href="<?php echo esc_url($millisfera_whatsapp); ?>" target="_blank" rel="noopener" aria-label="WhatsApp">
        <span aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path fill="#25D366" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        </span>
        <strong>WhatsApp</strong>
    </a>
    <a class="rail-button" href="<?php echo esc_url('tel:' . $millisfera_tel); ?>" aria-label="Zəng et">
        <span aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path fill="#0ea5e9" d="M6.6 10.8c1.4 2.8 3.8 5.2 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.3 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V21c0 .6-.4 1-1 1C10.6 22 2 13.4 2 3c0-.6.4-1 1-1h4.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1l-2.2 2.2z"/></svg>
        </span>
        <strong>Zəng et</strong>
    </a>
    <a class="rail-button" href="<?php echo esc_url(home_url('/reklam')); ?>" aria-label="Reklam">
        <span aria-hidden="true">AD</span>
        <strong>Reklam</strong>
    </a>
    <button class="rail-button rail-weather" type="button" data-weather-rail data-city="Baku,AZ" aria-label="Bakı hava məlumatı">
        <span aria-hidden="true">☀</span>
        <strong data-weather-rail-text>Bakı --°</strong>
    </button>
</nav>
<nav class="mbn" aria-label="Mobil alt naviqasiya" role="navigation">
    <a class="mbn-btn <?php echo is_front_page() ? 'mbn-btn--active' : ''; ?>" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Ana səhifə">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        <span>Ana səhifə</span>
    </a>
    <button class="mbn-btn" type="button" data-mbn-search aria-label="Axtar">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <span>Axtar</span>
    </button>
    <button class="mbn-btn" type="button" data-mbn-cats aria-label="Kateqoriyalar" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        <span>Kateqoriyalar</span>
    </button>
    <button class="mbn-btn" type="button" data-mbn-social aria-label="Sosial şəbəkələr" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
        <span>Sosial</span>
    </button>
</nav>

<div class="mbn-cats-panel" data-mbn-cats-panel aria-hidden="true">
    <div class="mbn-cats-header">
        <span>Kateqoriyalar</span>
        <button type="button" data-mbn-cats-close aria-label="Bağla">✕</button>
    </div>
    <div class="mbn-cats-grid">
        <?php foreach ($footer_categories as $cat) : ?>
            <a class="mbn-cat-item" href="<?php echo esc_url(get_category_link($cat)); ?>">
                <?php echo esc_html($cat->name); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<div class="mbn-overlay" data-mbn-overlay></div>

<button class="scroll-control" type="button" data-scroll-control aria-label="Aşağı düş" title="Aşağı düş">
    <span class="scroll-control-icon" data-scroll-control-icon aria-hidden="true">
        <svg class="scroll-control-arrow scroll-control-arrow-down" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 5v14"></path>
            <path d="m19 12-7 7-7-7"></path>
        </svg>
        <svg class="scroll-control-arrow scroll-control-arrow-up" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 19V5"></path>
            <path d="m5 12 7-7 7 7"></path>
        </svg>
    </span>
    <span class="scroll-control-text" data-scroll-control-text>Aşağı</span>
</button>

<?php wp_footer(); ?>
</body>
</html>
