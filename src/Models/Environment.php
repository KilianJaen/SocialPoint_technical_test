<?php

namespace KilianJaen\Ranking\Models;

class Environment
{
    private const  RELATIVE_RANKING = ['at10/3', 'at10/5','at100/3'];
    private const  ABSOLUTE_RANKING = ['top10', 'top50', 'top100', 'top200', 'top300', 'top500'];

    public function getRelativeRankingTypes(): array
    {
        return self::RELATIVE_RANKING;
    }

    public function getAbsoluteRankingTypes(): array
    {
        return self::ABSOLUTE_RANKING;
    }
}