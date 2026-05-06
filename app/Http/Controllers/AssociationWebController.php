<?php

namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;

class AssociationWebController extends Controller
{
    public function index()
    {
        $associations = Association::paginate(10);
        return view('associations.index', compact('associations'));
    }

    public function create()
    {
        return view('associations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nation' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'type' => 'nullable|string|max:50',
        ]);

        Association::create($data);

        return redirect()->route('associations.index')->with('success', 'Associazione creata con successo');
    }

    public function show(Association $association)
    {
        $association->load(['groups', 'personRoleAssignments']);
        return view('associations.show', compact('association'));
    }

    public function edit(Association $association)
    {
        return view('associations.edit', compact('association'));
    }

    public function update(Request $request, Association $association)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'nation' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'type' => 'nullable|string|max:50',
        ]);

        $association->update($data);

        return redirect()->route('associations.index')->with('success', 'Associazione aggiornata con successo');
    }

    public function destroy(Association $association)
    {
        $association->delete();

        return redirect()->route('associations.index')->with('success', 'Associazione eliminata con successo');
    }
}