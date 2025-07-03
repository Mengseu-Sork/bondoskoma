<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return response()->json(Home::all());
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
            'paragraph1' => 'required|string',
            'paragraph2' => 'required|string',
        ]);

        $home->update($data);
        return response()->json($home);
    }

    public function destroy($id)
    {
        $home = Home::findOrFail($id);
        $home->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}

