<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\Diocese;
use App\Models\Group;
use App\Models\Media;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MediaWebController extends Controller
{
    public function index()
    {
        $media = Media::with('mediaable', 'uploadedBy')->paginate(10);
        return view('media.index', compact('media'));
    }

    public function create()
    {
        $persons = Person::orderBy('surname')->orderBy('name')->get();
        return view('media.create', compact('persons'));
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
        $file = $request->file('file');

        $originalName = $file->getClientOriginalName();
        $mimeType = $file->getMimeType();
        $extension = $file->getClientOriginalExtension();

        $fileHash = hash_file('sha256', $file->getRealPath());
        $storedFileName = $fileHash . '.' . $extension;

        if (Media::where('file_hash', $fileHash)->exists()) {
            $existingMedia = Media::where('file_hash', $fileHash)->first();
            $mediaable->media()->create([
                'file_name' => $originalName,
                'file_path' => $existingMedia->file_path,
                'file_hash' => $fileHash,
                'mime_type' => $mimeType,
                'uploaded_by_person_id' => $data['uploaded_by_person_id'],
            ]);
            return redirect()->route('media.index')->with('success', 'File già presente, collegato con successo');
        }

        $path = $file->storeAs('media/original', $storedFileName, 'public');

        if (str_starts_with($mimeType, 'image/')) {
            try {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($file->getRealPath());
                $image->scale(width: 300);
                $thumbnailPath = 'media/thumbnails/' . $storedFileName;
                Storage::disk('public')->put($thumbnailPath, $image->toJpeg(80));
            } catch (\Exception $e) {
            }
        }

        $mediaable->media()->create([
            'file_name' => $originalName,
            'file_path' => $path,
            'file_hash' => $fileHash,
            'mime_type' => $mimeType,
            'uploaded_by_person_id' => $data['uploaded_by_person_id'],
        ]);

        return redirect()->route('media.index')->with('success', 'Media caricato con successo');
    }

    public function show(Media $media)
    {
        $media->load('mediaable', 'uploadedBy');
        return view('media.show', compact('media'));
    }

    public function destroy(Media $media)
    {
        $media->load('mediaable');

        $hashCount = Media::where('file_hash', $media->file_hash)->count();

        if ($hashCount <= 1) {
            if ($media->isImage()) {
                $thumbnailPath = str_replace('/original/', '/thumbnails/', $media->file_path);
                Storage::disk('public')->delete($thumbnailPath);
            }
            Storage::disk('public')->delete($media->file_path);
        }

        $media->delete();

        return redirect()->route('media.index')->with('success', 'Media eliminato con successo');
    }

    public function entities(Request $request)
    {
        $type = $request->query('type');

        $entities = match ($type) {
            'person' => Person::select('id', 'name', 'surname')->get()->map(fn($p) => ['id' => $p->id, 'label' => $p->surname . ' ' . $p->name]),
            'association' => Association::select('id', 'name')->get()->map(fn($a) => ['id' => $a->id, 'label' => $a->name]),
            'diocese' => Diocese::select('id', 'name')->get()->map(fn($d) => ['id' => $d->id, 'label' => $d->name]),
            'group' => Group::select('id', 'name')->get()->map(fn($g) => ['id' => $g->id, 'label' => $g->name]),
            default => [],
        };

        return response()->json($entities);
    }
}