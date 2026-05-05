<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'gender',
        'notes',
        'updated_by_person_id',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }

    public function personRoleAssignments()
    {
        return $this->hasMany(PersonRoleAssignment::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(Person::class, 'updated_by_person_id');
    }
}
