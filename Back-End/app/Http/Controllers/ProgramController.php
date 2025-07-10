<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    public function index()
    {
        try {
            $programs = Program::orderBy('created_at', 'desc')->get();
            return response()->json($programs, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch programs',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4056',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('programs', 'public');
            }

            $program = Program::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imagePath,
            ]);

            return response()->json([
                'message' => 'Program created successfully',
                'data' => $program->fresh()
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create program',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $program = Program::findOrFail($id);
            return response()->json($program, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Program not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $program = Program::findOrFail($id);

            if ($request->has('title')) {
                $program->title = $request->title;
            }

            if ($request->has('description')) {
                $program->description = $request->description;
            }

            if ($request->hasFile('image')) {
                if ($program->image && Storage::disk('public')->exists($program->image)) {
                    Storage::disk('public')->delete($program->image);
                }

                $program->image = $request->file('image')->store('programs', 'public');
            }

            $program->save();

            return response()->json([
                'message' => 'Program updated successfully',
                'data' => $program->fresh()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update program',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $program = Program::findOrFail($id);

            if ($program->image && Storage::disk('public')->exists($program->image)) {
                Storage::disk('public')->delete($program->image);
            }

            $program->delete();

            return response()->json([
                'message' => 'Program deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete program',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

