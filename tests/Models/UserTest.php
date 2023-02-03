<?php

namespace KilianJaen\Ranking\Models;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCreateUser(): void
    {
        $userId = "1";
        $score  = 100;
        $user   = new User($userId, $score);

        $this->assertEquals($userId, $user->getId());
        $this->assertEquals($score, $user->getScore());
    }

    public function testEditUser(): void
    {
        $userId = "1";
        $score  = 100;
        $user   = new User($userId, $score);

        $newScore = 105;
        $user->setScore($newScore);

        $this->assertEquals($userId, $user->getId());
        $this->assertEquals($newScore, $user->getScore());
    }
}