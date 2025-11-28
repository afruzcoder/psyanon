<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Moderate Posts — Safe Silence</title>
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
            --danger: #ef4444;
            --success: #10b981;
        }
        body {
            background: linear-gradient(135deg, #f6f6fa 0%, #ede9fe 100%);
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            color: #2d2d3a;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #7c3aed;
        }
        .logout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
        }
        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
        }
        .moderation-list {
            margin-top: 20px;
        }
        .moderation-item {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(124, 58, 237, 0.1);
        }
        .moderation-content {
            margin-bottom: 15px;
            line-height: 1.6;
            color: #374151;
        }
        .moderation-actions {
            display: flex;
            gap: 10px;
        }
        .btn-approve {
            background: #10b981;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
        }
        .btn-reject {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1 class="title">📄 Moderate Posts</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    @if($pendingPosts->isEmpty())
        <p>No posts pending approval.</p>
    @else
        @foreach($pendingPosts as $post)
            <div class="moderation-item">
                <p class="moderation-content">{{ $post->content }}</p>
                <div class="moderation-actions">
                    <form action="{{ route('moderate.approve.post', $post) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn-approve">Approve</button>
                    </form>
                    <form action="{{ route('moderate.delete.post', $post) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-reject">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
</body>
</html>
