<?php

namespace App\Policies;

use App\User;
use App\Movie;
use Illuminate\Auth\Access\HandlesAuthorization;

class MoviePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function modify (User $user, Movie $movie) {
        return $user->id === $movie->user_id;
    }
}
