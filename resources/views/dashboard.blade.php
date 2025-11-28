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
            text-align: center;
            margin-bottom: 40px;
        }
        .title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #7c3aed;
        }
        .subtitle {
            color: #6b7280;
            font-size: 1.1rem;
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
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 40px 0;
        }
        .stat {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.1);
            backdrop-filter: blur(10px);
        }
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #7c3aed;
        }
        .stat-label {
            color: #6b7280;
            font-size: 0.9rem;
        }
        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .tab {
            padding: 12px 24px;
            background: rgba(124, 58, 237, 0.1);
            color: #7c3aed;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .tab.active {
            background: #7c3aed;
            color: white;
        }
        .tab:hover {
            background: #7c3aed;
            color: white;
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
@endsection

@section('content')
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="title" data-i18n="admin_dashboard_title">🛡️ Admin Panel</h1>
            <p class="subtitle" data-i18n="admin_dashboard_subtitle">Moderate posts and reports.</p>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn" data-i18n="admin_logout">Logout</button>
            </form>
        </div>

        <!-- Stats -->
        <div class="stats">
            <div class="stat">
                <div class="stat-number">{{ $totalPosts }}</div>
                <div class="stat-label" data-i18n="admin_total_posts">Total Posts</div>
            </div>
            <div class="stat">
                <div class="stat-number">{{ $pendingPosts->count() }}</div>
                <div class="stat-label" data-i18n="admin_pending_posts">Pending Posts</div>
            </div>
            <div class="stat">
                <div class="stat-number">{{ $totalReports }}</div>
                <div class="stat-label" data-i18n="admin_total_reports">Reports</div>
            </div>
            <div class="stat">
                <div class="stat-number">{{ $totalUsers }}</div>
                <div class="stat-label" data-i18n="admin_total_users">Users</div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs">
            <button class="tab active" onclick="showTab('pending-posts')" data-i18n="admin_tab_pending_posts">📄 Pending Posts</button>
            <button class="tab" onclick="showTab('reports')" data-i18n="admin_tab_reports">🚨 Reports</button>
            <button class="tab" onclick="showTab('statistics')" data-i18n="admin_tab_statistics">📊 Statistics</button>
        </div>

        <!-- Content -->
        <div id="pending-posts" class="moderation-list">
            @foreach ($pendingPosts as $post)
                <div class="moderation-item">
                    <p class="moderation-content">{{ $post->content }}</p>
                    <div class="moderation-actions">
                        <form action="{{ route('moderate.approve.post', $post) }}" method="POST" style="display: inline;">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn-approve" data-i18n="admin_approve">Approve</button>
                        </form>
                        <form action="{{ route('moderate.delete.post', $post) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-reject" data-i18n="admin_delete">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
            @if($pendingPosts->isEmpty())
                <p data-i18n="admin_no_pending_posts">No posts pending approval.</p>
            @endif
        </div>

        <div id="reports" class="moderation-list" style="display: none;">
            @forelse ($reports as $report)
                <div class="moderation-item">
                    <p class="moderation-content">
                        <strong data-i18n="admin_reported">Reported:</strong> {{ $report->reported_type }} #{{ $report->reported_id }}<br>
                        <strong data-i18n="admin_reason">Reason:</strong> "{{ $report->reason }}"
                    </p>
                    <div class="moderation-actions">
                        <form action="{{ route('moderate.handle.report', $report) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-approve" data-i18n="admin_handle">Handle</button>
                        </form>
                        <form action="{{ route('moderate.handle.report', $report) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-reject" data-i18n="admin_dismiss">Dismiss</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="moderation-content text-muted" data-i18n="admin_no_reports">No reports to handle.</p>
            @endforelse
        </div>

        <div id="statistics" class="moderation-list" style="display: none;">
            <div class="moderation-item">
                <p><strong data-i18n="admin_total_posts">Total Posts:</strong> {{ $totalPosts }}</p>
                <p><strong data-i18n="admin_pending_posts">Pending Posts:</strong> {{ $pendingPosts->count() }}</p>
                <p><strong data-i18n="admin_total_reports">Total Reports:</strong> {{ $totalReports }}</p>
                <p><strong data-i18n="admin_total_users">Total Users:</strong> {{ $totalUsers }}</p>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            document.querySelectorAll('.moderation-list').forEach(tab => {
                tab.style.display = 'none';
            });
            document.getElementById(tabId).style.display = 'block';

            document.querySelectorAll('.tab').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
        }
    </script>
@endsection
