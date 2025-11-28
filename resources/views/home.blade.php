<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('styles')
    :root {
    --bg: #F4ECFF;
    --card: #FFFFFF;
    --ink: #1F174C;
    --muted: #6E5CA6;
    --accent: #6B53CE;
    --accent-600: #5B47B6;
    --chip: #E9E0FF;
    --danger: #ef4444;
    --success: #10b981;
    }

    body {
    background: linear-gradient(135deg, #f6f6fa 0%, #ede9fe 100%);
    font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
    color: #2d2d3a;
    min-height: 100vh;
    }

    .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    }

    /* Header с иллюстрацией */
    .header-section {
    background: var(--bg);
    padding: 2rem 1.5rem 1.5rem;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    }

    .header-content {
    flex: 1;
    }

    .header-content h1 {
    font-size: 2.75rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 0.5rem;
    line-height: 1.1;
    }

    .header-content p {
    font-size: 1.125rem;
    color: var(--text);
    font-weight: 400;
    }

    .illustration {
    flex-shrink: 0;
    position: relative;
    }

    .illustration-img {
    width: 180px; /* Увеличил размер */
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    }

    /* Модерация */
    .moderation-notice {
    background: #f3e8ff;
    color: #7c3aed;
    border-left: 4px solid #a78bfa;
    padding: 15px 20px;
    border-radius: 12px;
    margin-bottom: 30px;
    font-size: 0.98rem;
    }

    /* Посты */
    .post-card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(124, 58, 237, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(124, 58, 237, 0.1);
    }

    .post-author {
    font-weight: 600;
    color: #7c3aed;
    font-size: 0.95rem;
    }

    .post-time {
    font-size: 0.85rem;
    color: #6b7280;
    margin-left: 10px;
    }

    .post-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    }

    .post-content {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 15px;
    color: #374151;
    }

    .post-meta {
    display: flex;
    gap: 15px;
    font-size: 0.9rem;
    color: #6b7280;
    }

    .emotion-badge {
    padding: 4px 12px;
    background: #e0e7ff;
    color: #4338ca;
    border-radius: 20px;
    font-weight: 500;
    }

    .category-badge {
    padding: 4px 12px;
    background: #e0e7ff;
    color: #4338ca;
    border-radius: 20px;
    font-weight: 500;
    }

    /* Dropdown для комментариев */
    .comments-toggle {
    background: none;
    border: none;
    color: #7c3aed;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 5px 0;
    margin-top: 10px;
    font-size: 0.95rem;
    }

    .comments-dropdown {
    margin-top: 15px;
    border-top: 1px solid #e5e7eb;
    padding-top: 15px;
    display: none; /* Скрыто по умолчанию */
    }

    .comments-dropdown.open {
    display: block; /* Показывается при открытии */
    }

    .comments-list {
    margin-bottom: 15px;
    }

    .comment {
    background: #f9fafb;
    border-radius: 10px;
    padding: 12px 15px;
    margin-bottom: 10px;
    }

    .comment-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
    font-size: 0.85rem;
    color: #6b7280;
    }

    .comment-author {
    font-weight: 600;
    color: #7c3aed;
    }

    .comment-content {
    font-size: 0.95rem;
    line-height: 1.5;
    color: #374151;
    }

    .comment-form {
    margin-top: 10px;
    }

    .form-group {
    margin-bottom: 10px;
    }

    .form-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 0.95rem;
    }

    .btn {
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    font-size: 0.9rem;
    cursor: pointer;
    background: #7c3aed;
    color: white;
    }

    .btn:hover {
    background: #6d28d9;
    }

    .footer {
    text-align: center;
    color: #a78bfa;
    font-size: 0.95rem;
    margin-top: 50px;
    padding: 30px;
    }

    /* Search & Filters */
    .search-filters {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 20px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 4px 15px rgba(124, 58, 237, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(124, 58, 237, 0.1);
    }
    .search-container {
    position: relative;
    margin-bottom: 20px;
    }
    .search-input {
    width: 100%;
    padding: 14px 50px 14px 20px;
    border: 2px solid rgba(124, 58, 237, 0.2);
    border-radius: 12px;
    font-size: 1rem;
    background: rgba(255, 255, 255, 0.8);
    transition: all 0.3s ease;
    }
    .search-input:focus {
    outline: none;
    border-color: #7c3aed;
    box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }
    .search-clear-btn {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #7c3aed;
    cursor: pointer;
    font-size: 1.2rem;
    display: none; /* Скрываем по умолчанию */
    }
    .filters-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 20px;
    }
    .filter-select {
    width: 100%;
    padding: 10px;
    border: 2px solid rgba(124, 58, 237, 0.2);
    border-radius: 12px;
    font-size: 1rem;
    background: rgba(255, 255, 255, 0.8);
    cursor: pointer;
    }
    .posts-container {
    min-height: 400px; /* Чтобы не "прыгало" при загрузке */
    }
    .loading-spinner {
    text-align: center;
    padding: 40px;
    display: none; /* Скрываем по умолчанию */
    }
@endsection

