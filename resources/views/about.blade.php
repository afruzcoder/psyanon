@extends('layouts.app')

@section('body_style')
    min-h-screen bg-[var(--bg)] text-[var(--ink)] antialiased
@endsection

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
@endsection

@section('content')
    <br><br>
    <main>
        <section class="about-site">
            <div class="about-columns">
                <div class="about-text">
                    <h1><strong data-i18n="about_title">About this website</strong></h1>
                    <p>
                        <strong>PsyAnon</strong>
                        <span data-i18n="about_intro">is a space where you can share your thoughts and feelings anonymously.</span>
                    </p>
                    <p data-i18n="about_here_you_can">Here you can:</p>
                    <ul>
                        <li data-i18n="about_action_write">Write your story;</li>
                        <li data-i18n="about_action_read">Read other's stories;</li>
                        <li data-i18n="about_action_support">Receive support;</li>
                        <li data-i18n="about_action_not_alone">Feel that you are not alone.</li>
                    </ul>
                    <p>
                        <strong data-i18n="about_important_strong">Important:</strong>
                        <span data-i18n="about_important_text">
                            This website is not a replacement for professional psychological services.
                            We don't offer therapy or medical advice.
                            If you are in danger, immediately contact a competent specialist from your local emergency services.
                        </span>
                    </p>
                </div>
                <div class="about-img">
                    <img src="{{ asset('img/4.png') }}" alt="Illustration PsyAnon">
                    <p data-i18n="about_project_goal">
                        This project was created with the aim of offering a safe, supportive community.
                        It is a first step toward creating an open space where every voice can be heard.
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection
