<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participant;
class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Participant::latest()->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => 'required|string|max:255',
            "email" => 'required|email|unique:participants,email',
            'skill' => 'required|string|max:100',
        ]);
        
        $participant = Participant::create($validate);
        return response()->json([
            "message" => "Participants were created",
            "data" => $participant
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $m = Participant::findOrFail($id);
        return response()->json($m);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $m = Participant::findOrFail($id);
        $validate = $request->validate([
            "name" => 'required|string|max:255',
            "email" => 'required|email|unique:participants,email' . $id,
            'skill' => 'required|string|max:100',
        ]);
        $m->update($validate);
        
        return response()->json([
            'message' => 'Participant updated successfully',
            'data' => $participant
        ]);
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $participant = Participant::findOrFail($id);

        $participant->delete();

        return response()->json([
            'message' => 'Participant deleted successfully'
        ]);
    }
}
