<?php
/**
 * The template for displaying the news archive
 */
get_header();
?>
<main class="news-content">
    <div class="news-container">
        <h1 class="news-title">News & Tops</h1>
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'news_tops',
            'posts_per_page' => 10,
            'paged' => $paged,
            'post_status' => 'publish',
        );
        $query = new WP_Query($args);
        ?>
        <div class="news-tops-container">
            <?php if ($query->have_posts()) : ?>
            <ul class="news-tops-list">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                <li class="news-tops-item">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="news-thumbnail">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </div>
                    <?php endif; ?>
                    <div class="news-content">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="news-excerpt"><?php the_excerpt(); ?></div>
                        <span class="news-date"><?php echo get_the_date(); ?></span>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>
            <?php
                // Phân trang
                $pagination_args = array(
                    'total' => $query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => __('« Previous'),
                    'next_text' => __('Next »'),
                );
                echo '<nav class="pagination">';
                echo paginate_links($pagination_args);
                echo '</nav>';
                ?>
            <?php else : ?>
            <p><?php _e('No news found.', 'mytheme'); ?></p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <aside class="news-sidebar">
    <?php dynamic_sidebar('news-sidebar rump; ?>
</aside>
    </div>
</main>
<?php
get_footer();
?>