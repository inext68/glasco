<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        return Person::with(['contacts', 'media', 'personRoleAssignments'])->paginate();
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

        return Person::create($data);
    }

    public function show(Person $person)
    {
        return $person->load(['contacts', 'media', 'personRoleAssignments']);
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

        return $person;
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return response()->noContent();
    }
}
