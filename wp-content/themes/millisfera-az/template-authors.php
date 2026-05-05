<?php
/*
Template Name: Yazarlar Səhifəsi
*/
if (!defined('ABSPATH')) {
    exit;
}

get_header();
$authors = get_users([
    'who' => 'authors',
    'has_published_posts' => ['post'],
    'orderby' => 'display_name',
    'order' => 'ASC',
]);
?>
<div class="container">
    <header class="page-head">
        <h1>Yazarlar</h1>
        <p>Redaksiya və köşə yazarlarının bütün məqalələri.</p>
    </header>

    <?php if (!empty($authors)) : ?>
        <div class="authors-strip" style="grid-template-columns:repeat(3,minmax(0,1fr));">
            <?php foreach ($authors as $author) :
                $latest = get_posts([
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'author' => (int) $author->ID,
                    'posts_per_page' => 1,
                    'no_found_rows' => true,
                ]);
                ?>
                <article class="author-chip">
                    <a class="author-avatar" href="<?php echo esc_url(get_author_posts_url((int) $author->ID)); ?>"><?php echo get_avatar($author->ID, 96); ?></a>
                    <div>
                        <div class="author-name"><a href="<?php echo esc_url(get_author_posts_url((int) $author->ID)); ?>"><?php echo esc_html($author->display_name); ?></a></div>
                        <div class="meta" style="margin-top:.25rem;">
                            <span><?php echo esc_html(!empty($latest) ? wp_trim_words(get_the_title($latest[0]), 6, '') : 'Yeni yazı gözlənilir'); ?></span>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p>Yazar tapılmadı.</p>
    <?php endif; ?>
</div>
<?php
get_footer();
