<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GenrePolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        $admins = config('admin.admin_list');
        if(!isset($admins[$user->id]))
            return false;

        return $user->email == $admins[$user->id];
    }

    public function view(User $user, Genre $genre)
    {
        return false;
    }

    public function create(User $user)
    {
        $admins = config('admin.admin_list');
        if(!isset($admins[$user->id]))
            return false;

        return $user->email == $admins[$user->id];
    }

    public function update(User $user, Genre $genre)
    {
        $admins = config('admin.admin_list');
        if(!isset($admins[$user->id]))
            return false;
        return $user->email == $admins[$user->id];
    }

    public function delete(User $user, Genre $genre)
    {
        $admins = config('admin.admin_list');
        if(!isset($admins[$user->id]))
            return false;

        return $user->email == $admins[$user->id];
    }

}
