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
            'image_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
            'description' => 'nullable|string',
        ]);

        $path = $request->file('image_file')->store('images', 'public');

        $image = Image::create([
            'image_file' => $path,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Image uploaded successfully',
            'url' => asset('storage/' . $path),
            'image' => $image,
        ]);
    }


    public function show($id)
    {
        return response()->json(Image::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        // Find the image record or return 404
        $image = Image::findOrFail($id);

        // Validate the request
        $request->validate([
            'image_file' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif|max:20480',
            'description' => 'sometimes|nullable|string',
        ]);

        // Handle image file update if a new file is uploaded
        if ($request->hasFile('image_file')) {
            // Delete the old file from storage
            if ($image->image_file && Storage::disk('public')->exists($image->image_file)) {
                Storage::disk('public')->delete($image->image_file);
            }

            // Store the new file and update the path
            $path = $request->file('image_file')->store('images', 'public');
            $image->image_file = $path;
        }

        // Update description if it's included in the request
        if ($request->has('description')) {
            $image->description = trim($request->input('description'));
        }

        // Save changes to the database
        $image->save();

        // Return JSON response with updated image and file URL
        return response()->json([
            'message' => 'Updated',
            'data' => $image->fresh(),
            'url' => asset('storage/' . $image->image_file),
        ]);
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        Storage::disk('public')->delete($image->image_file);
        $image->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
