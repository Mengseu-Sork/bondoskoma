<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return response()->json(Video::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'video_file' => 'required|url', // Expecting a URL string now
            'description' => 'nullable|string',
        ]);

        $video = Video::create([
            'video_file' => $request->video_file,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Video link saved successfully',
            'data' => $video,
            'url' => $video->video_file, // The link itself
        ], 201);
    }

    public function show($id)
    {
        return response()->json(Video::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'video_file' => 'nullable|url',
            'description' => 'sometimes|nullable|string',
        ]);

        if ($request->has('video_file')) {
            $video->video_file = $request->input('video_file');
        }

        if ($request->has('description')) {
            $video->description = $request->input('description');
        }

        $video->save();

        return response()->json([
            'message' => 'Video link updated successfully',
            'data' => $video,
            'url' => $video->video_file,
        ]);
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
