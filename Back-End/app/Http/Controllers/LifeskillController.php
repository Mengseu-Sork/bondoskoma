<?php

namespace App\Http\Controllers;

use App\Models\LifeSkill;
use Illuminate\Http\Request;

class LifeSkillController extends Controller
{
    public function index()
    {
        $lifeSkills = LifeSkill::all();
        return response()->json([
            'status' => 'List of life skills retrieved successfully',
            'data' => $lifeSkills
        ]);
    }
 
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $lifeSkill = LifeSkill::create($data);
        return response()->json($lifeSkill, 201);
    }

    public function show($id)
    {
        $lifeSkill = LifeSkill::findOrFail($id);
        return response()->json($lifeSkill);
    }

    public function update(Request $request, $id)
    {
        $lifeSkill = LifeSkill::findOrFail($id);

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
        ]);

        $lifeSkill->update($data);

        return response()->json([
            'message' => 'Life skill updated successfully',
            'data' => $lifeSkill,
        ]);
    }

    public function destroy($id)
    {
        $lifeSkill = LifeSkill::findOrFail($id);
        $lifeSkill->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}