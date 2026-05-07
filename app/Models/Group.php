<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'diocese_id',
        'meeting_place',
        'meeting_address',
        'meeting_cap',
        'meeting_city',
        'meeting_province',
        'meeting_day',
        'meeting_time',
        'responsible_id',
    ];

    public function diocese()
    {
        return $this->belongsTo(Diocese::class);
    }

    public function responsible()
    {
        return $this->belongsTo(Person::class, 'responsible_id');
    }

    public function associations()
    {
        return $this->belongsToMany(Association::class, 'association_group');
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'contact_group')
            ->withPivot('is_member_of_group');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }

    public function personRoleAssignments()
    {
        return $this->morphMany(PersonRoleAssignment::class, 'entity');
    }
}
