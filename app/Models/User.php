<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'person_id',
        'column_settings',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'column_settings' => 'array',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function systemRoles()
    {
        return $this->belongsToMany(SystemRole::class, 'person_system_role');
    }

    public function hasPermission(string $permissionName): bool
    {
        return $this->systemRoles()->whereHas('permissions', function ($query) use ($permissionName) {
            $query->where('name', $permissionName);
        })->exists();
    }

    public function hasRole(string $roleName): bool
    {
        return $this->systemRoles()->where('name', $roleName)->exists();
    }
}
