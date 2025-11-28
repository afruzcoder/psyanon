<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Moderate Reports — Safe Silence</title>
    @vite(['resources/css/app.css'])
    <style>
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
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--accent);
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
            color: var(--accent);
        }
        .stat-label {
            color: var(--muted);
            font-size: 0.9rem;
        }
        .reports-list {
            margin-top: 20px;
        }
        .report-item {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.1);
            backdrop-filter: blur(10px);
        }
        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .report-subject {
            font-weight: 600;
            color: var(--accent);
        }
        .report-time {
            font-size: 0.9rem;
            color: var(--muted);
        }
        .report-content {
            margin-bottom: 15px;
            line-height: 1.6;
            color: #374151;
        }
        .report-actions {
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
        <h1 class="title">📄 Moderate Reports</h1>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="stats">
        <div class="stat">
            <div class="stat-number">{{ $reports->count() }}</div>
            <div class="stat-label">Total Reports</div>
        </div>
        <div class="stat">
            <div class="stat-number">{{ $reports->where('is_handled', false)->count() }}</div>
            <div class="stat-label">Pending</div>
        </div>
    </div>

    <div class="reports-list">
        @forelse ($reports as $report)
            <div class="report-item">
                <div class="report-header">
                    <span class="report-subject">{{ $report->subject ?? 'No Subject' }}</span>
                    <span class="report-time">{{ $report->created_at->diffForHumans() }}</span>
                </div>
                <div class="report-content">
                    {{ $report->reason }}
                </div>
                <div class="report-actions">
                    @if (!$report->is_handled)
                        <form action="{{ route('moderate.handle.report', $report) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-approve">Handle</button>
                        </form>
                    @else
                        <span style="color: green; font-weight: 600;">Handled</span>
                    @endif
                </div>
            </div>
        @empty
            <p>No reports to handle.</p>
        @endforelse
    </div>
</div>
</body>
</html>