@section('content')
    <div class="container">
        <!-- Header с иллюстрацией -->
        <div class="header-section">
            <div class="header-content">
                <h1 data-i18n="home_title">Read Other's Stories</h1>
                <p data-i18n="home_subtitle">Get inspired by the experiences of others.</p>
                <a href="{{ route('posts.create') }}" class="btn" style="margin-top: 10px; display: inline-block;" data-i18n="home_get_started">✍️ Share Your Story</a>
            </div>
            <div class="illustration">
                <img src="{{ asset('img/5.png') }}" alt="Illustration" class="illustration-img">
            </div>
        </div>

        <!-- Уведомление о модерации -->
        <div class="moderation-notice" data-i18n="home_moderation_notice">
            <b>Moderation:</b> All posts and comments are reviewed by a moderator to ensure a safe, supportive environment. Harmful or abusive content will be removed.
        </div>

        <!-- Search & Filters -->
        <div class="search-filters">
            <div class="search-container">
                <input
                    type="text"
                    id="searchInput"
                    class="search-input"
                    data-i18n-placeholder="home_search_placeholder"
                    placeholder="Search posts..."
                    value="{{ request('q') }}"
                >
                <button id="searchClearBtn" class="search-clear-btn">×</button>
            </div>

            <div class="filters-container">
                <select id="categoryFilter" class="filter-select" data-i18n-placeholder="home_category_filter">
                    <option value="" data-i18n="home_all_categories">All Categories</option>
                    <option value="emotions" {{ request('category') == 'emotions' ? 'selected' : '' }} data-i18n="home_category_emotions">Emotions</option>
                    <option value="relationships" {{ request('category') == 'relationships' ? 'selected' : '' }} data-i18n="home_category_relationships">Relationships</option>
                    <option value="life" {{ request('category') == 'life' ? 'selected' : '' }} data-i18n="home_category_life">Life</option>
                    <option value="society" {{ request('category') == 'society' ? 'selected' : '' }} data-i18n="home_category_society">Society</option>
                    <option value="support" {{ request('category') == 'support' ? 'selected' : '' }} data-i18n="home_category_support">Support</option>
                </select>

                <select id="emotionFilter" class="filter-select" data-i18n-placeholder="home_emotion_filter">
                    <option value="" data-i18n="home_all_emotions">All Emotions</option>
                    <option value="sad" {{ request('emotion') == 'sad' ? 'selected' : '' }} data-i18n="home_emotion_sad">😕 Sad</option>
                    <option value="neutral" {{ request('emotion') == 'neutral' ? 'selected' : '' }} data-i18n="home_emotion_neutral">😐 Neutral</option>
                    <option value="happy" {{ request('emotion') == 'happy' ? 'selected' : '' }} data-i18n="home_emotion_happy">😊 Happy</option>
                </select>
            </div>
        </div>

        <!-- Posts List Container -->
        <div id="postsContainer" class="posts-container">
            @include('home.partials.posts-list')
        </div>

        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="loading-spinner">
            <div class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full text-[#7c3aed]" role="status">
                <span class="visually-hidden" data-i18n="loading">Loading...</span>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const searchClearBtn = document.getElementById('searchClearBtn');
            const categoryFilter = document.getElementById('categoryFilter');
            const emotionFilter = document.getElementById('emotionFilter');
            const postsContainer = document.getElementById('postsContainer');
            const loadingSpinner = document.getElementById('loadingSpinner');

            let debounceTimer;

            // Функция для обновления списка постов
            function fetchPosts() {
                const url = new URL("{{ route('home') }}", window.location.origin);
                const params = new URLSearchParams();

                if (searchInput.value) params.append('q', searchInput.value);
                if (categoryFilter.value) params.append('category', categoryFilter.value);
                if (emotionFilter.value) params.append('emotion', emotionFilter.value);

                url.search = params.toString();

                // Показываем спиннер
                loadingSpinner.style.display = 'block';
                postsContainer.style.opacity = '0.5';

                // Запрос к серверу
                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.text())
                    .then(html => {
                        postsContainer.innerHTML = html;
                        loadingSpinner.style.display = 'none';
                        postsContainer.style.opacity = '1';

                        // Обновляем URL в адресной строке без перезагрузки
                        window.history.replaceState({}, '', url);
                    })
                    .catch(error => {
                        console.error('Error fetching posts:', error);
                        loadingSpinner.style.display = 'none';
                        postsContainer.style.opacity = '1';
                    });
            }

            // Debounce для поиска
            searchInput.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(fetchPosts, 300); // 300ms delay

                // Показываем/скрываем кнопку очистки
                searchClearBtn.style.display = this.value ? 'block' : 'none';
            });

            // Очистка поиска
            searchClearBtn.addEventListener('click', function () {
                searchInput.value = '';
                this.style.display = 'none';
                fetchPosts();
            });

            // Фильтры
            categoryFilter.addEventListener('change', fetchPosts);
            emotionFilter.addEventListener('change', fetchPosts);

            // Показываем кнопку очистки, если поле не пустое при загрузке
            if (searchInput.value) {
                searchClearBtn.style.display = 'block';
            }
        });
    </script>
@endsection
