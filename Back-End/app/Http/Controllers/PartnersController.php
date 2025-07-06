<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnersController extends Controller
{
    // 📄 List all partners with full image URL
    public function index()
    {
        $partners = Partners::all();

        $partners->transform(function ($partner) {
            $partner->image_url = $partner->image_file ? asset('storage/' . $partner->image_file) : null;
            return $partner;
        });

        return response()->json(['partners' => $partners]);
    }

    // 🔍 Get a single partner by ID
    public function show($id)
    {
        $partner = Partners::findOrFail($id);
        $partner->image_url = $partner->image_file ? asset('storage/' . $partner->image_file) : null;

        return response()->json(['data' => $partner]);
    }

    // ➕ Store a new partner (image optional)
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

    // ✏️ Update partner image
    public function update(Request $request, $id)
    {
        $request->validate([
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $partner = Partners::findOrFail($id);

        if ($request->hasFile('image_file')) {
            // Delete old image
            if ($partner->image_file && Storage::disk('public')->exists($partner->image_file)) {
                Storage::disk('public')->delete($partner->image_file);
            }

            // Store new image
            $newImagePath = $request->file('image_file')->store('partners', 'public');
            $partner->image_file = $newImagePath;
            $partner->save();
        }

        return response()->json([
            'message' => 'Partner updated successfully!',
            'data' => $partner,
            'image_url' => $partner->image_file ? asset('storage/' . $partner->image_file) : null,
        ]);
    }

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
