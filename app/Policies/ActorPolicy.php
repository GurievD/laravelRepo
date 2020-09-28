<?php

namespace App\Policies;

use App\Models\Actor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use function PHPUnit\Framework\isEmpty;

class ActorPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Actor $actor)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;

    }

    public function update(User $user, Actor $actor)
    {
        $admins = config('admin.admin_list');
        if(!isset($admins[$user->id]))
            return false;
        return $user->email == $admins[$user->id];
    }

    public function delete(User $user, Actor $actor)
    {
        $admins = config('admin.admin_list');
        if(!isset($admins[$user->id]))
            return false;
        return $user->email == $admins[$user->id];
    }
}
