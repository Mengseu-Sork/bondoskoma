<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\notification;

class ContactController extends Controller
{
    function index(){
        $conctact = Contact::all();
        return response()->json(['contact'=>$conctact]);
    }
    function show($id){
        $contact= Contact::find($id);
        return response()->json(['data'=>$contact]);
    }
   public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'paragraph' => 'required|string',
    ]);

    // Create and save contact
    $contact = Contact::create($validated);

    // Create a related notification
    Notification::create([
        'contact_id' => $contact->id,
    ]);

    return response()->json([
        'message' => 'Contact and notification saved successfully!',
        'contact' => $contact
    ], 201);
}
    function update(Request $request,$id){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'paragraph' => 'required|string',
        ]);
        $conctact = Contact::find($id);
        $conctact ->updated($validated);
        return response()->json([
            'message'=>"update successfull",
            'contact'=>$conctact
        ],200);
    }
    function destroy($id){
        $conctact = Contact::find($id);
        $conctact->delete();
        return response()->json([
            'message'=>"delete contact successfull",
        ],200);
    }
}
