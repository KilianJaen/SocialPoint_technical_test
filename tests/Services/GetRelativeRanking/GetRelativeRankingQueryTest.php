<?php

namespace KilianJaen\Ranking\Unit;

use KilianJaen\Ranking\Services\Ranking\GetRelativeRanking\Query;
use PHPUnit\Framework\TestCase;

class GetRelativeRankingQueryTest extends TestCase
{
    public function testQuery(): void
    {
        $query = new Query('test');
        $this->assertEquals('test', $query->getRanking());
    }
}