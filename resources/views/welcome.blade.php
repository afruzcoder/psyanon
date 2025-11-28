{{-- resources/views/welcome.blade.php --}}
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
        }
        .shadow-soft {
            box-shadow: 0 10px 30px rgba(31, 23, 76, 0.06);
        }
        .feature-card {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(124, 58, 237, 0.15);
        }
@endsection

@section('body_style')
    min-h-screen bg-[var(--bg)] text-[var(--ink)] antialiased
@endsection

@section('content')
    <!-- Hero -->
    <main>
        <section class="hat">
            <div class="txt">
                <div>
                    <h2><strong data-i18n="welcome_title">PsyAnon - a place where silence is heard</strong></h2>
                    <p data-i18n="welcome_subtitle">We created this platform so everyone can be heard, even while remaining anonymous.</p>
                </div>
                <button class="pbtn"><a href="{{ route('posts.create') }}" data-i18n="welcome_get_started">Get Started</a></button>
            </div>
            <div class="ib">
                <img src="{{ asset('img/5.png') }}" alt="Иллюстрация сообщества PsyAnon" width="80%" />
            </div>
        </section>

        <section class="aboutpro">
            <h2 data-i18n="welcome_about_title">About the project</h2>
            <p data-i18n="welcome_about_text">I decided to establish the PsyAnon platform to assist others. In the future. I aspire to be a psychologist, and this platform is my first step towards that aim. By establishing this place today, I can begin providing emotional support, creating a safe environment, and listening to those who need to be heard.</p>
            <div class="aBtns">
                <a href="{{ route('posts.create') }}">
                    <div>
                        <img src="{{ asset('img/i1.png') }}" alt="Иконка истории">
                        <h3 data-i18n="welcome_feature_share">Share your story</h3>
                    </div>
                </a>
                <a href="{{ route('home') }}">
                    <div>
                        <img src="{{ asset('img/i2.png') }}" alt="Иконка чтения">
                        <h3 data-i18n="welcome_feature_read">Read others stories</h3>
                    </div>
                </a>
                <a href="{{ route('report.create') }}">
                    <div>
                        <img src="{{ asset('img/i3.png') }}" alt="Иконка модерации">
                        <h3 data-i18n="welcome_feature_moderation">Moderations / Complaints</h3>
                    </div>
                </a>
                <a href="{{ route('home') }}">
                    <div>
                        <img src="{{ asset('img/i4.png') }}" alt="Иконка поддержки">
                        <h3 data-i18n="welcome_feature_supporters">Supporters</h3>
                    </div>
                </a>
            </div>
        </section>
    </main>
@endsection
