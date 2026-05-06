<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactWebController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('person')->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'person_id' => 'required|exists:persons,id',
            'type' => 'required|string|max:50',
            'label' => 'nullable|string|max:255',
            'value' => 'required|string|max:500',
            'is_primary' => 'nullable|boolean',
        ]);

        Contact::create($data);

        return redirect()->route('contacts.index')->with('success', 'Contatto creato con successo');
    }

    public function show(Contact $contact)
    {
        $contact->load('person');
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'person_id' => 'sometimes|required|exists:persons,id',
            'type' => 'sometimes|required|string|max:50',
            'label' => 'nullable|string|max:255',
            'value' => 'sometimes|required|string|max:500',
            'is_primary' => 'nullable|boolean',
        ]);

        $contact->update($data);

        return redirect()->route('contacts.index')->with('success', 'Contatto aggiornato con successo');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contatto eliminato con successo');
    }
}