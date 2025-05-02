jQuery(document).ready(function($) {
    const tabs = $('.news-tab');
    const container = $('#news-container');

    // Hàm tải bài viết
    function loadNews(category = '', page = 1) {
        container.html('<p>Loading...</p>');
        $.ajax({
            url: newsTabs.ajax_url,
            type: 'POST',
            data: {
                action: 'load_news_by_category',
                category: category,
                page: page,
                nonce: newsTabs.nonce
            },
            success: function(response) {
                if (response.success) {
                    container.html(response.data.html);
                    attachPaginationEvents();
                } else {
                    container.html('<p>Error loading posts.</p>');
                }
            },
            error: function(xhr, status, error) {
                container.html('<p>Error: ' + error + '</p>');
            }
        });
    }

    // Gắn sự kiện cho tabs
    tabs.on('click', function() {
        tabs.removeClass('active');
        $(this).addClass('active');
        loadNews($(this).data('category'));
    });

    // Xử lý sự kiện phân trang
    function attachPaginationEvents() {
        const paginationLinks = container.find('.news-pagination a');
        paginationLinks.on('click', function(e) {
            e.preventDefault();
            const url = new URL(this.href);
            const page = url.searchParams.get('paged') || 1;
            const activeTab = tabs.filter('.active');
            loadNews(activeTab.data('category'), page);
        });
    }

    // Tải bài viết mặc định (新着)
    loadNews();
});

container.addClass('loading');
// Trong success/error, xóa class:
container.removeClass('loading');