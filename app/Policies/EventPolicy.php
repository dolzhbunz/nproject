<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [
            User::ROLE_ADMIN,
            User::ROLE_EDITOR,
            User::ROLE_AUTHOR
        ]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        return in_array($user->role, [
            User::ROLE_ADMIN,
            User::ROLE_EDITOR,
            User::ROLE_AUTHOR
        ]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, [
            User::ROLE_EDITOR,
            User::ROLE_AUTHOR
        ]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        if($user->hasRole('editor')){
            return true;
        }
//        return $user->id === $event->event_id;

        return in_array($user->role, [
            User::ROLE_MEMBER,
            User::ROLE_EDITOR,
            User::ROLE_AUTHOR
        ]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        return in_array($user->role, [
            User::ROLE_ADMIN,
            User::ROLE_EDITOR
        ]);
    }

    /**
     * Determine whether the user can restore the model.
     */

    /**
     * Determine whether the user can permanently delete the model.
     */
}
