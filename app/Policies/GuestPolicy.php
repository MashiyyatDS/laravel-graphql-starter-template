<?php

namespace App\Policies;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GuestPolicy
{
    public function guests(Guest $guest): bool
    {
        return true;
    }

    public function paginateGuest(Guest $guest): bool
    {
        return true;
    }
}
