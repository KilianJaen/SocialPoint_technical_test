<?php

namespace KilianJaen\Ranking\Services\insertScore;

use KilianJaen\Ranking\Services\Ranking\InsertScore\Command;
use PHPUnit\Framework\TestCase;

class InsertScoreCommandTest extends TestCase
{
    public function testQuery(): void
    {
        $userId = "1111";
        $score  = 1000;
        $type   = "relative";

        $command = new Command($userId, $score, $type);

        $this->assertEquals($userId, $command->getUserId());
        $this->assertEquals($score, $command->getScore());
        $this->assertEquals($type, $command->getType());
    }
}