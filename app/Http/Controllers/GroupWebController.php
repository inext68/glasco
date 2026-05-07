<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupWebController extends Controller
{
    public function index()
    {
        $groups = Group::with('diocese', 'responsible')->paginate(10);
        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $persons = \App\Models\Person::orderBy('last_name')->orderBy('first_name')->get();
        $dioceses = \App\Models\Diocese::orderBy('name')->get();
        return view('groups.create', compact('persons', 'dioceses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'diocese_id' => 'nullable|exists:dioceses,id',
            'meeting_place' => 'nullable|string|max:255',
            'meeting_address' => 'nullable|string|max:255',
            'meeting_cap' => 'nullable|string|max:10',
            'meeting_city' => 'nullable|string|max:100',
            'meeting_province' => 'nullable|string|max:5',
            'meeting_day' => 'nullable|string|max:50',
            'meeting_time' => 'nullable|date_format:H:i',
            'responsible_id' => 'nullable|exists:persons,id',
        ]);

        Group::create($data);

        return redirect()->route('groups.index')->with('success', 'Gruppo creato con successo');
    }

    public function show(Group $group)
    {
        $group->load(['diocese', 'responsible', 'personRoleAssignments']);
        return view('groups.show', compact('group'));
    }

    public function edit(Group $group)
    {
        $persons = \App\Models\Person::orderBy('last_name')->orderBy('first_name')->get();
        $dioceses = \App\Models\Diocese::orderBy('name')->get();
        return view('groups.edit', compact('group', 'persons', 'dioceses'));
    }

    public function update(Request $request, Group $group)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'diocese_id' => 'nullable|exists:dioceses,id',
            'meeting_place' => 'nullable|string|max:255',
            'meeting_address' => 'nullable|string|max:255',
            'meeting_cap' => 'nullable|string|max:10',
            'meeting_city' => 'nullable|string|max:100',
            'meeting_province' => 'nullable|string|max:5',
            'meeting_day' => 'nullable|string|max:50',
            'meeting_time' => 'nullable|date_format:H:i',
            'responsible_id' => 'nullable|exists:persons,id',
        ]);

        $group->update($data);

        return redirect()->route('groups.index')->with('success', 'Gruppo aggiornato con successo');
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Gruppo eliminato con successo');
    }
}