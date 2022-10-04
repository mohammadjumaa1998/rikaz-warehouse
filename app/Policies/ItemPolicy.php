<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function changeItemStatus(User $user)
    {
        return backpack_user()->can('changeItemStatus');
    }

    public function manageItem(User $user)
    {
        return backpack_user()->can('manageItem');
    }
}
