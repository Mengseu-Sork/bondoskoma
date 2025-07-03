<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        return response()->json(Video::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'video_file' => 'required|mimes:mp4,mov,avi,wmv|max:51200', // max:50MB
            'description' => 'nullable|string',
        ]);

        $path = $request->file('video_file')->store('videos', 'public');

        $video = Video::create([
            'video_file' => $path,
            'description' => $request->description,
        ]);

        return response()->json($video, 201);
    }

    public function show($id)
    {
        return response()->json(Video::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'video_file' => 'nullable|mimes:mp4,mov,avi,wmv|max:51200',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('video_file')) {
            Storage::disk('public')->delete($video->video_file);
            $path = $request->file('video_file')->store('videos', 'public');
            $video->video_file = $path;
        }

        $video->description = $request->description ?? $video->description;
        $video->save();

        return response()->json($video);
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        Storage::disk('public')->delete($video->video_file);
        $video->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}

