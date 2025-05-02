<?php
/**
 * The template for displaying single posts
 */
get_header();
?>
<main class="single-content">
    <div class="single-wrapper">
        <div class="single-container">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <nav class="breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a> >
                    <a href="<?php echo esc_url(home_url('/news')); ?>">News & Tops</a> >
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'news_category');
                    if ($categories && !is_wp_error($categories)) {
                        $category = reset($categories);
                        echo '<a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
                    }
                    ?>
                </nav>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="single-header">
                        <h1 class="single-title"><?php the_title(); ?></h1>
                        <div class="single-meta">
                            <span class="single-date"><?php echo get_the_date(); ?></span>
                            <?php if ($categories && !is_wp_error($categories)) : ?>
                                <span class="single-categories">
                                    <?php
                                    $category_links = array();
                                    foreach ($categories as $category) {
                                        $category_links[] = '<a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
                                    }
                                    echo ' | ' . implode(', ', $category_links);
                                    ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </header>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="single-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="single-body">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php else : ?>
                <p><?php _e('No content found. Please check if the News & Tops post is published.', 'mytheme'); ?></p>
            <?php endif; ?>
        </div>
        <aside class="news-sidebar">
            <?php dynamic_sidebar('news-sidebar'); ?>
        </aside>
    </div>
</main>
<?php
get_footer();
?>