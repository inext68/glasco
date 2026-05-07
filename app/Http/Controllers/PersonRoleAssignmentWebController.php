<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Association;
use App\Models\Group;
use App\Models\Diocese;
use App\Models\PersonRoleAssignment;
use App\Models\Role;
use Illuminate\Http\Request;

class PersonRoleAssignmentWebController extends Controller
{
    protected $entityTypes = [
        'association' => Association::class,
        'group' => Group::class,
        'diocese' => Diocese::class,
    ];

    public function index()
    {
        $assignments = PersonRoleAssignment::with(['person', 'role', 'entity'])->paginate(10);
        return view('person role assignments.index', compact('assignments'));
    }

    public function create()
    {
        $persons = Person::orderBy('last_name')->orderBy('first_name')->get();
        $roles = Role::all();
        $entityTypes = array_keys($this->entityTypes);
        return view('person role assignments.create', compact('persons', 'roles', 'entityTypes'));
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

        if ($data['entity_type'] && $data['entity_id']) {
            $entityClass = $this->entityTypes[$data['entity_type']] ?? null;
            if ($entityClass) {
                $data['entity_type'] = $entityClass;
                $data['entity_id'] = $entityClass::find($data['entity_id'])?->id;
            }
        } else {
            $data['entity_id'] = null;
            $data['entity_type'] = null;
        }

        PersonRoleAssignment::create($data);

        return redirect()->route('person-role-assignments.index')->with('success', 'Assegnazione creata con successo');
    }

    public function show(PersonRoleAssignment $personRoleAssignment)
    {
        $personRoleAssignment->load(['person', 'role', 'entity']);
        return view('person role assignments.show', compact('personRoleAssignment'));
    }

    public function edit(PersonRoleAssignment $personRoleAssignment)
    {
        $persons = Person::orderBy('last_name')->orderBy('first_name')->get();
        $roles = Role::all();
        $entityTypes = array_keys($this->entityTypes);
        return view('person role assignments.edit', compact('personRoleAssignment', 'persons', 'roles', 'entityTypes'));
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

        if ($data['entity_type'] && $data['entity_id']) {
            $entityClass = $this->entityTypes[$data['entity_type']] ?? null;
            if ($entityClass) {
                $data['entity_type'] = $entityClass;
                $data['entity_id'] = $entityClass::find($data['entity_id'])?->id;
            }
        } else {
            $data['entity_id'] = null;
            $data['entity_type'] = null;
        }

        $personRoleAssignment->update($data);

        return redirect()->route('person-role-assignments.index')->with('success', 'Assegnazione aggiornata con successo');
    }

    public function destroy(PersonRoleAssignment $personRoleAssignment)
    {
        $personRoleAssignment->delete();

        return redirect()->route('person-role-assignments.index')->with('success', 'Assegnazione eliminata con successo');
    }

    public function entities(Request $request)
    {
        $type = $request->query('type');
        $entityClass = $this->entityTypes[$type] ?? null;

        if (!$entityClass) {
            return response()->json([]);
        }

        $entities = $entityClass::select('id', 'name')->orderBy('name')->get();
        return response()->json($entities);
    }
}