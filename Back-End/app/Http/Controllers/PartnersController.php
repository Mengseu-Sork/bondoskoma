<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnersController extends Controller
{
    // List all partners with image URL
    public function index()
    {
        $partners = Partners::all();

        $partners->transform(function ($partner) {
            $partner->image_url = $partner->image_file ? asset('storage/' . $partner->image_file) : null;
            return $partner;
        });

        return response()->json(['partners' => $partners]);
    }

    // Store a new partner
    public function store(Request $request)
    {
        $request->validate([
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('partners', 'public');
        }

        $partner = Partners::create([
            'image_file' => $imagePath,
        ]);

        return response()->json([
            'message' => 'Partner created successfully!',
            'data' => $partner,
            'image_url' => $imagePath ? asset('storage/' . $imagePath) : null,
        ], 201);
    }

    // ✅ Update partner image — replace old file and return new image URL only
    public function update(Request $request, $id)
    {
        $request->validate([
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $partner = Partners::findOrFail($id);

        if ($request->hasFile('image_file')) {
            // Delete old image if it exists
            if ($partner->image_file && Storage::disk('public')->exists($partner->image_file)) {
                Storage::disk('public')->delete($partner->image_file);
            }

            // Upload and store new image
            $newImagePath = $request->file('image_file')->store('partners', 'public');

            // Update image path in DB
            $partner->image_file = $newImagePath;
            $partner->save();
        }

        return response()->json([
            'message' => 'Partner updated successfully!',
            'image_url' => $partner->image_file ? asset('storage/' . $partner->image_file) : null,
        ]);
    }

    // Delete partner and their image
    public function destroy($id)
    {
        $partner = Partners::findOrFail($id);

        if ($partner->image_file && Storage::disk('public')->exists($partner->image_file)) {
            Storage::disk('public')->delete($partner->image_file);
        }

        $partner->delete();

        return response()->json([
            'message' => 'Partner deleted successfully!',
        ]);
    }
}
