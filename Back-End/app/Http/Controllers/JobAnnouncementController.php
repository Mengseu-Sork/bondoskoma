<?php

namespace App\Http\Controllers;

use App\Models\JobAnnouncement;
use Illuminate\Auth\Events\Validated;
use Illuminate\Foundation\Console\JobMakeCommand;
use Illuminate\Http\Request;

class JobAnnouncementController extends Controller
{
    function index(){
        $job= JobAnnouncement::all();
        return response()->json(['data'=>$job]);
    }
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

    $job = JobAnnouncement::findOrFail($id);
    $job->update($validated);

    return response()->json([
        'message' => 'Job announcement updated successfully',
        'data' => $job
    ], 200);
}
 function destroy($id){
    $job= JobAnnouncement::find($id);
    $job->delete();
    return response()->json(['message'=>"delelte successfull"],201);
 }
}
