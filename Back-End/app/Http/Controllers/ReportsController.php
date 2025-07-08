<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reports;
use Illuminate\Support\Facades\Storage;

class ReportsController extends Controller
{
   public function index()
    {
        $reports = Reports::all();

        // Add full URL for each file
        foreach ($reports as $report) {
            if ($report->file_path) {
                $report->file_url = asset('storage/' . $report->file_path);
            } else {
                $report->file_url = null;
            }
        }

        return response()->json(["data" => $reports]);
    }
    public function show($id)
    {
        $report = Reports::findOrFail($id);

        $report->file_url = $report->file_path
            ? asset('storage/' . $report->file_path)
            : null;

        return response()->json(['data' => $report]);
    }
   public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'year' => 'required|integer|min:1900|max:' . date('Y'),
        'description' => 'required|string',
        'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // <-- changed here
    ]);

    $report = new Reports();
    $report->title = $validated['title'];
    $report->year = $validated['year'];
    $report->description = $validated['description'];

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('reports', 'public');
        $report->file_path = $filePath;
    }

    $report->save();

    return response()->json([
        'message' => 'Report created successfully.',
        'data' => [
            'id' => $report->id,
            'title' => $report->title,
            'year' => $report->year,
            'description' => $report->description,
            'file_path' => $report->file_path,
            'file_url' => $report->file_path ? asset('storage/' . $report->file_path) : null
        ]
    ]);
}
 public function update(Request $request, $id)
    {
        $report = Reports::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $report->title = $validated['title'];
        $report->year = $validated['year'];
        $report->description = $validated['description'];

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($report->file_path && Storage::disk('public')->exists($report->file_path)) {
                Storage::disk('public')->delete($report->file_path);
            }

            // Store new file
            $filePath = $request->file('file')->store('reports', 'public');
            $report->file_path = $filePath;
        }

        $report->save();

        return response()->json([
            'message' => 'Report updated successfully.',
            'data' => $report,
            'file_url' => $report->file_path ? asset('storage/' . $report->file_path) : null,
        ]);
    }
}


