@forelse ($posts as $post)
    <div class="post-card">
        <div class="post-header">
            <span class="post-author">{{ $post->name ?: 'Anonymous' }}</span>
            <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
        </div>

        <div class="post-content">
            {{ $post->content }}
        </div>

        <div class="post-meta">
            <span class="emotion-badge">
                <span
                    class="emotion-text"
                    data-i18n="home_emotion_{{ strtolower($post->emotion ?? 'neutral') }}">
                    {{ ucfirst($post->emotion) }}
                </span>
            </span>
            <span
                class="category-badge"
                data-i18n="home_category_{{ strtolower($post->category ?? 'life') }}">
                {{ ucfirst($post->category) }}
            </span>
        </div>

        <!-- Dropdown для комментариев -->
        <button class="comments-toggle" onclick="toggleComments({{ $post->id }})" data-i18n="post_show_comments">
            💬 Show/Hide Comments
        </button>
        <div id="comments-dropdown-{{ $post->id }}" class="comments-dropdown">
            <div class="comments-list" id="comments-list-{{ $post->id }}">
                @forelse ($post->comments as $comment)
                    <div class="comment">
                        <div class="comment-header">
                            <span class="comment-author">{{ $comment->author ?? 'Support' }}</span>
                            <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="comment-content">
                            {{ $comment->content }}
                        </div>
                    </div>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="margin-top: 5px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-danger"
                                    data-i18n="comment_delete">
                                🗑 Delete
                            </button>
                        </form>
                    @endif
                @empty
                    <p class="text-muted" data-i18n="post_no_comments">No comments yet.</p>
                @endforelse
            </div>

            <!-- Форма добавления нового комментария -->
            <div class="comment-form">
                <form action="{{ route('comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="content" class="form-input" placeholder="Write a supportive comment..." rows="2" required data-i18n-placeholder="post_comment_placeholder"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" data-i18n="post_send_support">Send Support</button>
                </form>
                @if(session('success_comment_' . $post->id))
                    <div style="color: green; font-size: 0.9rem; margin-top: 5px;" data-i18n="post_comment_submitted">
                        Comment submitted and pending approval!
                    </div>
                @endif
            </div>
        </div>
    </div>
@empty
    <p class="text-center text-[var(--muted)]" data-i18n="home_no_posts">No posts to show yet.</p>
@endforelse

<!-- Пагинация -->
@if ($posts->hasPages())
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
@endif

<script>
    function toggleComments(postId) {
        const dropdown = document.getElementById(`comments-dropdown-${postId}`);
        dropdown.classList.toggle('open');
    }
</script>
