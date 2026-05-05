<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonRoleAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'role_id',
        'entity_id',
        'entity_type',
        'start_date',
        'end_date',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function entity()
    {
        return $this->morphTo();
    }
}
