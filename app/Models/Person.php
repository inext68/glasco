<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $fillable = [
        'unique_code',
        'first_name',
        'last_name',
        'birth_date',
        'gender',
        'notes',
        'street',
        'postal_code',
        'city',
        'province',
        'document_number',
        'document_type',
        'updated_by_person_id',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($person) {
            if (empty($person->unique_code)) {
                $person->unique_code = static::generateUniqueCode();
            }
        });
    }

    public static function generateUniqueCode()
    {
        do {
            $code = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
        } while (static::where('unique_code', $code)->exists());

        return $code;
    }

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
