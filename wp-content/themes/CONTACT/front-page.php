<?php
/**
 * The template for displaying the front page
 */
get_header();
?>
<main class="front-page-content">

    <!-- Hero Section -->
    <section class="hero-section ">
        <div class="inner1200">
            <div class="hero-content">
                <h1>Welcome to AIT</h1>
                <p>Discover the latest news, activities, and exam information at AIT.</p>
                <a href="<?php echo esc_url(home_url('/news-tops')); ?>" class="hero-cta">Explore News</a>
            </div>
        </div>
    </section>

    <!-- Pick Up Section -->
    <section class="pickup inner1200">
        <h2 class="section-title">Pick Up</h2>
        <div class="pickup-items">
            <div class="pickup-item">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/common/images/img.png" alt="説明1">
                <p>AI（人工知能）は、もはや未来の話ではありません。今、この瞬間にも学校現場で活躍しています！
                    宿題のサポート、個別最適化された学習、そして先生の業務を効率化するツールまで<br>
                    ──AIは学びの形を大きく変えています。</p>
            </div>
            <div class="pickup-item">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/common/images/img02.png" alt="説明2">
                <p>AI（人工知能）は、もはや未来の話ではありません。今、この瞬間にも学校現場で活躍しています！
                    宿題のサポート、個別最適化された学習、そして先生の業務を効率化するツールまで<br>
                    ──AIは学びの形を大きく変えています。</p>
            </div>
            <div class="pickup-item">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/common/images/img.png" alt="説明3">
                <p>AI（人工知能）は、もはや未来の話ではありません。今、この瞬間にも学校現場で活躍しています！
                    宿題のサポート、個別最適化された学習、そして先生の業務を効率化するツールまで<br>
                    ──AIは学びの形を大きく変えています。</p>
            </div>
        </div>
    </section>


    <!-- News Section -->
    <section class="news-section inner1200">
        <h2 class="section-title">News & Tops</h2>
        <div class="news-category">
            <h3>新着 (New Arrivals)</h3>
            <?php echo do_shortcode('[news_tops category="new-arrivals" posts_per_page="3"]'); ?>
        </div>
        <div class="news-category">
            <h3>ニュース (News)</h3>
            <?php echo do_shortcode('[news_tops category="news" posts_per_page="3"]'); ?>
        </div>
        <div class="news-category">
            <h3>グラフ活動 (Graph Activities)</h3>
            <?php echo do_shortcode('[news_tops category="graph-activities" posts_per_page="3"]'); ?>
        </div>
        <div class="news-category">
            <h3>入試情報 (Exam Info)</h3>
            <?php echo do_shortcode('[news_tops category="exam-info" posts_per_page="3"]'); ?>
        </div>
    </section>

    <!-- Strengths Section -->
    <section class="strengths-section inner1200">

        <h2 class="section-title">CONTACTの強み</h2>
        <div class="strengths-container">
            <div class="strength-item">
                <h3>Innovative Education <br>革新的な教育</h3>
                <p>Providing cutting-edge learning methods to foster creativity and critical thinking.</p>
                <p>創造力と批判的思考力を育むための最先端の学習方法を提供します。</p>
            </div>
            <div class="strength-item">
                <h3>Expert Faculty <br>
                    専門的な教員陣</h3>
                <p>Our experienced instructors guide students to achieve academic excellence.</p>
                <p>経験豊富な講師が学生の学術的な成功をサポートします。</p>
            </div>
            <div class="strength-item">
                <h3>Comprehensive Resources <br>充実した学習環境</h3>
                <p>Access to extensive study materials and advanced facilities.</p>
                <p>豊富な学習教材と先進的な設備へのアクセスが可能です。</p>
            </div>
            <div class="strength-item">
                <h3>Community Engagemen <br>地域とのつながり</h3>
                <p>Active participation in graph activities and community-driven initiatives.</p>
                <p>グループ活動や地域主導の取り組みに積極的に参加しています。</p>
            </div>
        </div>
    </section>

</main>
<?php
get_footer();
?>