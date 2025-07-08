<?php
namespace App\Http\Controllers;

use App\Models\Apply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplyController extends Controller
{
    // GET /applies
    public function index()
    {
        $applications = Apply::with('jobAnnouncement')->get();
        return response()->json($applications);
    }

    // GET /applies/{id}
    public function show($id)
    {
        $application = Apply::with('jobAnnouncement')->findOrFail($id);
        if (!$application) {
            return response()->json(['message' => 'Application not found'], 404);
        }
        return response()->json($application);
    }

    // POST /applies
    public function store(Request $request)
    {
        $request->validate([
            'job_announcements_id' => 'required|exists:job_announcements,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:20480',
        ]);

        // Store the file
        $path = $request->file('cv')->store('cvs', 'public');
        $originalFilename = $request->file('cv')->getClientOriginalName();

        // Save record
        $application = Apply::create([
            'job_announcements_id' => $request->job_announcements_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cv_file' => $originalFilename,
            'cv_path' => $path,
        ]);

        return response()->json([
            'message' => 'Application created',
            'application' => $application,
        ], 201);
    }

    // DELETE /applies/{id}
    public function destroy($id)
    {
        $application = Apply::find($id);
        if (!$application) {
            return response()->json(['message' => 'Application not found'], 404);
        }
        $application->delete();

        return response()->json(['message' => 'Application deleted']);
    }

}

