<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Форма жалобы
    public function create()
    {
        return view('reports.create');
    }

    // Сохранение жалобы
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:100',
            'description' => 'required|string|max:1000',
        ]);

        Report::create([
            'reported_type' => $request->input('subject'), // Указываем тип "общая жалоба"
            'reported_id'   => 0,      // ID не используется
            'reason'        => $request->input('description'),
            'ip_address'    => $request->ip(),
            'is_handled'    => false,
        ]);

        return redirect()->route('home')->with('success', 'Thank you. Your report has been submitted.');
    }

    // Панель жалоб (только для админа)
    public function index()
    {
        $reports = Report::latest()->get();
        return view('moderate.reports', compact('reports'));
    }

    // Отметить как обработанную
    public function handle(Report $report)
    {
        $report->update(['is_handled' => true]);
        return back()->with('success', 'Report marked as handled.');
    }
}
