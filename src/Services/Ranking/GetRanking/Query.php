<?php

namespace KilianJaen\Ranking\Services\Ranking\GetRanking;

class Query
{
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}