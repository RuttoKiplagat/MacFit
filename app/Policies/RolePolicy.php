<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{

    public function viewAny(User $user)
    {
       return  $user->role()->id === 1;
    }
}
