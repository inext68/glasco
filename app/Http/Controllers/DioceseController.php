<?php

namespace App\Http\Controllers;

use App\Models\Diocese;
use Illuminate\Http\Request;

class DioceseController extends Controller
{
    public function index()
    {
        return Diocese::with(['groups', 'media', 'personRoleAssignments'])->paginate();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'region' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        return Diocese::create($data);
    }

    public function show(Diocese $diocese)
    {
        return $diocese->load(['groups', 'media', 'personRoleAssignments']);
    }

    public function update(Request $request, Diocese $diocese)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'country' => 'sometimes|required|string|max:255',
            'region' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        $diocese->update($data);

        return $diocese;
    }

    public function destroy(Diocese $diocese)
    {
        $diocese->delete();

        return response()->noContent();
    }
}
