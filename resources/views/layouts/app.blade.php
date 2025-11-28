<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>PsyAnon</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="PsyAnon — анонимная платформа для деления историями, получения поддержки и помощи другим. Здесь каждый может быть услышан."/>
    <meta name="keywords" content="психология, анонимные истории, поддержка, PsyAnon"/>
    <meta name="author" content="PsyAnon Team"/>
    <meta property="og:title" content="PsyAnon - место, где слышно тишину"/>
    <meta property="og:description" content="Анонимная платформа для деления историями и получения поддержки"/>
    <meta property="og:image" content="{{ asset('img/5.png') }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url('/') }}"/>
    <link rel="icon" href="{{ asset('images/Polish_20250912_171930592.png') }}" type="image/png" sizes="128x128">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @yield('styles')
        /* Language Switcher */
        .language-switcher {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            gap: 8px;
            background: rgba(255, 255, 255, 0.85);
            padding: 6px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(124, 58, 237, 0.1);
        }

        .lang-btn {
            padding: 8px 16px;
            border: 2px solid transparent;
            background: transparent;
            color: #6b7280;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.25s ease;
            font-weight: 600;
            font-size: 0.9rem;
            line-height: 1;
        }

        .lang-btn:hover {
            color: #7c3aed;
            background: rgba(124, 58, 237, 0.05);
        }

        .lang-btn.active {
            background: #7c3aed;
            color: white;
            box-shadow: 0 2px 8px rgba(124, 58, 237, 0.3);
        }

        .lang-btn.active:hover {
            background: #6d28d9;
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="@yield('body_style')">
<header>
    <!-- Language Switcher -->
    <div class="language-switcher" style="position: fixed; top: 10px; right: 10px; z-index: 1000;">
        <button class="lang-btn" data-lang="en" onclick="changeLanguage('en')">EN</button>
        <button class="lang-btn" data-lang="ru" onclick="changeLanguage('ru')">RU</button>
    </div>

    <h1><a href='{{ route('welcome') }}' data-i18n="site_title">PsyAnon</a></h1>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}" data-i18n="nav_stories">Other Stories</a></li>
            <li><a href="{{ route('report.create') }}" data-i18n="nav_moderation">Moderation / Complaints</a></li>
            <li><a href="{{ route('about') }}" data-i18n="nav_about">About</a></li>
            <li><button class="pbtn"><a href="{{ route('posts.create') }}" data-i18n="nav_get_started">Get Started</a></button></li>
        </ul>
    </nav>
</header>
<main>
    @yield('content')
</main>
<footer>
    <div class="footer-container">
        <div class="footer-about">
            <h3 data-i18n="footer_title">PsyAnon</h3>
            <p data-i18n="footer_description">A safe anonymous space for sharing stories, receiving support, and helping others feel heard.</p>
        </div>
        <div class="footer-links">
            <h4 data-i18n="footer_quick_links">Quick Links</h4>
            <ul>
                <li><a href="{{ route('posts.create') }}" data-i18n="footer_share_story">Share your story</a></li>
                <li><a href="{{ route('home') }}" data-i18n="footer_read_stories">Read other stories</a></li>
                <li><a href="{{ route('report.create') }}" data-i18n="footer_moderation">Moderations / Complaints</a></li>
                <li><a href="{{ route('about') }}" data-i18n="footer_about">About</a></li>
            </ul>
        </div>
        <div class="footer-contact">
            <h4 data-i18n="footer_contact">Contact</h4>
            <p>Email: <a href="mailto:support@psyanon.org" data-i18n="footer_email">support@psyanon.org</a></p>
            <p>Telegram: <a href="#" data-i18n="footer_telegram">@psyanon</a></p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>
            <span data-i18n="footer_copyright">© 2025 PsyAnon. All rights reserved.</span>
            <a href="{{ route('login') }}" style="color: #7c3aed; text-decoration: none; font-weight: 600;" data-i18n="footer_admin_login">
                Admin Login
            </a>
        </p>
    </div>
</footer>

<!-- Language Switcher Script -->
<script>
    // Определяем язык по умолчанию
    let currentLang = localStorage.getItem('lang') || '{{ app()->getLocale() }}';

    // Функция переключения языка
    async function changeLanguage(lang) {
        currentLang = lang;
        localStorage.setItem('lang', lang);

        try {
            // Загружаем переводы
            const response = await fetch(`/lang/${lang}.json`);
            if (!response.ok) throw new Error('Failed to load language file');
            const translations = await response.json();

            // Применяем переводы ко всем элементам с data-i18n
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.getAttribute('data-i18n');
                if (translations[key]) {
                    el.textContent = translations[key];
                }
            });

            // Добавляем обработку placeholder'ов
            document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
                const key = el.getAttribute('data-i18n-placeholder');
                if (translations[key]) {
                    el.placeholder = translations[key]; // <-- Меняем placeholder
                }
            });

            // Обновляем кнопки переключения
            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`[data-lang="${lang}"]`).classList.add('active');
        } catch (error) {
            console.error('Error loading translations:', error);
        }
    }

    // При загрузке страницы — применяем текущий язык
    document.addEventListener('DOMContentLoaded', () => {
        changeLanguage(currentLang);
    });
</script>
</body>
</html>
