<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true ? Response::allow()
            : Response::deny('You have no permission to do this action.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Book $book)
    {
        return true ? Response::allow()
            : Response::deny('You have no permission to do this action.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->isLibrarian() ? Response::allow()
            : Response::deny('You have no permission to do this action.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Book $book)
    {
        return $user->isLibrarian() ? Response::allow()
            : Response::deny('You have no permission to do this action.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Book $book)
    {
        return $user->isLibrarian() ? Response::allow()
            : Response::deny('You have no permission to do this action.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Book $book)
    {
        return $user->isLibrarian() ? Response::allow()
            : Response::deny('You have no permission to do this action.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Book $book)
    {
        return $user->isLibrarian() ? Response::allow()
            : Response::deny('You have no permission to do this action.');
    }
}
