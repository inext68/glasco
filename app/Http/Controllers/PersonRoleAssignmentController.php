<?php

namespace App\Http\Controllers;

use App\Models\PersonRoleAssignment;
use Illuminate\Http\Request;

class PersonRoleAssignmentController extends Controller
{
    public function index(Request $request)
    {
        $query = PersonRoleAssignment::with(['person', 'role', 'entity']);

        if ($request->filled('entity_type')) {
            $query->where('entity_type', $request->input('entity_type'));
        }

        if ($request->filled('entity_id')) {
            $query->where('entity_id', $request->input('entity_id'));
        }

        return $query->paginate();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'person_id' => 'required|exists:persons,id',
            'role_id' => 'required|exists:roles,id',
            'entity_id' => 'required|integer',
            'entity_type' => 'required|string|in:association,group,diocese,system',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'notes' => 'nullable|string',
        ]);

        return PersonRoleAssignment::create($data);
    }

    public function show(PersonRoleAssignment $personRoleAssignment)
    {
        return $personRoleAssignment->load(['person', 'role', 'entity']);
    }

    public function update(Request $request, PersonRoleAssignment $personRoleAssignment)
    {
        $data = $request->validate([
            'person_id' => 'sometimes|required|exists:persons,id',
            'role_id' => 'sometimes|required|exists:roles,id',
            'entity_id' => 'sometimes|required|integer',
            'entity_type' => 'sometimes|required|string|in:association,group,diocese,system',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'notes' => 'nullable|string',
        ]);

        $personRoleAssignment->update($data);

        return $personRoleAssignment;
    }

    public function destroy(PersonRoleAssignment $personRoleAssignment)
    {
        $personRoleAssignment->delete();

        return response()->noContent();
    }
}
