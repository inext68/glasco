<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

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

    public function primaryContact()
    {
        return $this->hasOne(Contact::class)->where('is_primary', true);
    }

    public function associations()
    {
        return $this->belongsToMany(Association::class, 'contact_group')
            ->withPivot('is_member_of_group');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'contact_group')
            ->withPivot('is_member_of_group');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }

    public function personRoleAssignments()
    {
        return $this->hasMany(PersonRoleAssignment::class);
    }

    public function personSystemRoles()
    {
        return $this->belongsToMany(SystemRole::class, 'person_system_role')
            ->withPivot('assigned_at', 'expires_at');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Person::class, 'updated_by_person_id');
    }
}
