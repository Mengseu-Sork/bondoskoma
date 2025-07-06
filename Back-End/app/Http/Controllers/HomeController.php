<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $homes = Home::all();
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
        ]);

        $home = Home::create($data);
        return response()->json($home, 201);
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
        ]);

        $home->update($data);

        return response()->json([
            'message' => 'Home updated successfully',
            'data' => $home,
        ]);
    }


    public function destroy($id)
    {
        $home = Home::findOrFail($id);
        $home->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}

