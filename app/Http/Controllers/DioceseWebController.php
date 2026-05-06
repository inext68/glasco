<?php

namespace App\Http\Controllers;

use App\Models\Diocese;
use Illuminate\Http\Request;

class DioceseWebController extends Controller
{
    public function index()
    {
        $dioceses = Diocese::paginate(10);
        return view('dioceses.index', compact('dioceses'));
    }

    public function create()
    {
        return view('dioceses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:100',
            'region' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
        ]);

        Diocese::create($data);

        return redirect()->route('dioceses.index')->with('success', 'Diocesi creata con successo');
    }

    public function show(Diocese $diocese)
    {
        $diocese->load(['groups', 'personRoleAssignments']);
        return view('dioceses.show', compact('diocese'));
    }

    public function edit(Diocese $diocese)
    {
        return view('dioceses.edit', compact('diocese'));
    }

    public function update(Request $request, Diocese $diocese)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'country' => 'nullable|string|max:100',
            'region' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
        ]);

        $diocese->update($data);

        return redirect()->route('dioceses.index')->with('success', 'Diocesi aggiornata con successo');
    }

    public function destroy(Diocese $diocese)
    {
        $diocese->delete();

        return redirect()->route('dioceses.index')->with('success', 'Diocesi eliminata con successo');
    }
}