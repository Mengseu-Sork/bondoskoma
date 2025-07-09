<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VolunteerController extends Controller
{
    public function index()
    {
        return Volunteer::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'role' => 'required|string',
            'bio' => 'nullable|string',
            'image' => 'nullable|file|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('volunteers', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $volunteer = Volunteer::create($data);

        return response()->json([
            'volunteer' => $volunteer,
            'url' => $volunteer->image_url,
        ], 201);
    }


    public function update(Request $request, Volunteer $volunteer)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'role' => 'required|string',
            'bio' => 'nullable|string',
            'image' => 'nullable|file|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('volunteers', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $volunteer->update($data);

        return response()->json([
            'volunteer' => $volunteer,
            'url' => $volunteer->image_url,
        ]);
    }

    public function destroy(Volunteer $volunteer)
    {
        // Delete image file if exists
        if ($volunteer->image) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $volunteer->image));
        }

        $volunteer->delete();

        return response()->noContent();
    }
}
