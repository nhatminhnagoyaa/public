<?php
/**
 * The footer for our theme
 */
?>
    </div><!-- .site-content -->
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-info">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
                <p><?php bloginfo('description'); ?></p>
            </div>
            <div class="footer-nav">
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">HOME</a></li>
                    <li><a href="<?php echo esc_url(home_url('/english')); ?>">ENLISH</a></li>
                    <li><a href="<?php echo esc_url(home_url('/access')); ?>">ACCESS</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>">CONTACT</a></li>
                    <li><a href="<?php echo esc_url(home_url('/sitemap')); ?>">SITEMAP</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
<?php
?>