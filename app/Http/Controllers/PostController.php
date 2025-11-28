<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Главная страница — лента постов (с поиском)
    public function index(Request $request)
    {
        $query = Post::where('is_approved', true);

        // Поиск
        if ($request->filled('q')) {
            $search = '%' . $request->input('q') . '%';
            $query->where('content', 'LIKE', $search);
        }

        // Фильтр по категории
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // Фильтр по эмоции
        if ($request->filled('emotion')) {
            $query->where('emotion', $request->input('emotion'));
        }

        $posts = $query->latest()->paginate(10);

        // Если это AJAX-запрос, возвращаем только список постов
        if ($request->ajax()) {
            return view('home.partials.posts-list', compact('posts'))->render();
        }

        // Иначе возвращаем полную страницу
        return view('home', compact('posts'));
    }

    // Форма создания поста
    public function create()
    {
        return view('posts.create');
    }

    // Сохранение поста
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'name' => 'nullable|string|max:50',
            'emotion' => 'required|in:sad,happy,neutral',
            'category' => 'required|in:emotions,relationships,life,society,support',
        ]);

        Post::create([
            'content' => $request->input('content'),
            'name' => $request->input('name'),
            'emotion' => $request->input('emotion'),
            'category' => $request->input('category'),
            'ip_address' => $request->ip(),
            'is_approved' => false,
        ]);

        return redirect()->route('home')->with('success', 'Спасибо. Твой пост появится после проверки.');
    }

    // Показ одного поста и комментариев
    public function show(Post $post)
    {
        if (! $post->is_approved) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }

    // Панель модерации (только для админа)
    public function moderate()
    {
        $pendingPosts = Post::where('is_approved', false)->latest()->get();
        return view('moderate.posts', compact('pendingPosts'));
    }

    // Одобрить пост
    public function approve(Post $post)
    {
        $post->update([
            'is_approved' => true,
            'approved_at' => now()
        ]);

        return back()->with('success', 'Пост опубликован.');
    }

    // Удалить пост
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Пост удалён.');
    }
}
