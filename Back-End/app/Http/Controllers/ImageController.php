<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /**
     * Display a listing of images.
     */
    public function index()
    {
        try {
            $images = Image::orderBy('created_at', 'desc')->get();
            return response()->json($images, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch images',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created image.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $image = $request->file('image_file');
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // Store image in storage/app/public (your existing structure)
            $path = $image->storeAs('', $filename, 'public');

            $imageRecord = Image::create([
                'image_file' => $filename,
                'description' => $request->description
            ]);

            return response()->json([
                'message' => 'Image uploaded successfully',
                'image' => $imageRecord
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to upload image',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified image.
     */
    public function show($id)
    {
        try {
            $image = Image::findOrFail($id);
            return response()->json($image, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Image not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified image.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $image = Image::findOrFail($id);
            
            // Update description
            if ($request->has('description')) {
                $image->description = $request->description;
            }

            // Update image file if provided
            if ($request->hasFile('image_file')) {
                // Delete old image file
                if ($image->image_file && Storage::disk('public')->exists($image->image_file)) {
                    Storage::disk('public')->delete($image->image_file);
                }

                // Store new image
                $newImageFile = $request->file('image_file');
                $filename = time() . '_' . $newImageFile->getClientOriginalName();
                $newImageFile->storeAs('', $filename, 'public');

                $image->image_file = $filename;
            }

            $image->save();

            return response()->json([
                'message' => 'Image updated successfully',
                'image' => $image->fresh() // Reload to get updated accessors
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update image',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified image.
     */
    public function destroy($id)
    {
        try {
            $image = Image::findOrFail($id);
            
            // Delete image file from storage
            if ($image->image_file && Storage::disk('public')->exists($image->image_file)) {
                Storage::disk('public')->delete($image->image_file);
            }

            $image->delete();

            return response()->json([
                'message' => 'Image deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete image',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
