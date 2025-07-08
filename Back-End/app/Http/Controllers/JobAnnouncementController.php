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
<<<<<<< HEAD
        public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'jd' => 'required|string',
                'end_date' => 'required|date|after:today',
            ]);
            $job = JobAnnouncement::create($validated);
            return response()->json([
                'message' => 'Job announcement created successfully',
                'data' => $job
            ], 201);
        }
    public function update(Request $request, $id)   
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'jd' => 'required|string',
        'end_date' => 'required|date|after:today',
    ]);
=======
>>>>>>> 980bcff5e88ac751cfef912298b53e3c24bb83f7

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
