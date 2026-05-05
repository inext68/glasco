<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return Contact::with('person')->paginate();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'person_id' => 'required|exists:persons,id',
            'type' => 'required|string|in:phone,email,pec,whatsapp,telegram,address,social',
            'label' => 'nullable|string|max:100',
            'value' => 'required|string|max:255',
            'is_primary' => 'boolean',
        ]);

        return Contact::create($data);
    }

    public function show(Contact $contact)
    {
        return $contact->load('person');
    }

    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'person_id' => 'sometimes|required|exists:persons,id',
            'type' => 'sometimes|required|string|in:phone,email,pec,whatsapp,telegram,address,social',
            'label' => 'nullable|string|max:100',
            'value' => 'sometimes|required|string|max:255',
            'is_primary' => 'boolean',
        ]);

        $contact->update($data);

        return $contact;
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->noContent();
    }
}
