<?php

namespace App\Http\Controllers;

use App\Models\Strategy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrategyController extends Controller
{
    /**
     * Display a listing of the strategies.
     */
    public function index()
    {
        return response()->json(Strategy::all());
    }

    /**
     * Store a newly created strategy in storage.
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
            $imagePath = $request->file('image')->store('strategies', 'public');
        }

        $strategy = Strategy::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return response()->json([
            'status' => 'Strategy created successfully',
            'data' => $strategy,
        ]);
    }

    /**
     * Display the specified strategy.
     */
    public function show(Strategy $strategy)
    {
        return response()->json($strategy);
    }

    /**
     * Update the specified strategy in storage.
     */
    public function update(Request $request, Strategy $strategy)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($strategy->image) {
                Storage::disk('public')->delete($strategy->image);
            }
            $strategy->image = $request->file('image')->store('strategies', 'public');
        }

        if ($request->has('title')) {
            $strategy->title = $request->title;
        }

        if ($request->has('description')) {
            $strategy->description = $request->description;
        }

        $strategy->save();

        return response()->json([
            'status' => 'Strategy updated successfully',
            'data' => $strategy,
        ]);
    }

    /**
     * Remove the specified strategy from storage.
     */
    public function destroy(Strategy $strategy)
    {
        if ($strategy->image) {
            Storage::disk('public')->delete($strategy->image);
        }

        $strategy->delete();

        return response()->json(['message' => 'Strategy deleted successfully']);
    }
}
