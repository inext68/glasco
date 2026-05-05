<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BasePolicy
{
    use HandlesAuthorization;

    protected function check(User $user, string $action, string $model)
    {
        $permission = strtolower($action . '_' . $model);
        return $user->hasPermission($permission);
    }

    public function viewAny(User $user)
    {
        return $this->check($user, 'view', 'resource');
    }

    public function view(User $user)
    {
        return $this->check($user, 'view', 'resource');
    }

    public function create(User $user)
    {
        return $this->check($user, 'create', 'resource');
    }

    public function update(User $user)
    {
        return $this->check($user, 'update', 'resource');
    }

    public function delete(User $user)
    {
        return $this->check($user, 'delete', 'resource');
    }
}
