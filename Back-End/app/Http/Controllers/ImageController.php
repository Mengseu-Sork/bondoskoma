<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        return response()->json(Image::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        // Store file
        $filePath = $request->file('image_file')->store('images', 'public');

        $image = Image::create([
            'image_file' => $filePath,
            'description' => $request->description,
        ]);

        return response()->json($image, 201);
    }

    public function show($id)
    {
        return response()->json(Image::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $image = Image::findOrFail($id);

        $request->validate([
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image_file')) {
            // Delete old image
            Storage::disk('public')->delete($image->image_file);
            $filePath = $request->file('image_file')->store('images', 'public');
            $image->image_file = $filePath;
        }

        $image->description = $request->description ?? $image->description;
        $image->save();

        return response()->json($image);
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        Storage::disk('public')->delete($image->image_file);
        $image->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
