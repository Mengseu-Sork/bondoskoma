<?php

namespace App\Http\Controllers;

use App\Models\Donet;
use Illuminate\Http\Request;

class DonetController extends Controller
{
    public function index()
    {
        // Return all donations except those marked deleted
        $donations = Donet::where('status', '!=', Donet::STATUS_DELETED)->get();
        return response()->json($donations);
    }

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

        // Set default status to pending
        $validated['status'] = Donet::STATUS_PENDING;

        $donation = Donet::create($validated);
        return response()->json($donation, 201);
    }

    public function show($id)
    {
        $donation = Donet::findOrFail($id);

        // Optionally hide deleted donations
        if ($donation->isDeleted()) {
            return response()->json(['message' => 'Donation not found'], 404);
        }

        return response()->json($donation);
    }

    // Soft delete by setting status to deleted
    public function destroy($id)
    {
        $donation = Donet::findOrFail($id);
        $donation->status = Donet::STATUS_DELETED;
        $donation->save();

        return response()->json(['message' => 'Donation deleted successfully']);
    }

    // Confirm donation (for example, after payment verification)
    public function confirm($id)
    {
        $donation = Donet::findOrFail($id);
        $donation->status = Donet::STATUS_CONFIRMED;
        $donation->save();

        return response()->json(['message' => 'Donation confirmed successfully']);
    }
}
