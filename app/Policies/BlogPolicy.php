<?php

namespace App\Policies;

use App\Models\User;

final class BlogPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    public function paginateBlog(): bool
    {
        return true;
    }
}
