<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;

class CompetitionController extends Controller
{
    public function index(Request $request)
    {
        $query = Competition::latest();

        // Bonus: Filter by category
        if ($request->filled('category')) {
            $query->where('category', 'like', '%' . $request->category . '%');
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $competition = Competition::create($validated);

        return response()->json([
            'message' => 'Competition created successfully',
            'data' => $competition,
        ], 201);
    }

    public function show(string $id)
    {
        $competition = Competition::findOrFail($id);

        return response()->json([
            'data' => $competition,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $competition = Competition::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|max:255',
            'capacity' => 'sometimes|required|integer|min:1',
            'description' => 'sometimes|nullable|string',
        ]);

        $competition->update($validated);

        return response()->json([
            'message' => 'Competition updated successfully',
            'data' => $competition->fresh(),
        ]);
    }

    public function destroy(string $id)
    {
        $competition = Competition::findOrFail($id);

        $competition->delete();

        return response()->json([
            'message' => 'Competition deleted successfully',
        ]);
    }
}
