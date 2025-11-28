<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Report;
use App\Models\User;

class DashboardController extends Controller
{
    // app/Http/Controllers/DashboardController.php

    public function index()
    {
        if (! auth()->check() || ! auth()->user()->isAdmin()) {
            abort(403, 'Access denied.');
        }

        // Получаем коллекцию постов (не количество!)
        $pendingPosts = Post::where('is_approved', false)->get();
        $reports = Report::where('is_handled', false)->get();

        // Статистика — количество
        $totalPosts = Post::count();
        $totalReports = $reports->count();
        $totalUsers = User::count();

        return view('dashboard', compact(
            'totalPosts',
            'pendingPosts',
            'totalReports',
            'totalUsers',
            'reports'
        ));
    }
}
