<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Лента постов
Route::get('/home', [PostController::class, 'index'])->name('home');

// Страница "О проекте"
Route::get('/about', [PageController::class, 'about'])->name('about');

// Гостевые маршруты
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/report', [ReportController::class, 'create'])->name('report.create');
Route::post('/report', [ReportController::class, 'store'])->name('report.store');

Route::get('/lang/{lang}.json', function ($lang) {
    $allowedLanguages = ['en', 'ru'];
    if (!in_array($lang, $allowedLanguages)) {
        abort(404);
    }

    $path = resource_path("lang/{$lang}.json");
    if (file_exists($path)) {
        return response()->file($path, ['Content-Type' => 'application/json']);
    }
    abort(404);
})->name('lang.json')->where('lang', 'en|ru');

// Только для админа — панель модерации
Route::middleware(['auth', 'admin'])->group(function () {
    // Главная админ-панель
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Модерация постов — в PostController
    Route::get('/moderate/posts', [PostController::class, 'moderate'])->name('moderate.posts');
    Route::patch('/moderate/posts/{post}/approve', [PostController::class, 'approve'])->name('moderate.approve.post');
    Route::delete('/moderate/posts/{post}', [PostController::class, 'destroy'])->name('moderate.delete.post');

    // Модерация жалоб — в ReportController
    Route::get('/moderate/reports', [ReportController::class, 'index'])->name('moderate.reports');
    Route::patch('/moderate/reports/{report}/handle', [ReportController::class, 'handle'])->name('moderate.handle.report');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Профиль (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
