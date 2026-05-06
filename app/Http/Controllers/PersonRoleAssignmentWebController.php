<?php

namespace App\Http\Controllers;

use App\Models\PersonRoleAssignment;
use Illuminate\Http\Request;

class PersonRoleAssignmentWebController extends Controller
{
    public function index()
    {
        $assignments = PersonRoleAssignment::with(['person', 'role'])->paginate(10);
        return view('person role assignments.index', compact('assignments'));
    }

    public function create()
    {
        return view('person role assignments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'person_id' => 'required|exists:persons,id',
            'role_id' => 'required|exists:roles,id',
            'entity_id' => 'nullable|integer',
            'entity_type' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        PersonRoleAssignment::create($data);

        return redirect()->route('person-role-assignments.index')->with('success', 'Assegnazione creata con successo');
    }

    public function show(PersonRoleAssignment $personRoleAssignment)
    {
        $personRoleAssignment->load(['person', 'role']);
        return view('person role assignments.show', compact('personRoleAssignment'));
    }

    public function edit(PersonRoleAssignment $personRoleAssignment)
    {
        return view('person role assignments.edit', compact('personRoleAssignment'));
    }

    public function update(Request $request, PersonRoleAssignment $personRoleAssignment)
    {
        $data = $request->validate([
            'person_id' => 'sometimes|required|exists:persons,id',
            'role_id' => 'sometimes|required|exists:roles,id',
            'entity_id' => 'nullable|integer',
            'entity_type' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $personRoleAssignment->update($data);

        return redirect()->route('person-role-assignments.index')->with('success', 'Assegnazione aggiornata con successo');
    }

    public function destroy(PersonRoleAssignment $personRoleAssignment)
    {
        $personRoleAssignment->delete();

        return redirect()->route('person-role-assignments.index')->with('success', 'Assegnazione eliminata con successo');
    }
}