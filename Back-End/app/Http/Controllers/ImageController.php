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
        $image = Image::findOrFail($id);

        $request->validate([
            'image_file' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif|max:20480',
            'description' => 'sometimes|nullable|string',
        ]);

        if ($request->hasFile('image_file')) {
            if ($image->image_file && Storage::disk('public')->exists($image->image_file)) {
                Storage::disk('public')->delete($image->image_file);
            }
            $path = $request->file('image_file')->store('images', 'public');
            $image->image_file = $path;
        }
        if ($request->has('description')) {
            $image->description = trim($request->input('description'));
        }

        $image->save();
        if (!$image->wasChanged()) {
            return response()->json(['message' => 'No changes made'], 200);
        }
        
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
