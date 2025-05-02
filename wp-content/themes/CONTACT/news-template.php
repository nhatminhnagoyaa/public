<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>コンタクトフォーム | Contact Form</title>
    <link rel="stylesheet" href="common/cs/style.css">
</head>
<body>
    
    <div class="news-section">
        <div class="news-tabs">
            <?php
            $categories = [
                '' => __('新着', 'text-domain'), // Mặc định: tất cả bài viết
                'news' => __('ニュース', 'text-domain'),
                'graph-activity' => __('グラフ活動', 'text-domain'),
                'exam-info' => __('入試情報', 'text-domain'),
            ];
            foreach ($categories as $slug => $name) {
                $class = $slug === '' ? 'active' : '';
                echo '<div class="news-tab ' . $class . '" data-category="' . esc_attr($slug) . '">' . esc_html($name) . '</div>';
            }
            ?>
        </div>
        <div class="news-container" id="news-container">
            <!-- Nội dung bài viết sẽ được tải bằng AJAX -->
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.news-tab');
        const container = document.getElementById('news-container');

        // Hàm tải bài viết
        function loadNews(category = '', page = 1) {
            container.innerHTML = '<p>Loading...</p>';
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'load_news_by_category',
                        category: category,
                        page: page,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        container.innerHTML = data.data.html;
                        // Gắn lại sự kiện cho phân trang
                        attachPaginationEvents();
                    } else {
                        container.innerHTML = '<p>Error loading posts.</p>';
                    }
                })
                .catch(error => {
                    container.innerHTML = '<p>Error: ' + error.message + '</p>';
                });
        }

        // Gắn sự kiện cho tabs
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                loadNews(tab.dataset.category);
            });
        });

        // Xử lý sự kiện phân trang
        function attachPaginationEvents() {
            const paginationLinks = container.querySelectorAll('.news-pagination a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const url = new URL(link.href);
                    const page = url.searchParams.get('paged') || 1;
                    const activeTab = document.querySelector('.news-tab.active');
                    loadNews(activeTab.dataset.category, page);
                });
            });
        }

        // Tải bài viết mặc định (新着)
        loadNews();
    });
    </script>
</body>
</html>