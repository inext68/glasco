<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Role::paginate();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'context' => 'required|string|in:association,group,diocese,system',
            'description' => 'nullable|string',
            'is_primary' => 'boolean',
        ]);

        return Role::create($data);
    }

    public function show(Role $role)
    {
        return $role;
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'context' => 'sometimes|required|string|in:association,group,diocese,system',
            'description' => 'nullable|string',
            'is_primary' => 'boolean',
        ]);

        $role->update($data);

        return $role;
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->noContent();
    }
}
