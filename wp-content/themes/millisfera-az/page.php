<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<div class="container" style="max-width:var(--content);">
    <?php while (have_posts()) : the_post(); ?>
        <header class="page-head">
            <h1><?php the_title(); ?></h1>
            <p>Yenilənmə: <?php echo esc_html(millisfera_format_date((int) get_post_modified_time('U'))); ?></p>
        </header>
        <article class="post-content">
            <?php the_content(); ?>
        </article>
        <?php comments_template(); ?>
    <?php endwhile; ?>
</div>
<?php
get_footer();
