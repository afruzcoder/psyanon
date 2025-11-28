<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title data-i18n="login_page_title">Admin Login — PsyAnon</title>
    <link rel="icon" href="{{ asset('images/Polish_20250912_171930592.png') }}" type="image/png" sizes="64x64">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg: #F4ECFF;
            --card: #FFFFFF;
            --ink: #1F174C;
            --muted: #6E5CA6;
            --accent: #6B53CE;
            --accent-600: #5B47B6;
            --chip: #E9E0FF;
        }
        body {
            background: linear-gradient(135deg, #f6f6fa 0%, #ede9fe 100%);
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            color: #2d2d3a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(124, 58, 237, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(124, 58, 237, 0.1);
        }
        .login-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #7c3aed;
            text-align: center;
            margin-bottom: 24px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
        }
        .form-input {
            width: 100%;
            padding: 15px;
            border: 2px solid rgba(124, 58, 237, 0.2);
            border-radius: 12px;
            font-size: 1rem;
            background: white;
            transition: all 0.3s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }
        .btn-primary {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(124, 58, 237, 0.3);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo h1 {
            font-size: 2.5rem;
            color: #7c3aed;
            margin: 0;
        }
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
<body>
<div class="login-container">
    <div class="logo">
        <h1>PsyAnon</h1>
    </div>

    <h2 class="login-title" data-i18n="login_title">Admin Login</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <label for="email" class="form-label" data-i18n="email_label">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                class="form-input"
                data-i18n-placeholder="email_placeholder"
                placeholder="Enter your email"
            >
            @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label" data-i18n="password_label">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="form-input"
                data-i18n-placeholder="password_placeholder"
                placeholder="Enter your password"
            >
            @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="mt-6">
            <button type="submit" class="btn-primary" data-i18n="login_button">
                Log In
            </button>
        </div>
    </form>

    <!-- Ссылка на главную -->
    <div class="mt-6 text-center">
        <a href="{{ route('welcome') }}" class="text-[var(--muted)] hover:text-[#7c3aed] text-sm" data-i18n="back_home">
            ← Back to Home
        </a>
    </div>

    <!-- Переключатель языка -->
    <div class="language-switcher" style="position: fixed; top: 10px; right: 10px; z-index: 1000;">
        <button class="lang-btn" data-lang="en" onclick="changeLanguage('en')">EN</button>
        <button class="lang-btn" data-lang="ru" onclick="changeLanguage('ru')">RU</button>
    </div>
</div>

<script>
    let currentLang = localStorage.getItem('lang') || 'en';

    async function changeLanguage(lang) {
        currentLang = lang;
        localStorage.setItem('lang', lang);

        const response = await fetch(`/lang/${lang}.json`);
        const translations = await response.json();

        // Тексты
        document.querySelectorAll('[data-i18n]').forEach(el => {
            const key = el.getAttribute('data-i18n');
            if (translations[key]) el.textContent = translations[key];
        });

        // Placeholder'ы
        document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
            const key = el.getAttribute('data-i18n-placeholder');
            if (translations[key]) el.placeholder = translations[key];
        });

        // Подсветка активной кнопки
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        const activeBtn = document.querySelector(`[data-lang="${lang}"]`);
        if (activeBtn) activeBtn.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', () => {
        changeLanguage(currentLang);
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.addEventListener('click', () => changeLanguage(btn.dataset.lang));
        });
    });
</script>
</body>
</html>
