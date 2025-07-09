<?php

namespace App\Http\Controllers;

use App\Models\Enhancement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EnhancementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Enhancement::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('enhancements', 'public');
        }

        $enhancement = Enhancement::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return response()->json([
            'status' => 'Enhancement created successfully',
            'data' => $enhancement,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enhancement $enhancement)
    {
        return response()->json($enhancement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enhancement $enhancement)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($enhancement->image) {
                Storage::disk('public')->delete($enhancement->image);
            }
            $enhancement->image = $request->file('image')->store('enhancements', 'public');
        }

        if ($request->has('title')) {
            $enhancement->title = $request->title;
        }

        if ($request->has('description')) {
            $enhancement->description = $request->description;
        }

        $enhancement->save();

        return response()->json([
            'status' => 'Enhancement updated successfully',
            'data' => $enhancement,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enhancement $enhancement)
    {
        if ($enhancement->image) {
            Storage::disk('public')->delete($enhancement->image);
        }

        $enhancement->delete();

        return response()->json([
            'status' => 'Enhancement deleted successfully'
        ]);
    }
}
