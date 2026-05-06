<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaWebController extends Controller
{
    public function index()
    {
        $media = Media::with('mediaable')->paginate(10);
        return view('media.index', compact('media'));
    }

    public function create()
    {
        return view('media.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'file' => 'required|file|max:10240',
            'mediaable_type' => 'required|string|in:person,association,diocese,group',
            'mediaable_id' => 'required|integer',
            'uploaded_by_person_id' => 'nullable|exists:persons,id',
        ]);

        return response()->json(['message' => 'Use API for file upload']);
    }

    public function show(Media $media)
    {
        $media->load('mediaable');
        return view('media.show', compact('media'));
    }

    public function destroy(Media $media)
    {
        $media->delete();

        return redirect()->route('media.index')->with('success', 'Media eliminato con successo');
    }
}