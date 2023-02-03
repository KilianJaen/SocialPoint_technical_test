<?php

namespace KilianJaen\Ranking\Unit;

use KilianJaen\Ranking\Services\Ranking\GetAbsoluteRanking\Query;
use PHPUnit\Framework\TestCase;

class GetAbsoluteRankingQueryTest extends TestCase
{
    public function testQuery(): void
    {
        $query = new Query('test');
        $this->assertEquals('test', $query->getRanking());
    }
}