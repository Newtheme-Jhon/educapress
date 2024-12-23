<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function author(User $user, $post): Response
    {
        return $user->id === $post->user_id || $user->hasRole('admin') ? 
        Response::allow() : Response::deny('No estas autorizado para editar este post');
    }

    public function published(?User $user, $post): Response
    {
        return $post->status->value === 2 ?
        Response::allow() : Response::deny('Este post no esta publicado');
    }
}
