<?php

namespace KilianJaen\Ranking\Services\Ranking\CalculatePositions;

class Command
{
    private array $usersInfo;

    public function __construct(array $usersInfo)
    {
        $this->usersInfo = $usersInfo;
    }

    public function getUsersInfo(): array
    {
        return $this->usersInfo;
    }
}