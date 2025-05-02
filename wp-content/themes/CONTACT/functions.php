<?php
/**
 * Theme functions and definitions
 */

// Thiết lập các tính năng theme
function mytheme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'mytheme'),
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}

add_action('after_setup_theme', 'mytheme_setup');

// Đăng ký và enqueue stylesheet
function mytheme_enqueue_styles() {
    wp_enqueue_style('destyle', get_template_directory_uri() . './destyle.css', array(), '1.0.2');
    wp_enqueue_style('style', get_template_directory_uri() . './style.css', array(), '1.0.2');
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');

// Đăng ký Sidebar
function mytheme_register_sidebars() {
    register_sidebar(array(
        'name' => __('News Sidebar', 'mytheme'),
        'id' => 'news-sidebar',
        'description' => __('Sidebar for News and Single pages', 'mytheme'),
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'mytheme_register_sidebars');

// Đăng ký Custom Post Type cho News & Tops
function register_news_tops_post_type() {
    $labels = array(
        'name'               => __('News & Tops', 'mytheme'),
        'singular_name'      => __('News & Top', 'mytheme'),
        'menu_name'          => __('News & Tops', 'mytheme'),
        'add_new'            => __('Add New', 'mytheme'),
        'add_new_item'       => __('Add New News', 'mytheme'),
        'edit_item'          => __('Edit News', 'mytheme'),
        'new_item'           => __('New News', 'mytheme'),
        'view_item'          => __('View News', 'mytheme'),
        'search_items'       => __('Search News', 'mytheme'),
        'not_found'          => __('No news found', 'mytheme'),
        'not_found_in_trash' => __('No news found in Trash', 'mytheme'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'         => array('news_category'),
        'menu_icon'          => 'dashicons-format-aside',
        'rewrite'            => array('slug' => 'news-tops'),
    );

    register_post_type('news_tops', $args);
}
add_action('init', 'register_news_tops_post_type');

// Đăng ký Taxonomy cho danh mục
function register_news_category_taxonomy() {
    $labels = array(
        'name'              => __('News Categories', 'mytheme'),
        'singular_name'     => __('News Category', 'mytheme'),
        'search_items'      => __('Search Categories', 'mytheme'),
        'all_items'         => __('All Categories', 'mytheme'),
        'edit_item'         => __('Edit Category', 'mytheme'),
        'update_item'       => __('Update Category', 'mytheme'),
        'add_new_item'      => __('Add New Category', 'mytheme'),
        'new_item_name'     => __('New Category Name', 'mytheme'),
        'menu_name'         => __('Categories', 'mytheme'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'news-category'),
    );

    register_taxonomy('news_category', array('news_tops'), $args);

    // Thêm các danh mục mặc định
    $categories = array(
        '新着' => 'new-arrivals',
        'ニュース' => 'news',
        'グラフ活動' => 'graph-activities',
        '入試情報' => 'exam-info',
    );

    foreach ($categories as $name => $slug) {
        if (!term_exists($slug, 'news_category')) {
            wp_insert_term($name, 'news_category', array('slug' => $slug));
        }
    }
}
add_action('init', 'register_news_category_taxonomy');

// Shortcode để hiển thị News & Tops
function news_tops_shortcode($atts) {
    $atts = shortcode_atts(array(
        'category' => '',
        'posts_per_page' => 5,
    ), $atts);

    $args = array(
        'post_type' => 'news_tops',
        'posts_per_page' => absint($atts['posts_per_page']),
        'post_status' => 'publish',
    );

    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'news_category',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($atts['category']),
            ),
        );
    }

    $query = new WP_Query($args);

    ob_start();
    ?>
    <div class="news-tops-container">
        <?php if ($query->have_posts()) : ?>
            <ul class="news-tops-list">
                <?php while ($query->the_post()) : ?>
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
        <?php else : ?>
            <p><?php _e('No news found in this category.', 'mytheme'); ?></p>
        <?php endif; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('news_tops', 'news_tops_shortcode');
?>