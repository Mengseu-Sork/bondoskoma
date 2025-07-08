<?php

namespace App\Http\Controllers;

use App\Models\JobAnnouncement;
use Illuminate\Http\Request;

class JobAnnouncementController extends Controller
{
    public function index()
    {
        return JobAnnouncement::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'posted_date' => 'required|date',
            'location' => 'required|string',
            'type' => 'required|string',
            'department' => 'required|string',
            'responsibilities' => 'required|array',
            'qualifications' => 'required|array',
        ]);

        return JobAnnouncement::create([
            ...$validated,
            'responsibilities' => json_encode($validated['responsibilities']),
            'qualifications' => json_encode($validated['qualifications']),
        ]);
    }

    public function show(JobAnnouncement $job)
    {
        return $job;
    }

    public function update(Request $request, JobAnnouncement $job)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'posted_date' => 'date',
            'location' => 'string',
            'type' => 'string',
            'department' => 'string',
            'responsibilities' => 'array',
            'qualifications' => 'array',
        ]);

        $job->update(array_merge(
            $validated,
            [
                'responsibilities' => isset($validated['responsibilities']) ? json_encode($validated['responsibilities']) : $job->responsibilities,
                'qualifications' => isset($validated['qualifications']) ? json_encode($validated['qualifications']) : $job->qualifications,
            ]
        ));

        return $job;
    }

    public function destroy(JobAnnouncement $job)
    {
        $job->delete();
        return response()->json([
            'message' => 'Job announcement deleted successfully.'
        ], 204);
    }
}
