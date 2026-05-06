<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleWebController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'context' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'is_primary' => 'nullable|boolean',
        ]);

        Role::create($data);

        return redirect()->route('roles.index')->with('success', 'Ruolo creato con successo');
    }

    public function show(Role $role)
    {
        $role->load('personRoleAssignments');
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'context' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'is_primary' => 'nullable|boolean',
        ]);

        $role->update($data);

        return redirect()->route('roles.index')->with('success', 'Ruolo aggiornato con successo');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Ruolo eliminato con successo');
    }
}