<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function viewAny(User $user): Response
    {
        return true ? Response::allow()
            : Response::deny('You have no permission to do this action.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @return Response
     */
    public function view(User $user): Response
    {
        return $user->isLibrarian() ? Response::allow()
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
     * @param User $user
     * @return Response|bool
     */
    public function update(User $user): Response|bool
    {
        return $user->isLibrarian() ? Response::allow()
            : Response::deny('You have no permission to do this action.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @return Response|bool
     */
    public function delete(User $user): Response|bool
    {
        return $user->isLibrarian() ? Response::allow()
            : Response::deny('You have no permission to do this action.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @return Response|bool
     */
    public function restore(User $user): Response|bool
    {
        return $user->isLibrarian() ? Response::allow()
            : Response::deny('You have no permission to do this action.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @return Response|bool
     */
    public function forceDelete(User $user)
    {
        return $user->isLibrarian() ? Response::allow()
            : Response::deny('You have no permission to do this action.');
    }
}
