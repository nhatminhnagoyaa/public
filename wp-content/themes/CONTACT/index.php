<?php
/**
 * The main template file
 */
get_header();
?>
<main class="index-content">
    <div class="index-container">
        <?php if (is_home() || is_archive()) : ?>
            <h2><?php _e('Latest News & Tops', 'mytheme'); ?></h2>
            <?php
            // Hiển thị tất cả bài viết News & Tops
            echo do_shortcode('[news_tops posts_per_page="10"]');
            ?>
        <?php else : ?>
            <h2><?php _e('News & Tops', 'mytheme'); ?></h2>
            <?php
            // Hiển thị bài viết theo danh mục nếu đang ở trang taxonomy
            if (is_tax('news_category')) {
                $term = get_queried_object();
                echo do_shortcode('[news_tops category="' . esc_attr($term->slug) . '" posts_per_page="10"]');
            } else {
                // Mặc định hiển thị tất cả bài viết
                echo do_shortcode('[news_tops posts_per_page="10"]');
            }
            ?>
        <?php endif; ?>
    </div>
</main>
<?php
get_footer();
?>