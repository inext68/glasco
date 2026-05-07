<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Contact;
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
            'street' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:10',
            'document_type' => 'nullable|string|max:100',
            'document_number' => 'nullable|string|max:100',
            'updated_by_person_id' => 'nullable|exists:persons,id',
        ]);

        $person = Person::create($data);

        if ($request->has('contacts')) {
            foreach ($request->contacts as $contactData) {
                if (!empty($contactData['type']) && !empty($contactData['value'])) {
                    $person->contacts()->create([
                        'type' => $contactData['type'],
                        'label' => $contactData['label'] ?? null,
                        'value' => $contactData['value'],
                        'is_primary' => isset($contactData['is_primary']) ? true : false,
                    ]);
                }
            }
        }

        return $person;
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
            'street' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:10',
            'document_type' => 'nullable|string|max:100',
            'document_number' => 'nullable|string|max:100',
            'updated_by_person_id' => 'nullable|exists:persons,id',
        ]);

        $person->update($data);

        if ($request->has('contacts')) {
            $contactIds = [];
            
            foreach ($request->contacts as $contactData) {
                if (!empty($contactData['type']) && !empty($contactData['value'])) {
                    $contactAttributes = [
                        'type' => $contactData['type'],
                        'label' => $contactData['label'] ?? null,
                        'value' => $contactData['value'],
                        'is_primary' => isset($contactData['is_primary']) ? true : false,
                    ];
                    
                    if (!empty($contactData['id'])) {
                        $contact = Contact::where('id', $contactData['id'])
                            ->where('person_id', $person->id)
                            ->first();
                        if ($contact) {
                            $contact->update($contactAttributes);
                            $contactIds[] = $contact->id;
                        }
                    } else {
                        $newContact = $person->contacts()->create($contactAttributes);
                        $contactIds[] = $newContact->id;
                    }
                }
            }
            
            $person->contacts()->whereNotIn('id', $contactIds)->delete();
        } else {
            $person->contacts()->delete();
        }

        return $person;
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return response()->noContent();
    }
}