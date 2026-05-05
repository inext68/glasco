<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diocese extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'region',
        'city',
    ];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }

    public function personRoleAssignments()
    {
        return $this->morphMany(PersonRoleAssignment::class, 'entity');
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
