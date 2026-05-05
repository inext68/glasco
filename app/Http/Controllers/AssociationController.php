<?php

namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    public function index()
    {
        return Association::with(['groups', 'media', 'personRoleAssignments'])->paginate();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nation' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'type' => 'nullable|string|max:100',
        ]);

        return Association::create($data);
    }

    public function show(Association $association)
    {
        return $association->load(['groups', 'media', 'personRoleAssignments']);
    }

    public function update(Request $request, Association $association)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'nation' => 'sometimes|required|string|max:255',
            'address' => 'nullable|string|max:500',
            'type' => 'nullable|string|max:100',
        ]);

        $association->update($data);

        return $association;
    }

    public function destroy(Association $association)
    {
        $association->delete();

        return response()->noContent();
    }
}
