<?php
if (!defined('ABSPATH')) {
    exit;
}

if (post_password_required()) {
    return;
}
?>
<section class="section" id="comments">
    <header class="section-head">
        <h2>Şərhlər</h2>
    </header>

    <?php if (have_comments()) : ?>
        <ol style="padding-left:1rem;">
            <?php wp_list_comments(['style' => 'ol', 'short_ping' => true]); ?>
        </ol>
        <div class="pagination"><?php paginate_comments_links(); ?></div>
    <?php endif; ?>

    <?php
    comment_form([
        'title_reply' => 'Şərh yazın',
        'label_submit' => 'Göndər',
    ]);
    ?>
</section>
