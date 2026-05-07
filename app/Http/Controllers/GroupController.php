<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return Group::with(['diocese', 'responsible', 'associations', 'persons', 'media', 'personRoleAssignments'])->paginate();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'diocese_id' => 'required|exists:dioceses,id',
            'meeting_place' => 'nullable|string|max:255',
            'meeting_address' => 'nullable|string|max:255',
            'meeting_cap' => 'nullable|string|max:20',
            'meeting_city' => 'nullable|string|max:255',
            'meeting_province' => 'nullable|string|max:10',
            'meeting_day' => 'nullable|string|max:50',
            'meeting_time' => 'nullable|date_format:H:i',
            'responsible_id' => 'nullable|exists:persons,id',
            'association_ids' => 'nullable|array',
            'association_ids.*' => 'exists:associations,id',
            'persons' => 'nullable|array',
            'persons.*' => 'exists:persons,id',
        ]);

        $groupData = $request->only([
            'name', 'description', 'diocese_id', 'meeting_place', 'meeting_address',
            'meeting_cap', 'meeting_city', 'meeting_province', 'meeting_day', 'meeting_time', 'responsible_id'
        ]);
        
        $group = Group::create($groupData);

        if (!empty($data['association_ids'])) {
            $group->associations()->sync($data['association_ids']);
        }

        if ($request->has('persons')) {
            $personsData = [];
            foreach ($request->persons as $personId) {
                $personsData[$personId] = ['is_member_of_group' => true];
            }
            $group->persons()->sync($personsData);
        }

        return $group->load(['associations', 'persons']);
    }

    public function show(Group $group)
    {
        return $group->load(['diocese', 'responsible', 'associations', 'persons', 'media', 'personRoleAssignments']);
    }

    public function update(Request $request, Group $group)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'diocese_id' => 'sometimes|required|exists:dioceses,id',
            'meeting_place' => 'nullable|string|max:255',
            'meeting_address' => 'nullable|string|max:255',
            'meeting_cap' => 'nullable|string|max:20',
            'meeting_city' => 'nullable|string|max:255',
            'meeting_province' => 'nullable|string|max:10',
            'meeting_day' => 'nullable|string|max:50',
            'meeting_time' => 'nullable|date_format:H:i',
            'responsible_id' => 'nullable|exists:persons,id',
            'association_ids' => 'nullable|array',
            'association_ids.*' => 'exists:associations,id',
            'persons' => 'nullable|array',
            'persons.*' => 'exists:persons,id',
        ]);

        $groupData = $request->only([
            'name', 'description', 'diocese_id', 'meeting_place', 'meeting_address',
            'meeting_cap', 'meeting_city', 'meeting_province', 'meeting_day', 'meeting_time', 'responsible_id'
        ]);
        
        $group->update($groupData);

        if (array_key_exists('association_ids', $data)) {
            $group->associations()->sync($data['association_ids'] ?? []);
        }

        if ($request->has('persons')) {
            $personsData = [];
            foreach ($request->persons as $personId) {
                $personsData[$personId] = ['is_member_of_group' => true];
            }
            $group->persons()->sync($personsData);
        } else {
            $group->persons()->sync([]);
        }

        return $group->load(['associations', 'persons']);
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return response()->noContent();
    }

    public function attachAssociation(Request $request, Group $group)
    {
        $request->validate([
            'association_id' => 'required|exists:associations,id',
        ]);

        $group->associations()->syncWithoutDetaching([$request->association_id]);

        return response()->json(['success' => true, 'associations' => $group->associations()->get()]);
    }

    public function detachAssociation(Group $group, $associationId)
    {
        $group->associations()->detach($associationId);

        return response()->json(['success' => true, 'associations' => $group->associations()->get()]);
    }

    public function attachPerson(Request $request, Group $group)
    {
        $request->validate([
            'person_id' => 'required|exists:persons,id',
        ]);

        $group->persons()->syncWithoutDetaching([
            $request->person_id => ['is_member_of_group' => true]
        ]);

        return response()->json(['success' => true, 'persons' => $group->persons()->get()]);
    }

    public function detachPerson(Group $group, $personId)
    {
        $group->persons()->detach($personId);

        return response()->json(['success' => true, 'persons' => $group->persons()->get()]);
    }
}