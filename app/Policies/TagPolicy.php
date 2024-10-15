<?php

namespace App\Policies;

use App\Enums\Users\RoleEnum;
use App\Models\User;
use App\Policies\Rules\UserStaticRules;

class TagPolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @return boolean
     */
    public function viewAny(): bool
    {
        return UserStaticRules::everyOne();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return boolean
     */
    public function view(): bool
    {
        return UserStaticRules::everyOne();
    }

    /**
     * Determine whether the user can create a new model.
     *
     * @param \App\Models\User $authUser
     * @return boolean
     */
    public function create(User $authUser): bool
    {
        return UserStaticRules::atLeastRole($authUser, RoleEnum::admin);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $authUser
     * @return boolean
     */
    public function update(User $authUser): bool
    {
        return UserStaticRules::atLeastRole($authUser, RoleEnum::admin);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $authUser
     * @return boolean
     */
    public function delete(User $authUser): bool
    {
        return UserStaticRules::atLeastRole($authUser, RoleEnum::admin);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $authUser
     * @return boolean
     */
    public function restore(User $authUser): bool
    {
        return UserStaticRules::atLeastRole($authUser, RoleEnum::admin);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $authUser
     * @return boolean
     */
    public function forceDelete(User $authUser): bool
    {
        return UserStaticRules::atLeastRole($authUser, RoleEnum::admin);
    }

    /**
     * Determine whether the user can duplicate the model.
     *
     * @param \App\Models\User $authUser
     * @return boolean
     */
    public function duplicate(User $authUser): bool
    {
        return UserStaticRules::atLeastRole($authUser, RoleEnum::admin);
    }

    /**
     * Determine whether the user can change the order model.
     *
     * @param \App\Models\User $authUser
     * @return boolean
     */
    public function changeOrder(User $authUser): bool
    {
        return UserStaticRules::atLeastRole($authUser, RoleEnum::admin);
    }

    /**
     * Determine whether the user can publish/unpublish the model.
     *
     * @param \App\Models\User $authUser
     * @return boolean
     */
    public function changePublished(User $authUser): bool
    {
        return UserStaticRules::atLeastRole($authUser, RoleEnum::admin);
    }
}
