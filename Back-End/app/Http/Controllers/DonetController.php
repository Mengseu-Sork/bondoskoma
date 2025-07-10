<?php

namespace App\Http\Controllers;

use App\Models\Donet;
use Illuminate\Http\Request;

class DonetController extends Controller
{
    public function index()
    {
        return response()->json(Donet::all());
    }

    // Store new donation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'is_monthly' => 'boolean',
            'payment_method' => 'required|string|max:100',
            'first_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
        ]);

        $donation = Donet::create($validated);
        return response()->json($donation, 201);
    }

    // Show specific donation
    public function show($id)
    {
        $donation = Donet::findOrFail($id);
        return response()->json($donation);
    }

    // Delete donation
    public function destroy($id)
    {
        $donation = Donet::findOrFail($id);
        $donation->delete();
        return response()->json(['message' => 'Donation deleted successfully']);
    }
}
