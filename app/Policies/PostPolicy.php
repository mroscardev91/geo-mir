<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user == auth()->user();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return $post['visibility_id'] == 1 || ($post['visibility_id'] == 3 && $post->user->is(auth()->user())) ||auth()->user()->role_id == 2;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id == 1;
    }

    public function like (User $user): bool
    {
        return $user->role_id == 1;
    }

    /**
     * Determine whether the user can delete the model.
     */

     //Falta hacer que solo puedan eliminar los posts que ellos mismos han creado
    public function update(User $user, Post $post): bool
    {
        return $user->role_id == 1 && $post->author_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->role_id == 1 && $post->author_id == $user->id || $user->role_id == 2;
    }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Post $post): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Post $post): bool
    // {
    //     //
    // }
}
