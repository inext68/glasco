<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nation',
        'address',
        'type',
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
        return $this->belongsToMany(Group::class, 'association_group');
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'contact_group')
            ->withPivot('is_member_of_group');
    }

    public function diocese()
    {
        return $this->belongsTo(Diocese::class);
    }
}
