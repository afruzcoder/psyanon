@extends('layouts.app')

@section('styles')
    :root {
    --bg: #f3f0ff;
    --form-bg: #fefefe;
    --primary: #8b5cf6;
    --primary-dark: #7c3aed;
    --text: #1e1b4b;
    --text-light: #a5b4fc;
    --emotion-bg: #e0e7ff;
    --shadow-soft: 0 4px 20px rgba(139, 92, 246, 0.1);
    }

    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }

    body {
    font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: var(--bg);
    color: var(--text);
    line-height: 1.6;
    min-height: 100vh;
    }

    .container {
    max-width: 420px;
    margin: 0 auto;
    padding: 0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    }

    /* Header section with illustration */
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
    width: 180px;
    height: 200px;
    }

    /* Form section */
    .form-section {
    background: var(--form-bg);
    flex: 1;
    padding: 2rem 1.5rem;
    border-radius: 30px 30px 0 0;
    margin-top: 1rem;
    }

    .form-group {
    margin-bottom: 2rem;
    }

    .form-label {
    display: block;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 1rem;
    }

    .form-input {
    width: 100%;
    padding: 1rem 1.25rem;
    border: none;
    border-radius: 15px;
    background: #f8fafc;
    font-size: 1rem;
    font-family: inherit;
    color: var(--text);
    transition: all 0.2s ease;
    }

    .form-input:focus {
    outline: none;
    background: #f1f5f9;
    box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.2);
    }

    .form-input::placeholder {
    color: var(--text-light);
    }

    .form-textarea {
    min-height: 100px;
    resize: vertical;
    }

    /* Emotions */
    .emotions-grid {
    display: flex;
    justify-content: center;
    gap: 1rem;
    }

    .emotion-option {
    position: relative;
    }

    .emotion-radio {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    }

    .emotion-label {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 70px;
    background: var(--primary);
    border-radius: 50%;
    font-size: 2rem;
    cursor: pointer;
    transition: all 0.2s ease;
    color: white; /* ← Важно: делает лицо белым */
    text-shadow: 0 0 0 3px var(--primary-dark); /* Эффект "выступающее лицо" */
    }

    .emotion-radio:checked + .emotion-label {
    background: var(--primary-dark);
    box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
    }

    .emotion-label:hover {
    transform: scale(1.05);
    }

    /* Select */
    .form-select {
    width: 100%;
    padding: 1rem 1.25rem;
    border: none;
    border-radius: 15px;
    background: #f8fafc;
    font-size: 1rem;
    font-family: inherit;
    color: var(--text);
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 12px center;
    background-repeat: no-repeat;
    background-size: 16px;
    }

    .form-select:focus {
    outline: none;
    background-color: #f1f5f9;
    box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.2);
    }

    /* Submit button */
    .submit-btn {
    width: 100%;
    padding: 1.25rem;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 15px;
    font-size: 1.125rem;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    transition: all 0.2s ease;
    margin-top: 1rem;
    }

    .submit-btn:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
    }

    .submit-btn:active {
    transform: translateY(0);
    }

    @media (max-width: 480px) {
    .header-section {
    padding: 1.5rem 1rem 1rem;
    }

    .header-content h1 {
    font-size: 2.25rem;
    }

    .illustration-img {
    width: 100px;
    height: 120px;
    }

    .form-section {
    padding: 1.5rem 1rem;
    }

    .emotion-label {
    width: 60px;
    height: 60px;
    font-size: 1.5rem;
    }
    }

    .error-message {
    color: #dc2626;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    }
@endsection

@section('content')
    <div class="container">
        <!-- Header with illustration -->
        <div class="header-section">
            <div class="header-content">
                <h1 data-i18n="post_header_title">Share your voice</h1>
                <p data-i18n="post_header_subtitle">Your story is worth being heard.</p>
            </div>
            <div class="illustration">
                <img src="{{ asset('images/Polish_20250829_133949374.png') }}" alt="Character illustration" class="illustration-img">
            </div>
        </div>

        <!-- Form section -->
        <div class="form-section">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="content" class="form-label" data-i18n="post_form_story_label">Your story</label>
                    <textarea
                        name="content"
                        id="content"
                        class="form-input form-textarea"
                        data-i18n-placeholder="post_form_story_placeholder"
                        placeholder="Start writing"
                        required
                    >{{ old('content') }}</textarea>
                    @error('content')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" data-i18n="post_form_emotion_label">Pick your emotions</label>
                    <div class="emotions-grid">
                        <div class="emotion-option">
                            <input type="radio" name="emotion" id="emotion-sad" value="sad"
                                   class="emotion-radio"
                                   {{ old('emotion') == 'sad' ? 'checked' : '' }} required>
                            <label for="emotion-sad" class="emotion-label">😕</label>
                        </div>
                        <div class="emotion-option">
                            <input type="radio" name="emotion" id="emotion-neutral" value="neutral"
                                   class="emotion-radio"
                                   {{ old('emotion') == 'neutral' ? 'checked' : '' }} required>
                            <label for="emotion-neutral" class="emotion-label">😐</label>
                        </div>
                        <div class="emotion-option">
                            <input type="radio" name="emotion" id="emotion-happy" value="happy"
                                   class="emotion-radio"
                                   {{ old('emotion') == 'happy' ? 'checked' : '' }} required>
                            <label for="emotion-happy" class="emotion-label">😊</label>
                        </div>
                    </div>
                    @error('emotion')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" data-i18n="post_form_category_label">Categories:</label>
                    <select name="category" class="form-select" required>
                        <option value="" data-i18n="post_form_category_placeholder">Choose categories:</option>
                        <option value="emotions" {{ old('category') == 'emotions' ? 'selected' : '' }} data-i18n="category_emotions">Emotions</option>
                        <option value="relationships" {{ old('category') == 'relationships' ? 'selected' : '' }} data-i18n="category_relationships">Relationships</option>
                        <option value="life" {{ old('category') == 'life' ? 'selected' : '' }} data-i18n="category_life">Life</option>
                        <option value="society" {{ old('category') == 'society' ? 'selected' : '' }} data-i18n="category_society">Society</option>
                        <option value="support" {{ old('category') == 'support' ? 'selected' : '' }} data-i18n="category_support">Support</option>
                    </select>
                    @error('category')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="submit-btn" data-i18n="post_form_submit">Continue</button>
            </form>
        </div>
    </div>
@endsection
