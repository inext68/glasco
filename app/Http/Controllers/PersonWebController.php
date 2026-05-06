<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonWebController extends Controller
{
    public function index()
    {
        $persons = Person::with(['contacts', 'media', 'personRoleAssignments'])->paginate(10);
        return view('persons.index', compact('persons'));
    }

    public function create()
    {
        return view('persons.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'updated_by_person_id' => 'nullable|exists:persons,id',
        ]);

        Person::create($data);

        return redirect()->route('persons.index')->with('success', 'Persona creata con successo');
    }

    public function show(Person $person)
    {
        $person->load(['contacts', 'media', 'personRoleAssignments.role']);
        return view('persons.show', compact('person'));
    }

    public function edit(Person $person)
    {
        return view('persons.edit', compact('person'));
    }

    public function update(Request $request, Person $person)
    {
        $data = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'updated_by_person_id' => 'nullable|exists:persons,id',
        ]);

        $person->update($data);

        return redirect()->route('persons.index')->with('success', 'Persona aggiornata con successo');
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return redirect()->route('persons.index')->with('success', 'Persona eliminata con successo');
    }
}