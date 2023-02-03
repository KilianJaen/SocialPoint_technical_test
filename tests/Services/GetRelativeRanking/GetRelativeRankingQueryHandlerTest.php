<?php

namespace KilianJaen\Ranking\Unit;

use KilianJaen\Ranking\Controllers\FileController;
use KilianJaen\Ranking\Services\Ranking\GetRelativeRanking\Query;
use KilianJaen\Ranking\Services\Ranking\GetRelativeRanking\QueryHandler;
use PHPUnit\Framework\TestCase;

class GetRelativeRankingQueryHandlerTest extends TestCase
{
    public function testExecute(): void
    {
        $this->markTestIncomplete('Problems when fileController willReturn forced array');
        $query = new Query('at10/3');
        $queryHandler = new QueryHandler();
        $mockFileController = $this->createMock(FileController::class);
        $mockFileController->method('getFile')
            ->willReturn([['userid' => '123', 'score' => 100, 'position' => 4]]);

        $response = $queryHandler->execute($query);

        $this->assertEquals(200, $response['status']);
    }
}