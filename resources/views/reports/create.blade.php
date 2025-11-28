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

        body {
            background: var(--bg);
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            color: #2d2d3a;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        /* Отдельный контейнер для выравнивания страницы с отчётом */
        .report-page {
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 500px;
            width: 100%;
            text-align: left;
        }
        /* Header with illustration (two columns) */
        .header-section {
            background: var(--bg);
            padding: 2rem 1.5rem 1.5rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        .header-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            gap: 15px;
        }
        .header-content h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--ink);
            margin: 0;
            line-height: 1.2;
        }
        .header-content p {
            font-size: 1rem;
            color: var(--muted);
            margin: 0;
        }
        .get-started-btn {
            background: var(--accent);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .get-started-btn:hover {
            background: var(--accent-600);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.3);
        }
        .illustration {
            flex-shrink: 0;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .illustration-img {
            width: 200px;
            height: auto;
            object-fit: contain;
        }

        /* Form */
        .form-card {
            background: var(--card);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(124, 58, 237, 0.1);
            border: 1px solid rgba(124, 58, 237, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 8px;
            font-size: 1.1rem;
        }
        .form-input {
            width: 100%;
            padding: 12px;
            border: 2px solid rgba(124, 58, 237, 0.2);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }
        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }
        .submit-btn {
            width: 100%;
            padding: 14px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(124, 58, 237, 0.3);
        }
@endsection

@section('content')
    <div class="report-page">
        <div class="container">
            <!-- Header with illustration (two columns) -->
            <div class="header-section">
                <div class="header-content">
                    <h1 data-i18n="report_title">Moderations / Complaints</h1>
                    <p data-i18n="report_subtitle">Report any issues with the platform</p>
                    <button class="get-started-btn" data-i18n="report_get_started">Get Started</button>
                </div>
                <div class="illustration">
                    <img src="{{ asset('images/upscaled_character.png') }}" alt="Character illustration" class="illustration-img">
                </div>
            </div>

            <!-- Form -->
            <div class="form-card">
                <form action="{{ route('report.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="subject" class="form-label" data-i18n="report_subject_label">Subject</label>
                        <input
                            type="text"
                            id="subject"
                            name="subject"
                            class="form-input"
                            required
                            data-i18n-placeholder="report_subject_placeholder"
                            placeholder="Enter subject"
                        >
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label" data-i18n="report_description_label">Describe the issue</label>
                        <textarea
                            id="description"
                            name="description"
                            class="form-input form-textarea"
                            required
                            data-i18n-placeholder="report_description_placeholder"
                            placeholder="Tell us what happened..."
                        ></textarea>
                    </div>
                    <button type="submit" class="submit-btn" data-i18n="report_submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
