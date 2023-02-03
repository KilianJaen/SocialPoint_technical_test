<?php

namespace KilianJaen\Ranking\Services\Ranking\InsertScore;

class Command
{
    private string $userId;
    private int $score;
    private string $type;

    public function __construct(string $userId, int $score, string $type)
    {
        $this->userId = $userId;
        $this->score  = $score;
        $this->type   = $type;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getType(): string
    {
        return $this->type;
    }
}