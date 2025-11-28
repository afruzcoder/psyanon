<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:300',
        ]);

        $post->comments()->create([
            'content' => $request->input('content'),
            'ip_address' => $request->ip(),
        ]);

        return back();
    }

    public function destroy(Comment $comment)
    {
        // Middleware admin уже проверит
        $comment->delete();

        return back()->with('success', 'Комментарий удалён.');
    }
}
