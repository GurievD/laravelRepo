<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MoviePolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return true;
    }


    public function view(User $user, Movie $movie)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }


    public function update(User $user, Movie $movie)
    {
        $admins = config('admin.admin_list');
        if(!isset($admins[$user->id]))
            return false;
        return $user->email == $admins[$user->id];
    }

    public function delete(User $user, Movie $movie)
    {
        $admins = config('admin.admin_list');
        if(!isset($admins[$user->id]))
            return false;
        return $user->email == $admins[$user->id];
    }

}
