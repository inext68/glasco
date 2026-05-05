<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return Group::with(['diocese', 'associations', 'persons', 'media', 'personRoleAssignments'])->paginate();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'diocese_id' => 'required|exists:dioceses,id',
            'association_ids' => 'nullable|array',
            'association_ids.*' => 'exists:associations,id',
        ]);

        $group = Group::create($request->only('name', 'description', 'diocese_id'));

        if (! empty($data['association_ids'])) {
            $group->associations()->sync($data['association_ids']);
        }

        return $group->load('associations');
    }

    public function show(Group $group)
    {
        return $group->load(['diocese', 'associations', 'persons', 'media', 'personRoleAssignments']);
    }

    public function update(Request $request, Group $group)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'diocese_id' => 'sometimes|required|exists:dioceses,id',
            'association_ids' => 'nullable|array',
            'association_ids.*' => 'exists:associations,id',
        ]);

        $group->update($request->only('name', 'description', 'diocese_id'));

        if (array_key_exists('association_ids', $data)) {
            $group->associations()->sync($data['association_ids'] ?? []);
        }

        return $group->load('associations');
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return response()->noContent();
    }
}
