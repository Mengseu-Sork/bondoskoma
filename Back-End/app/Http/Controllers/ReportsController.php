<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reports;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
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
                'file_url' => $report->file_path ? asset('storage/' . $report->file_path) : null,
                'created_at' => $report->created_at,
                'updated_at' => $report->updated_at,
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            // Add logging for debugging
            Log::info('Update request received', [
                'id' => $id,
                'has_file' => $request->hasFile('file'),
                'request_data' => $request->except(['file'])
            ]);

            $report = Reports::findOrFail($id);
            
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'year' => 'required|integer|min:1900|max:' . date('Y'),
                'description' => 'required|string',
                'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            ]);

            // Update basic fields
            $report->title = $validated['title'];
            $report->year = $validated['year'];
            $report->description = $validated['description'];

            // Handle file upload
            if ($request->hasFile('file')) {
                Log::info('New file detected for upload');
                
                // Delete old file if exists
                if ($report->file_path && Storage::disk('public')->exists($report->file_path)) {
                    Storage::disk('public')->delete($report->file_path);
                    Log::info('Old file deleted', ['old_path' => $report->file_path]);
                }

                // Store new file
                $filePath = $request->file('file')->store('reports', 'public');
                $report->file_path = $filePath;
                Log::info('New file stored', ['new_path' => $filePath]);
            }

            // Save the report
            $saved = $report->save();
            Log::info('Report save result', ['saved' => $saved]);

            // Refresh the model to get updated data
            $report->refresh();

            return response()->json([
                'message' => 'Report updated successfully.',
                'data' => [
                    'id' => $report->id,
                    'title' => $report->title,
                    'year' => $report->year,
                    'description' => $report->description,
                    'file_path' => $report->file_path,
                    'file_url' => $report->file_path ? asset('storage/' . $report->file_path) : null,
                    'created_at' => $report->created_at,
                    'updated_at' => $report->updated_at,
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in update', ['errors' => $e->errors()]);
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error updating report', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Failed to update report',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ADD THIS MISSING DELETE METHOD
    public function destroy($id)
    {
        try {
            Log::info('Delete request received', ['id' => $id]);
            
            $report = Reports::findOrFail($id);
            
            // Delete associated file if exists
            if ($report->file_path && Storage::disk('public')->exists($report->file_path)) {
                $fileDeleted = Storage::disk('public')->delete($report->file_path);
                Log::info('File deletion result', [
                    'file_path' => $report->file_path,
                    'deleted' => $fileDeleted
                ]);
            }

            // Delete the report record
            $deleted = $report->delete();
            Log::info('Report deletion result', ['deleted' => $deleted]);

            return response()->json([
                'message' => 'Report deleted successfully.'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Report not found for deletion', ['id' => $id]);
            return response()->json([
                'message' => 'Report not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting report', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Failed to delete report',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}