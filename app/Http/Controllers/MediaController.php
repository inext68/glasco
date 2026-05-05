<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\Diocese;
use App\Models\Group;
use App\Models\Media;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        return Media::with(['mediaable', 'uploadedBy'])->paginate();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'file' => 'required|file|max:10240',
            'mediaable_type' => 'required|string|in:person,association,diocese,group',
            'mediaable_id' => 'required|integer',
            'uploaded_by_person_id' => 'nullable|exists:persons,id',
        ]);

        $modelClass = match ($data['mediaable_type']) {
            'person' => Person::class,
            'association' => Association::class,
            'diocese' => Diocese::class,
            'group' => Group::class,
        };

        $mediaable = $modelClass::findOrFail($data['mediaable_id']);
        $path = $request->file('file')->store('media', 'public');

        return $mediaable->media()->create([
            'file_name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $path,
            'uploaded_by_person_id' => $data['uploaded_by_person_id'],
        ]);
    }

    public function show(Media $media)
    {
        return $media->load(['mediaable', 'uploadedBy']);
    }

    public function destroy(Media $media)
    {
        Storage::disk('public')->delete($media->file_path);
        $media->delete();

        return response()->noContent();
    }
}
