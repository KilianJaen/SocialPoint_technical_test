<?php

namespace KilianJaen\Ranking\Services\User\SaveUserData;

use KilianJaen\Ranking\Models\User;

class Command
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}