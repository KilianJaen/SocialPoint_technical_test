<?php

namespace KilianJaen\Ranking\Services\Ranking\GetRelativeRanking;

class Query
{
    private string $ranking;

    public function __construct(string $ranking)
    {
        $this->ranking = $ranking;
    }

    public function getRanking(): string
    {
        return $this->ranking;
    }
}