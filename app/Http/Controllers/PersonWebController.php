<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonWebController extends Controller
{
    public function index()
    {
        $persons = Person::with(['contacts', 'media', 'personRoleAssignments'])->paginate(10);
        
        $availableColumns = ['unique_code', 'first_name', 'last_name', 'birth_date', 'gender', 'city', 'contacts', 'created_at'];
        $columnLabels = [
            'unique_code' => 'Codice',
            'first_name' => 'Nome',
            'last_name' => 'Cognome',
            'birth_date' => 'Data di Nascita',
            'gender' => 'Genere',
            'city' => 'Città',
            'contacts' => 'Contatti',
            'created_at' => 'Creato il',
        ];
        
        $defaultColumns = ['unique_code', 'first_name', 'last_name', 'gender'];
        
        $user = Auth::user();
        $visibleColumns = $user && $user->column_settings 
            ? ($user->column_settings['persons_columns'] ?? $defaultColumns)
            : $defaultColumns;
        
        return view('persons.index', compact('persons', 'availableColumns', 'columnLabels', 'visibleColumns'));
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
        $person->load(['contacts', 'media', 'personRoleAssignments.role', 'groups']);
        return view('persons.show', compact('person'));
    }

    public function edit(Person $person)
    {
        $person->load(['contacts', 'personRoleAssignments.role']);
        $roles = \App\Models\Role::orderBy('name')->get();
        return view('persons.edit', compact('person', 'roles'));
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

    public function addContact(Request $request, Person $person)
    {
        $data = $request->validate([
            'type' => 'required|string|max:50',
            'label' => 'nullable|string|max:100',
            'value' => 'required|string|max:255',
            'is_primary' => 'nullable|boolean',
        ]);

        $data['is_primary'] = $request->has('is_primary');

        $contact = $person->contacts()->create($data);

        return response()->json(['success' => true, 'contact' => $contact]);
    }

    public function removeContact(Person $person, $contactId)
    {
        $contact = $person->contacts()->findOrFail($contactId);
        $contact->delete();

        return response()->json(['success' => true]);
    }
}