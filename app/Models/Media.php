<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
        'file_hash',
        'mime_type',
        'uploaded_by_person_id',
    ];

    protected $hidden = [
        'file_hash',
    ];

    public function url()
    {
        return asset('storage/' . $this->file_path);
    }

    public function thumbnailUrl()
    {
        if (!$this->isImage()) {
            return null;
        }
        $thumbnailPath = str_replace('/original/', '/thumbnails/', $this->file_path);
        return asset('storage/' . $thumbnailPath);
    }

    public function mediaable()
    {
        return $this->morphTo();
    }

    public function uploadedBy()
    {
        return $this->belongsTo(Person::class, 'uploaded_by_person_id');
    }

    public function isImage()
    {
        return $this->mime_type && str_starts_with($this->mime_type, 'image/');
    }

    public function isPdf()
    {
        return $this->mime_type === 'application/pdf';
    }
}
