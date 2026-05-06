<?php

namespace App\Providers;

use App\Models\Association;
use App\Models\Contact;
use App\Models\Diocese;
use App\Models\Group;
use App\Models\Media;
use App\Models\Person;
use App\Models\PersonRoleAssignment;
use App\Models\Role;
use App\Policies\BasePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Person::class => BasePolicy::class,
        Contact::class => BasePolicy::class,
        Association::class => BasePolicy::class,
        Diocese::class => BasePolicy::class,
        Group::class => BasePolicy::class,
        Role::class => BasePolicy::class,
        PersonRoleAssignment::class => BasePolicy::class,
        Media::class => BasePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });
    }
}
