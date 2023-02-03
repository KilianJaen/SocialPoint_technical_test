<?php

namespace KilianJaen\Ranking\Models;

class User
{
    private string $id;
    private int $score;

    public function __construct(string $id, int $score)
    {
        $this->id    = $id;
        $this->score = $score;
    }

    public function getId(): string
    {
        return $this->id;
    }


    public function getScore(): int
    {
        return $this->score;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }
}