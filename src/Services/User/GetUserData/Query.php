<?php

namespace KilianJaen\Ranking\Services\User\GetUserData;

class Query
{
    private string $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}