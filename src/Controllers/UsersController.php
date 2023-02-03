<?php

namespace KilianJaen\Ranking\Controllers;

use KilianJaen\Ranking\Services\Ranking\InsertScore\Command;
use KilianJaen\Ranking\Services\Ranking\InsertScore\CommandHandler;

class UsersController
{
    public function getAction(string $userId, ?array $params, bool $isScore, bool $isTotal): array
    {
        $response = ['status' => 404, 'result' => 'Invalid parameters'];

        if (!$this->validateParameters($userId, $params, $isScore, $isTotal)) {
            return $response;
        }

        if ($isScore) {
            $response = $this->insertUserScore($userId, (int)$params['score'], "relative");
        } elseif ($isTotal) {
            $response = $this->insertUserScore($userId, (int)$params['total'], "absolute");
        }

        return $response;
    }

    private function insertUserScore($userId, $score, $type): array
    {
        $insertScoreCommand = new Command($userId, $score, $type);
        $insertScoreCommandHandler = new CommandHandler();

        return $insertScoreCommandHandler->execute($insertScoreCommand);
    }


    private function validateParameters(string $userId, ?array $params, bool $isScore, bool $isTotal): bool
    {
        $response = true;
        if (empty($userId)) {
            $response = false;
        }

        if (!empty($params) && ($isScore && empty((int)$params['score']))) {
            $response = false;
        }

        if (!empty($params) && ($isTotal && (empty((int)$params['total']) || (int)$params['total'] < 0))) {
            $response = false;
        }

        return $response;
    }
}