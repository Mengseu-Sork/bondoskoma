<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $homes = Home::orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'List of homes retrieved successfully',
            'data' => $homes
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'paragraph1' => 'required|string',
            'paragraph2' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $data['image'] = $request->file('image')->storeAs('homes', $imageName, 'public');
        }

        $home = Home::create($data);

        return response()->json([
            'message' => 'Home created successfully',
            'data' => $home
        ], 201);
    }

    public function show($id)
    {
        $home = Home::findOrFail($id);
        return response()->json($home);
    }

    public function update(Request $request, $id)
    {
        $home = Home::findOrFail($id);

        $data = $request->validate([
            'paragraph1' => 'sometimes|required|string',
            'paragraph2' => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // delete old image
            if ($home->image && Storage::disk('public')->exists($home->image)) {
                Storage::disk('public')->delete($home->image);
            }

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $data['image'] = $request->file('image')->storeAs('homes', $imageName, 'public');
        }

        $home->update($data);

        return response()->json([
            'message' => 'Home updated successfully',
            'data' => $home
        ]);
    }

    public function destroy($id)
    {
        $home = Home::findOrFail($id);

        // delete image from storage
        if ($home->image && Storage::disk('public')->exists($home->image)) {
            Storage::disk('public')->delete($home->image);
        }

        $home->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
